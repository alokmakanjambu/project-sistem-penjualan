@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-mobile-alt"></i> Daftar Produk</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $item)
                        <tr>
                            <td>{{ $item->id_produk }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->jenis_produk }}</span>
                            </td>
                            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->stok }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('produk.show', $item) }}?from=dashboard" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('penjualan.create', ['produk_id' => $item->id_produk]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-shopping-cart"></i> Beli
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
