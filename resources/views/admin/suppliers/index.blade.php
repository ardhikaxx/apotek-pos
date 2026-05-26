@extends('layouts.app')
@section('title', 'Supplier')
@section('page-title', 'Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Daftar Supplier</h4>
        <p class="text-muted small mb-0">Manajemen data pemasok obat dan alkes</p>
    </div>
    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
        <i class="fa fa-plus me-2"></i> Tambah Supplier
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0">Semua Supplier</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">Nama Supplier</th>
                        <th class="py-3">Telepon</th>
                        <th class="py-3">Alamat</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td class="px-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $supplier->name }}</div>
                        </td>
                        <td>{{ $supplier->phone ?? '-' }}</td>
                        <td>{{ $supplier->address ?? '-' }}</td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-warning">
                                    <i class="fa fa-edit text-warning"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.suppliers.destroy', $supplier) }}" onsubmit="return confirm('Hapus supplier ini?')">
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
                        <td colspan="5" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-truck fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada data supplier</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .hover-warning:hover { background-color: #ffc107 !important; }
    .hover-warning:hover i { color: white !important; }
    .hover-danger:hover { background-color: #dc3545 !important; }
    .hover-danger:hover i { color: white !important; }
</style>
@endsection
