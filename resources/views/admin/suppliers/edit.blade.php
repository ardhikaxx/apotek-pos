@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1">Edit Supplier</h4>
                <p class="text-muted small mb-0">Perbarui data pemasok dalam sistem</p>
            </div>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold w-100 w-sm-auto">
                <i class="fa fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
                <h5 class="fw-bold mb-0">Form Edit Supplier</h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Nama Supplier</label>
                            <input type="text" name="name" class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror" value="{{ old('name', $supplier->name) }}" placeholder="Masukkan nama supplier" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Telepon</label>
                            <input type="text" name="phone" class="form-control form-control-lg bg-light border-0 @error('phone') is-invalid @enderror" value="{{ old('phone', $supplier->phone) }}" placeholder="Masukkan nomor telepon">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Alamat</label>
                            <textarea name="address" class="form-control form-control-lg bg-light border-0 @error('address') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address', $supplier->address) }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold text-dark">
                                    <i class="fa fa-save me-2"></i> Perbarui Supplier
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
