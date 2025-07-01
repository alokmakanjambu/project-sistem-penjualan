<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penjualan = Penjualan::with(['buyer', 'seller'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $buyers = Buyer::all();
        $sellers = Seller::all();
        $produk = Produk::where('stok', '>', 0)->get();
        
        return view('penjualan.create', compact('buyers', 'sellers', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buyer' => 'required|exists:buyers,id_buyer',
            'id_seller' => 'required|exists:sellers,id_seller',
            'metode_pembayaran' => 'required|in:COD,Transfer',
            'produk' => 'required|array',
            'produk.*.id_produk' => 'required|exists:produk,id_produk',
            'produk.*.jumlah' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {
            // Hitung total harga
            $totalHarga = 0;
            foreach ($request->produk as $item) {
                $produk = Produk::find($item['id_produk']);
                $totalHarga += $produk->harga_satuan * $item['jumlah'];
            }

            // Buat penjualan
            $penjualan = Penjualan::create([
                'tanggal_penjualan' => now(),
                'id_buyer' => $request->id_buyer,
                'id_seller' => $request->id_seller,
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'Belum Dibayar',
                'keterangan' => $request->keterangan
            ]);

            // Buat detail penjualan dan update stok
            foreach ($request->produk as $item) {
                $produk = Produk::find($item['id_produk']);
                $subtotal = $produk->harga_satuan * $item['jumlah'];

                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_produk' => $item['id_produk'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $produk->harga_satuan,
                    'subtotal' => $subtotal
                ]);

                // Update stok
                $produk->decrement('stok', $item['jumlah']);
            }
        });

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dibuat.');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['buyer', 'seller', 'detailPenjualan.produk']);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        return view('penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Belum Dibayar,Sudah Dibayar',
            'bukti_transfer' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $updateData = $request->only(['status_pembayaran', 'bukti_transfer', 'keterangan']);
        
        if ($request->status_pembayaran === 'Sudah Dibayar') {
            $updateData['tanggal_bayar'] = now();
        }

        $penjualan->update($updateData);

        return redirect()->route('penjualan.index')
            ->with('success', 'Status penjualan berhasil diupdate.');
    }

    public function destroy(Penjualan $penjualan)
    {
        // Kembalikan stok produk
        foreach ($penjualan->detailPenjualan as $detail) {
            $detail->produk->increment('stok', $detail->jumlah);
        }

        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dihapus.');
    }
}