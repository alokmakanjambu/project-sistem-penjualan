@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-shopping-cart"></i> Daftar Penjualan</h2>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Buat Penjualan
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualan as $item)
                        <tr>
                            <td>{{ $item->id_penjualan }}</td>
                            <td>{{ $item->tanggal_penjualan->format('d/m/Y H:i') }}</td>
                            <td>{{ $item->buyer->nama_buyer }}</td>
                            <td>{{ $item->seller->nama_seller }}</td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $item->metode_pembayaran == 'Transfer' ? 'bg-info' : 'bg-warning' }}">
                                    {{ $item->metode_pembayaran }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $item->status_pembayaran == 'Sudah Dibayar' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->status_pembayaran }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('penjualan.show', $item) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('penjualan.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <form action="{{ route('penjualan.destroy', $item) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data penjualan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $penjualan->links() }}
    </div>
</div>
@endsection