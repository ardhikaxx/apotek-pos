@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Edit Produk</h4>
                <p class="text-muted small mb-0">Perbarui data obat atau alkes dalam inventori</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold">
                <i class="fa fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Form Edit Produk</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.products.update', $product) }}">
                    @csrf @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Nama Produk</label>
                            <input type="text" name="name" class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" placeholder="Masukkan nama produk" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Kategori</label>
                            <select name="category_id" class="form-select form-select-lg bg-light border-0 @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Satuan</label>
                            <input type="text" name="unit" class="form-control form-control-lg bg-light border-0 @error('unit') is-invalid @enderror" value="{{ old('unit', $product->unit) }}" required>
                            @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Harga Beli</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0 text-muted">Rp</span>
                                <input type="number" name="purchase_price" class="form-control bg-light border-0 @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $product->purchase_price) }}" min="0" required>
                            </div>
                            @error('purchase_price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Harga Jual</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0 text-muted">Rp</span>
                                <input type="number" name="selling_price" class="form-control bg-light border-0 @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', $product->selling_price) }}" min="0" required>
                            </div>
                            @error('selling_price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Stok</label>
                            <input type="number" name="stock" class="form-control form-control-lg bg-light border-0 @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" min="0" required>
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Tanggal Kadaluarsa</label>
                            <input type="date" name="expiry_date" class="form-control form-control-lg bg-light border-0 @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date', $product->expiry_date) }}">
                            @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Status</label>
                            <select name="is_active" class="form-select form-select-lg bg-light border-0">
                                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold text-dark">
                            <i class="fa fa-save me-2"></i> Perbarui Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
