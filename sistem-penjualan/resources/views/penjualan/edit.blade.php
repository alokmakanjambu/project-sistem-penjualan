@extends('layouts.app')

@section('title', 'Edit Status Penjualan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Edit Status Penjualan #{{ $penjualan->id_penjualan }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.update', $penjualan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                        <select class="form-control @error('status_pembayaran') is-invalid @enderror" 
                                id="status_pembayaran" name="status_pembayaran" required>
                            <option value="Belum Dibayar" 
                                {{ old('status_pembayaran', $penjualan->status_pembayaran) == 'Belum Dibayar' ? 'selected' : '' }}>
                                Belum Dibayar
                            </option>
                            <option value="Sudah Dibayar" 
                                {{ old('status_pembayaran', $penjualan->status_pembayaran) == 'Sudah Dibayar' ? 'selected' : '' }}>
                                Sudah Dibayar
                            </option>
                        </select>
                        @error('status_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
                        <input type="text" class="form-control @error('bukti_transfer') is-invalid @enderror" 
                               id="bukti_transfer" name="bukti_transfer" 
                               value="{{ old('bukti_transfer', $penjualan->bukti_transfer) }}"
                               placeholder="Nama file bukti transfer">
                        @error('bukti_transfer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $penjualan->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penjualan.show', $penjualan) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
