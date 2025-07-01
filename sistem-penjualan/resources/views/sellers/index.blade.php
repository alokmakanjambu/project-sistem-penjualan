@extends('layouts.app')

@section('title', 'Daftar Seller')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users"></i> Daftar Seller</h2>
    <a href="{{ route('sellers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Seller
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No Telepon</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sellers as $seller)
                    <tr>
                        <td>{{ $seller->id_seller }}</td>
                        <td>{{ $seller->nama_seller }}</td>
                        <td>{{ $seller->username }}</td>
                        <td>{{ $seller->no_telepon }}</td>
                        <td>{{ $seller->created_at }}</td>
                        <td>
                            <a href="{{ route('sellers.show', $seller->id_seller) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> 
                            </a>
                            <a href="{{ route('sellers.edit', $seller->id_seller) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <form action="{{ route('sellers.destroy', $seller->id_seller) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus seller ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $sellers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection