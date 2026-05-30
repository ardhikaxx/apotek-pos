@extends('layouts.app')
@section('title', 'Laporan Hari Ini')
@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Aktivitas Penjualan Hari Ini</h4>
        <p class="text-muted small mb-0">Laporan transaksi Anda pada {{ now()->translatedFormat('d F Y') }}</p>
    </div>
    <a href="{{ route('apoteker.reports.pdf') }}" class="btn btn-outline-danger rounded-pill px-4 shadow-sm" target="_blank">
        <i class="fa fa-file-pdf me-2"></i>Export PDF
    </a>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="p-3 p-md-4 bg-primary bg-opacity-10 rounded-4 border border-primary border-opacity-10 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white p-3 rounded-circle me-3 shadow-sm">
                    <i class="fa fa-wallet fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted small fw-bold text-uppercase">Total Pendapatan Hari Ini</h6>
                    <h2 class="fw-bold mb-0 text-dark">Rp {{ number_format($total, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="text-md-end">
                <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm fw-bold">
                    {{ count($transactions) }} Transaksi Berhasil
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
                        <th class="py-3 border-0">Total Transaksi</th>
                        <th class="py-3 border-0">Nominal Bayar</th>
                        <th class="py-3 border-0">Kembalian</th>
                        <th class="py-3 border-0">Waktu</th>
                        <th class="px-4 py-3 border-0 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
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
                            <span class="fw-bold text-primary">Rp {{ number_format($tx->total, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="text-muted small">Rp {{ number_format($tx->paid_amount, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="text-success small fw-bold">Rp {{ number_format($tx->change_amount, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark fw-normal rounded-pill">{{ $tx->transaction_date->format('H:i') }} WIB</span>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('apoteker.pos.show', $tx) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-primary">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                                <form action="{{ route('apoteker.reports.destroy', $tx) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Stok akan dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border-0 rounded-pill hover-danger">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center opacity-25">
                                <i class="fa fa-receipt fa-4x mb-3"></i>
                                <h5 class="fw-bold">Belum Ada Transaksi</h5>
                                <p class="mb-0">Aktivitas penjualan Anda hari ini akan muncul di sini</p>
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
    }
    .hover-primary:hover i {
        color: white !important;
    }
    .hover-danger:hover {
        background-color: #dc3545 !important;
    }
    .hover-danger:hover i {
        color: white !important;
    }
</style>
@endsection

