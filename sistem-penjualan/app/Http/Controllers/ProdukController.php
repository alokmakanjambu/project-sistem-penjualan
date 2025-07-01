<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    public function index()
    {
        $produk = Produk::orderBy('created_at', 'desc')->paginate(10);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|in:Smartphone Android,Smartphone iOS,Tablet,Laptop,Aksesoris',
            'harga_satuan' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|in:Smartphone Android,Smartphone iOS,Tablet,Laptop,Aksesoris',
            'harga_satuan' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}