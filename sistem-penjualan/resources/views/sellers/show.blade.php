@extends('layouts.app')

@section('title', 'Detail Seller')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Detail Seller</h2>
    <a href="{{ route('sellers.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID Seller</th>
                <td>{{ $seller->id_seller }}</td>
            </tr>
            <tr>
                <th>Nama Seller</th>
                <td>{{ $seller->nama_seller }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $seller->username }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>{{ $seller->no_telepon }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $seller->created_at }}</td>
            </tr>
            <tr>
                <th>Diupdate</th>
                <td>{{ $seller->updated_at }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection 