@extends('layouts.app')

@section('title', 'Daftar Buyer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user-friends"></i> Daftar Buyer</h2>
    <a href="{{ route('buyers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Buyer
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
                    @foreach($buyers as $buyer)
                    <tr>
                        <td>{{ $buyer->id_buyer }}</td>
                        <td>{{ $buyer->nama_buyer }}</td>
                        <td>{{ $buyer->username }}</td>
                        <td>{{ $buyer->no_telepon }}</td>
                        <td>{{ $buyer->created_at }}</td>
                        <td>
                            <a href="{{ route('buyers.show', $buyer->id_buyer) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('buyers.edit', $buyer->id_buyer) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('buyers.destroy', $buyer->id_buyer) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus buyer ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $buyers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 