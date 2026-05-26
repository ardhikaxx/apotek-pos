@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('page-title', 'Kategori')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Kategori</h4>
    <p class="text-muted small mb-0">Buat kategori produk baru</p>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">NAMA KATEGORI</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Obat Bebas, Suplemen" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
                            <i class="fa fa-save me-2"></i> Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
