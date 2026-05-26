@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('page-title', 'Kategori')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Edit Kategori</h4>
        <p class="text-muted small mb-0">Perbarui informasi kategori produk</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">
        <i class="fa fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-12 col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
                <h5 class="fw-bold mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">NAMA KATEGORI</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
                            <i class="fa fa-save me-2"></i> Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
