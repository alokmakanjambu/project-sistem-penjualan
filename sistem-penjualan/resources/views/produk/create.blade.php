@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus"></i> Tambah Produk Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                               id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_produk" class="form-label">Jenis Produk</label>
                        <select class="form-control @error('jenis_produk') is-invalid @enderror" 
                                id="jenis_produk" name="jenis_produk" required>
                            <option value="">Pilih Jenis Produk</option>
                            <option value="Smartphone Android" {{ old('jenis_produk') == 'Smartphone Android' ? 'selected' : '' }}>
                                Smartphone Android
                            </option>
                            <option value="Smartphone iOS" {{ old('jenis_produk') == 'Smartphone iOS' ? 'selected' : '' }}>
                                Smartphone iOS
                            </option>
                            <option value="Tablet" {{ old('jenis_produk') == 'Tablet' ? 'selected' : '' }}>
                                Tablet
                            </option>
                            <option value="Laptop" {{ old('jenis_produk') == 'Laptop' ? 'selected' : '' }}>
                                Laptop
                            </option>
                            <option value="Aksesoris" {{ old('jenis_produk') == 'Aksesoris' ? 'selected' : '' }}>
                                Aksesoris
                            </option>
                        </select>
                        @error('jenis_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" 
                                   id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" 
                                   min="0" step="1000" required>
                        </div>
                        @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                               id="stok" name="stok" value="{{ old('stok') }}" min="0" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection