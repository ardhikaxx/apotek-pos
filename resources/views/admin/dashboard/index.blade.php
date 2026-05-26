@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3 p-md-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <i class="fa fa-pills fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                            <i class="fa fa-arrow-up me-1"></i> Aktif
                        </span>
                    </div>
                </div>
                <h6 class="text-muted small fw-semibold mb-1">Total Produk</h6>
                <h3 class="fw-bold mb-0">{{ number_format($totalProducts) }}</h3>
                <p class="text-muted small mb-0 mt-2">Terdaftar dalam sistem</p>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3 p-md-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-4">
                        <i class="fa fa-users fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                            Semua Role
                        </span>
                    </div>
                </div>
                <h6 class="text-muted small fw-semibold mb-1">Total Pengguna</h6>
                <h3 class="fw-bold mb-0">{{ number_format($totalUsers) }}</h3>
                <p class="text-muted small mb-0 mt-2">Admin, Apoteker, Pelanggan</p>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3 p-md-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                        <i class="fa fa-wallet fs-4"></i>
                    </div>
                    <div class="text-end text-success">
                        <i class="fa fa-circle small me-1"></i> <small class="fw-bold">Hari Ini</small>
                    </div>
                </div>
                <h6 class="text-muted small fw-semibold mb-1">Pendapatan</h6>
                <h3 class="fw-bold mb-0">Rp {{ number_format($todayTotal, 0, ',', '.') }}</h3>
                <p class="text-muted small mb-0 mt-2 text-truncate">Total transaksi selesai</p>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3 p-md-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                        <i class="fa fa-boxes-stacked fs-4"></i>
                    </div>
                    <div class="text-end">
                        @if($lowStock > 0)
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1 animate-pulse" style="font-size: 0.65rem;">
                                Butuh Perhatian
                            </span>
                        @else
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                                Aman
                            </span>
                        @endif
                    </div>
                </div>
                <h6 class="text-muted small fw-semibold mb-1">Stok Menipis</h6>
                <h3 class="fw-bold mb-0 {{ $lowStock > 0 ? 'text-danger' : '' }}">{{ $lowStock }}</h3>
                <p class="text-muted small mb-0 mt-2">Produk di bawah batas minimum</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1">Transaksi Terbaru</h5>
                    <p class="text-muted small mb-0">Daftar 10 transaksi terakhir yang diproses</p>
                </div>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-light rounded-pill px-3">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="px-4 py-3 border-0 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Nomor Invoice</th>
                                <th class="py-3 border-0 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Kasir</th>
                                <th class="py-3 border-0 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Total Transaksi</th>
                                <th class="py-3 border-0 small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Waktu Transaksi</th>
                                <th class="px-4 py-3 border-0 text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTx as $tx)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light p-2 rounded me-3 text-secondary">
                                            <i class="fa fa-file-invoice small"></i>
                                        </div>
                                        <span class="fw-bold text-dark">{{ $tx->invoice_number }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                            {{ substr($tx->user->name, 0, 1) }}
                                        </div>
                                        <span class="small">{{ $tx->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">Rp {{ number_format($tx->total, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="small">{{ $tx->transaction_date->translatedFormat('d M Y') }}</span>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $tx->transaction_date->format('H:i') }} WIB</small>
                                    </div>
                                </td>
                                <td class="px-4 text-end">
                                    <a href="{{ route('admin.transactions.show', $tx) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-primary">
                                        <i class="fa fa-eye text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center opacity-25">
                                        <i class="fa fa-receipt fa-3x mb-3"></i>
                                        <p class="fw-bold mb-0">Belum ada transaksi</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-primary:hover {
        background-color: var(--primary-color) !important;
    }
    .hover-primary:hover i {
        color: white !important;
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .5; }
    }
</style>
@endsection
