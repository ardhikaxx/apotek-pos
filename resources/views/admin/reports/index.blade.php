@extends('layouts.app')
@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold mb-1">Laporan Penjualan</h4>
        <p class="text-muted small">Analisis data transaksi dan pendapatan apotek</p>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-secondary">Dari Tanggal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa fa-calendar-alt text-muted"></i></span>
                    <input type="date" name="start_date" class="form-control border-0 bg-light rounded-end-3" value="{{ request('start_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold text-secondary">Sampai Tanggal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa fa-calendar-check text-muted"></i></span>
                    <input type="date" name="end_date" class="form-control border-0 bg-light rounded-end-3" value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-info text-white fw-bold rounded-pill px-4 shadow-sm flex-grow-1">
                    <i class="fa fa-filter me-2"></i>FILTER DATA
                </button>
                <a href="{{ route('admin.reports.pdf', request()->query()) }}" class="btn btn-outline-danger rounded-pill px-4" target="_blank">
                    <i class="fa fa-file-pdf me-2"></i>PDF
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="p-4 bg-primary bg-opacity-10 rounded-4 border border-primary border-opacity-10 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white p-3 rounded-circle me-3 shadow-sm">
                    <i class="fa fa-wallet fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted small fw-bold text-uppercase">Total Akumulasi Pendapatan</h6>
                    <h2 class="fw-bold mb-0 text-dark">Rp {{ number_format($total, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="text-end d-none d-md-block">
                <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm fw-bold">
                    {{ count($transactions) }} Transaksi Ditemukan
                </span>
            </div>
        </div>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3 border-0">Nomor Invoice</th>
                        <th class="py-3 border-0">Kasir</th>
                        <th class="py-3 border-0">Total Transaksi</th>
                        <th class="py-3 border-0">Waktu Transaksi</th>
                        <th class="px-4 py-3 border-0 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light p-2 rounded me-3">
                                    <i class="fa fa-file-invoice text-muted"></i>
                                </div>
                                <span class="fw-bold text-dark">{{ $tx->invoice_number }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                    {{ substr($tx->user->name, 0, 1) }}
                                </div>
                                <span>{{ $tx->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">Rp {{ number_format($tx->total, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="small">{{ $tx->transaction_date->translatedFormat('d M Y') }}</span>
                                <small class="text-muted" style="font-size: 0.7rem;">{{ $tx->transaction_date->format('H:i') }} WIB</small>
                            </div>
                        </td>
                        <td class="px-4 text-end">
                            <a href="{{ route('admin.transactions.show', $tx) }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm hover-primary">
                                <i class="fa fa-eye me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center opacity-25">
                                <i class="fa fa-chart-pie fa-4x mb-3"></i>
                                <h5 class="fw-bold">Tidak Ada Data Transaksi</h5>
                                <p class="mb-0">Silakan sesuaikan filter tanggal untuk melihat data lain</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($transactions->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $transactions->links() }}
    </div>
    @endif
</div>

<style>
    .hover-primary:hover {
        background-color: var(--primary-color) !important;
        color: white !important;
    }
</style>
@endsection
