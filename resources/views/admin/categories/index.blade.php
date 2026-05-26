@extends('layouts.app')
@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Kategori Produk</h4>
        <p class="text-muted small mb-0">Kelola pengelompokan produk obat-obatan</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
        <i class="fa fa-plus me-2"></i> Tambah Kategori
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
        <h5 class="fw-bold mb-0">Daftar Kategori</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-3 px-md-4 py-3">#</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="py-3 text-center">Jumlah Produk</th>
                        <th class="px-3 px-md-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td class="px-3 px-md-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $cat->name }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-1 fw-bold bg-opacity-10 bg-info text-info">
                                {{ $cat->products_count }} Produk
                            </span>
                        </td>
                        <td class="px-3 px-md-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-warning">
                                    <i class="fa fa-edit text-warning"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light border-0 rounded-pill hover-danger">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-tags fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada kategori</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-transparent border-0 px-3 px-md-4 py-3">
        {{ $categories->links() }}
    </div>
    @endif
</div>

<style>
    .hover-warning:hover { background-color: #ffc107 !important; }
    .hover-warning:hover i { color: white !important; }
    .hover-danger:hover { background-color: #dc3545 !important; }
    .hover-danger:hover i { color: white !important; }
</style>
@endsection
