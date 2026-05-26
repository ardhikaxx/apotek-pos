@extends('layouts.app')
@section('title', 'Daftar Transaksi')
@section('page-title', 'Daftar Transaksi')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Riwayat Transaksi</h4>
        <p class="text-muted small mb-0">Kelola dan pantau semua transaksi penjualan</p>
    </div>
    <a href="{{ route('admin.transactions.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white w-100 w-sm-auto">
        <i class="fa fa-plus me-2"></i> Transaksi Baru
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
        <h5 class="fw-bold mb-0">Semua Transaksi</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">Invoice</th>
                        <th class="py-3">Pelanggan / Kasir</th>
                        <th class="py-3 text-end">Total</th>
                        <th class="py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                    <tr>
                        <td class="px-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $tx->invoice_number }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $tx->customer->name ?? 'Umum' }}</div>
                            <small class="text-muted"><i class="fa fa-user-circle me-1"></i>{{ $tx->user->name }}</small>
                        </td>
                        <td class="text-end">
                            <div class="fw-bold text-info">Rp {{ number_format($tx->total, 0, ',', '.') }}</div>
                            <small class="text-muted">Bayar: Rp {{ number_format($tx->paid_amount, 0, ',', '.') }}</small>
                        </td>
                        <td class="text-center">
                            <div>{{ $tx->transaction_date->format('d M Y') }}</div>
                            <small class="text-muted">{{ $tx->transaction_date->format('H:i') }}</small>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.transactions.show', $tx) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-info">
                                    <i class="fa fa-eye text-info"></i>
                                </a>
                                <a href="{{ route('admin.transactions.pdf', $tx) }}" target="_blank" class="btn btn-sm btn-light border-0 rounded-pill hover-dark">
                                    <i class="fa fa-print text-dark"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-receipt fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada riwayat transaksi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($transactions->hasPages())
    <div class="card-footer bg-white border-0 pt-0 px-4 pb-4">
        {{ $transactions->links() }}
    </div>
    @endif
</div>

<style>
    .hover-info:hover { background-color: #0dcaf0 !important; }
    .hover-info:hover i { color: white !important; }
    .hover-dark:hover { background-color: #212529 !important; }
    .hover-dark:hover i { color: white !important; }
</style>
@endsection
