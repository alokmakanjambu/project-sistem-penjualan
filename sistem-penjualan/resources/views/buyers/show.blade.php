@extends('layouts.app')

@section('title', 'Detail Buyer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Detail Buyer</h2>
    <a href="{{ route('buyers.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID Buyer</th>
                <td>{{ $buyer->id_buyer }}</td>
            </tr>
            <tr>
                <th>Nama Buyer</th>
                <td>{{ $buyer->nama_buyer }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $buyer->username }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>{{ $buyer->no_telepon }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $buyer->created_at }}</td>
            </tr>
            <tr>
                <th>Diupdate</th>
                <td>{{ $buyer->updated_at }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection 