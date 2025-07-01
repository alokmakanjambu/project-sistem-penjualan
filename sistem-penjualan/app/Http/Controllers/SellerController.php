<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::orderBy('created_at', 'desc')->paginate(10);
        return view('sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_seller' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:sellers,username',
            'password' => 'required|string|min:6',
            'no_telepon' => 'required|string|max:15',
        ]);

        Seller::create([
            'nama_seller' => $request->nama_seller,
            'username' => $request->username,
            'password' => $request->password, // Jika ingin hash, gunakan Hash::make($request->password)
            'no_telepon' => $request->no_telepon,
        ]);

        return redirect()->route('sellers.index')->with('success', 'Seller berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $seller = Seller::findOrFail($id);
        return view('sellers.show', compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $seller = Seller::findOrFail($id);
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);

        $request->validate([
            'nama_seller' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:sellers,username,' . $seller->id_seller . ',id_seller',
            'password' => 'nullable|string|min:6',
            'no_telepon' => 'required|string|max:15',
        ]);

        $data = [
            'nama_seller' => $request->nama_seller,
            'username' => $request->username,
            'no_telepon' => $request->no_telepon,
        ];
        if ($request->filled('password')) {
            $data['password'] = $request->password; // Jika ingin hash, gunakan Hash::make($request->password)
        }

        $seller->update($data);

        return redirect()->route('sellers.index')->with('success', 'Seller berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('sellers.index')->with('success', 'Seller berhasil dihapus.');
    }
}
