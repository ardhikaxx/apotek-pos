@extends('layouts.app')
@section('title', 'Pembelian Obat')
@section('page-title', 'Pembelian Obat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Daftar Pembelian</h4>
        <p class="text-muted small mb-0">Kelola riwayat pembelian stok obat dari supplier</p>
    </div>
    <a href="{{ route('admin.purchases.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
        <i class="fa fa-plus me-2"></i> Catat Pembelian
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0">Semua Pembelian</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Supplier</th>
                        <th class="py-3 text-end">Total</th>
                        <th class="py-3">Admin</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $p)
                    <tr>
                        <td class="px-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($p->purchase_date)->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $p->supplier->name }}</div>
                            <small class="text-muted"><i class="fa fa-phone me-1 small"></i>{{ $p->supplier->phone ?? '-' }}</small>
                        </td>
                        <td class="text-end">
                            <div class="fw-bold text-info">Rp {{ number_format($p->total, 0, ',', '.') }}</div>
                        </td>
                        <td>{{ $p->user->name }}</td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.purchases.show', $p) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-info">
                                    <i class="fa fa-eye text-info"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-shopping-cart fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada data pembelian</p>
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
    .hover-info:hover { background-color: #0dcaf0 !important; }
    .hover-info:hover i { color: white !important; }
</style>
@endsection
