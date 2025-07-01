@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="jumbotron bg-primary text-white rounded p-5 mb-4">
    <div class="container">
        <h1 class="display-4">
            <i class="fas fa-store"></i> Sistem Penjualan
        </h1>
        <p class="lead">Selamat datang di sistem manajemen penjualan smartphone dan elektronik</p>
        @guest
            <a class="btn btn-light btn-lg" href="{{ route('login') }}" role="button">
                <i class="fas fa-sign-in-alt"></i> Login untuk Mulai
            </a>
        @endguest
    </div>
</div>

@auth
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Produk</h5>
                        <h3>{{ \App\Models\Produk::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-mobile-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Penjualan</h5>
                        <h3>{{ \App\Models\Penjualan::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Buyer</h5>
                        <h3>{{ \App\Models\Buyer::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Seller</h5>
                        <h3>{{ \App\Models\Seller::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-store fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mt-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Revenue</h5>
                        <h3>Rp {{ number_format(\App\Models\Penjualan::sum('total_harga'), 0, ',', '.') }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Penjualan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Buyer</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Penjualan::with(['buyer'])->latest()->take(5)->get() as $penjualan)
                                <tr>
                                    <td>{{ $penjualan->id_penjualan }}</td>
                                    <td>{{ $penjualan->tanggal_penjualan->format('d/m/Y') }}</td>
                                    <td>{{ $penjualan->buyer->nama_buyer }}</td>
                                    <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $penjualan->status_pembayaran == 'Sudah Dibayar' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $penjualan->status_pembayaran }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Produk Stok Rendah</h5>
            </div>
            <div class="card-body">
                @foreach(\App\Models\Produk::where('stok', '<=', 5)->get() as $produk)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>{{ $produk->nama_produk }}</strong><br>
                            <small class="text-muted">{{ $produk->jenis_produk }}</small>
                        </div>
                        <span class="badge bg-danger">{{ $produk->stok }}</span>
                    </div>
                    @if(!$loop->last)<hr>@endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endauth
@endsection