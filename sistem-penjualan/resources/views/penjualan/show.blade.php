@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-receipt"></i> Detail Penjualan #{{ $penjualan->id_penjualan }}</h4>
                <div>
                    <a href="{{ route('penjualan.edit', $penjualan) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Status
                    </a>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Informasi Penjualan</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%">Tanggal</td>
                                <td>: {{ $penjualan->tanggal_penjualan->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td>: <strong>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td>Metode Bayar</td>
                                <td>: 
                                    <span class="badge {{ $penjualan->metode_pembayaran == 'Transfer' ? 'bg-info' : 'bg-warning' }}">
                                        {{ $penjualan->metode_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: 
                                    <span class="badge {{ $penjualan->status_pembayaran == 'Sudah Dibayar' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $penjualan->status_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                            @if($penjualan->tanggal_bayar)
                                <tr>
                                    <td>Tanggal Bayar</td>
                                    <td>: {{ $penjualan->tanggal_bayar->format('d F Y, H:i') }}</td>
                                </tr>
                            @endif
                            @if($penjualan->keterangan)
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{ $penjualan->keterangan }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h6>Buyer</h6>
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <strong>{{ $penjualan->buyer->nama_buyer }}</strong><br>
                                        <small class="text-muted">{{ $penjualan->buyer->alamat }}</small><br>
                                        <small class="text-muted">{{ $penjualan->buyer->no_telepon }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Seller</h6>
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <strong>{{ $penjualan->seller->nama_seller }}</strong><br>
                                        <small class="text-muted">{{ $penjualan->seller->no_telepon }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                
                <h6>Detail Produk</h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jenis</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->detailPenjualan as $detail)
                                <tr>
                                    <td>{{ $detail->produk->nama_produk }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $detail->produk->jenis_produk }}</span>
                                    </td>
                                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <th colspan="4">Total</th>
                                <th>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection