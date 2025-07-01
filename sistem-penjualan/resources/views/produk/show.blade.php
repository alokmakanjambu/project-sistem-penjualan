@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-mobile-alt"></i> Detail Produk</h2>
    <a href="{{ request('from') == 'dashboard' ? url('/dashboard') : route('produk.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama Produk</th>
                <td>{{ $produk->nama_produk }}</td>
            </tr>
            <tr>
                <th>Jenis Produk</th>
                <td>{{ $produk->jenis_produk }}</td>
            </tr>
            <tr>
                <th>Harga Satuan</th>
                <td>Rp {{ number_format($produk->harga_satuan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $produk->stok }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $produk->created_at }}</td>
            </tr>
            <tr>
                <th>Diupdate</th>
                <td>{{ $produk->updated_at }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection