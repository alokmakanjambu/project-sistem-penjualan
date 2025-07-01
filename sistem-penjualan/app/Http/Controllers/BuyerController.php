<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::orderBy('created_at', 'desc')->paginate(10);
        return view('buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_buyer' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:buyers,username',
            'password' => 'required|string|min:6',
            'no_telepon' => 'required|string|max:15',
            // alamat tidak wajib
        ]);

        Buyer::create([
            'nama_buyer' => $request->nama_buyer,
            'username' => $request->username,
            'password_buyer' => $request->password,
            'alamat' => $request->alamat ?? '',
            'no_telepon' => $request->no_telepon,
        ]);

        return redirect()->route('buyers.index')->with('success', 'Buyer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $buyer = Buyer::findOrFail($id);
        return view('buyers.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        return view('buyers.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buyer = Buyer::findOrFail($id);

        $request->validate([
            'nama_buyer' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:buyers,username,' . $buyer->id_buyer . ',id_buyer',
            'password' => 'nullable|string|min:6',
            'no_telepon' => 'required|string|max:15',
            // alamat tidak wajib
        ]);

        $data = [
            'nama_buyer' => $request->nama_buyer,
            'username' => $request->username,
            'alamat' => $request->alamat ?? '',
            'no_telepon' => $request->no_telepon,
        ];
        if ($request->filled('password')) {
            $data['password_buyer'] = $request->password;
        }

        $buyer->update($data);

        return redirect()->route('buyers.index')->with('success', 'Buyer berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buyer = Buyer::findOrFail($id);
        $buyer->delete();

        return redirect()->route('buyers.index')->with('success', 'Buyer berhasil dihapus.');
    }
}
