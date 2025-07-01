@extends('layouts.app')

@section('title', 'Buat Penjualan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus"></i> Buat Penjualan Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.store') }}" method="POST" id="penjualanForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_buyer" class="form-label">Buyer</label>
                                <select class="form-control @error('id_buyer') is-invalid @enderror" 
                                        id="id_buyer" name="id_buyer" required>
                                    <option value="">Pilih Buyer</option>
                                    @foreach($buyers as $buyer)
                                        <option value="{{ $buyer->id_buyer }}" 
                                            {{ old('id_buyer') == $buyer->id_buyer ? 'selected' : '' }}>
                                            {{ $buyer->nama_buyer }} - {{ $buyer->no_telepon }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_buyer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_seller" class="form-label">Seller</label>
                                <select class="form-control @error('id_seller') is-invalid @enderror" 
                                        id="id_seller" name="id_seller" required>
                                    <option value="">Pilih Seller</option>
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id_seller }}" 
                                            {{ old('id_seller') == $seller->id_seller ? 'selected' : '' }}>
                                            {{ $seller->nama_seller }} - {{ $seller->no_telepon }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_seller')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                <select class="form-control @error('metode_pembayaran') is-invalid @enderror" 
                                        id="metode_pembayaran" name="metode_pembayaran" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="COD" {{ old('metode_pembayaran') == 'COD' ? 'selected' : '' }}>COD</option>
                                    <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                                @error('metode_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" 
                                       name="keterangan" value="{{ old('keterangan') }}" 
                                       placeholder="Keterangan tambahan">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5>Produk</h5>
                    
                    <div id="produk-container">
                        <div class="produk-item border p-3 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Produk</label>
                                    <select class="form-control produk-select" name="produk[0][id_produk]" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produk as $item)
                                            <option value="{{ $item->id_produk }}" 
                                                data-harga="{{ $item->harga_satuan }}" 
                                                data-stok="{{ $item->stok }}">
                                                {{ $item->nama_produk }} - Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} 
                                                (Stok: {{ $item->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" class="form-control jumlah-input" 
                                           name="produk[0][jumlah]" min="1" value="1" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control subtotal-display" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-danger remove-produk" 
                                            style="display: none;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="add-produk">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>
                    </div>

                    <div class="alert alert-info">
                        <strong>Total Harga: Rp <span id="total-harga">0</span></strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Penjualan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let produkIndex = 1;

// Add produk
document.getElementById('add-produk').addEventListener('click', function() {
    const container = document.getElementById('produk-container');
    const template = container.querySelector('.produk-item').cloneNode(true);
    
    // Update indices
    template.querySelectorAll('select, input').forEach(element => {
        if (element.name) {
            element.name = element.name.replace(/\[\d+\]/, `[${produkIndex}]`);
        }
        if (element.type !== 'button') {
            element.value = element.type === 'number' ? '1' : '';
        }
    });
    
    // Show remove button
    template.querySelector('.remove-produk').style.display = 'inline-block';
    
    container.appendChild(template);
    produkIndex++;
    
    // Add event listeners
    addProdukEventListeners(template);
    updateRemoveButtons();
});

// Remove produk
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-produk')) {
        e.target.closest('.produk-item').remove();
        updateRemoveButtons();
        calculateTotal();
    }
});

// Update remove button visibility
function updateRemoveButtons() {
    const items = document.querySelectorAll('.produk-item');
    items.forEach((item, index) => {
        const removeBtn = item.querySelector('.remove-produk');
        removeBtn.style.display = items.length > 1 ? 'inline-block' : 'none';
    });
}

// Add event listeners to produk item
function addProdukEventListeners(item) {
    const select = item.querySelector('.produk-select');
    const jumlahInput = item.querySelector('.jumlah-input');
    const subtotalDisplay = item.querySelector('.subtotal-display');
    
    select.addEventListener('change', function() {
        calculateSubtotal(item);
        updateStokLimit(item);
    });
    
    jumlahInput.addEventListener('input', function() {
        calculateSubtotal(item);
    });
}

// Calculate subtotal
function calculateSubtotal(item) {
    const select = item.querySelector('.produk-select');
    const jumlahInput = item.querySelector('.jumlah-input');
    const subtotalDisplay = item.querySelector('.subtotal-display');
    
    const selectedOption = select.options[select.selectedIndex];
    const harga = selectedOption.dataset.harga || 0;
    const jumlah = jumlahInput.value || 0;
    const subtotal = harga * jumlah;
    
    subtotalDisplay.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
    calculateTotal();
}

// Update stok limit
function updateStokLimit(item) {
    const select = item.querySelector('.produk-select');
    const jumlahInput = item.querySelector('.jumlah-input');
    
    const selectedOption = select.options[select.selectedIndex];
    const stok = selectedOption.dataset.stok || 0;
    
    jumlahInput.max = stok;
    if (jumlahInput.value > stok) {
        jumlahInput.value = stok;
    }
}

// Calculate total
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.produk-item').forEach(item => {
        const select = item.querySelector('.produk-select');
        const jumlahInput = item.querySelector('.jumlah-input');
        
        const selectedOption = select.options[select.selectedIndex];
        const harga = selectedOption.dataset.harga || 0;
        const jumlah = jumlahInput.value || 0;
        total += harga * jumlah;
    });
    
    document.getElementById('total-harga').textContent = new Intl.NumberFormat('id-ID').format(total);
}

// Initialize first item
document.addEventListener('DOMContentLoaded', function() {
    const firstItem = document.querySelector('.produk-item');
    addProdukEventListeners(firstItem);
});
</script>
@endsection