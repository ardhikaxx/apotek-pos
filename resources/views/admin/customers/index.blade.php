@extends('layouts.app')
@section('title', 'Pelanggan')
@section('page-title', 'Pelanggan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Daftar Pelanggan</h4>
        <p class="text-muted small mb-0">Manajemen data pelanggan tetap apotek</p>
    </div>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
        <i class="fa fa-plus me-2"></i> Tambah Pelanggan
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0">Semua Pelanggan</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">No. Telp</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td class="px-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $customer->name }}</div>
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-1 fw-bold bg-opacity-10 {{ $customer->is_active ? 'bg-success text-success' : 'bg-danger text-danger' }}">
                                {{ $customer->is_active ? 'Aktif' : 'Non-aktif' }}
                            </span>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-warning">
                                    <i class="fa fa-edit text-warning"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}" onsubmit="return confirm('Hapus pelanggan ini?')">
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
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-users fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada data pelanggan</p>
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
