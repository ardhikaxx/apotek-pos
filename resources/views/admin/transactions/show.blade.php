@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1">Detail Transaksi</h4>
                <p class="text-muted small mb-0">Informasi lengkap transaksi penjualan</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold flex-grow-1 flex-sm-grow-0">
                    <i class="fa fa-arrow-left me-2"></i> Kembali
                </a>
                <a href="{{ route('admin.transactions.pdf', $transaction) }}" class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold flex-grow-1 flex-sm-grow-0" target="_blank">
                    <i class="fa fa-print me-2"></i> Cetak Invoice
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden mb-4">
            <div class="card-header bg-primary bg-opacity-10 border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-primary">Invoice: {{ $transaction->invoice_number }}</h5>
                    <span class="badge bg-primary rounded-pill px-3">{{ $transaction->transaction_date->format('d M Y H:i') }}</span>
                </div>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="row mb-4">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="form-label fw-bold text-secondary small text-uppercase mb-1">Kasir</label>
                        <div class="h6 fw-bold mb-0 text-dark">{{ $transaction->user->name }}</div>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <label class="form-label fw-bold text-secondary small text-uppercase mb-1">Pelanggan</label>
                        <div class="h6 fw-bold mb-0 text-dark">{{ $transaction->customer->name ?? 'Pelanggan Umum' }}</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="bg-light text-secondary small text-uppercase fw-bold">
                            <tr>
                                <th class="py-3">Produk</th>
                                <th class="py-3 text-center">Qty</th>
                                <th class="py-3 text-end">Harga Satuan</th>
                                <th class="py-3 text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->items as $item)
                            <tr>
                                <td class="py-3">
                                    <div class="fw-bold text-dark">{{ $item->product->name }}</div>
                                    <small class="text-muted">{{ $item->product->unit }}</small>
                                </td>
                                <td class="py-3 text-center">{{ $item->qty }}</td>
                                <td class="py-3 text-end">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="py-3 text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top-0">
                            <tr>
                                <td colspan="3" class="text-end py-3 text-secondary">Total Belanja</td>
                                <td class="text-end py-3 h5 fw-bold mb-0">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end py-2 text-secondary border-0">Jumlah Bayar</td>
                                <td class="text-end py-2 border-0">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end py-2 text-success fw-bold border-0">Kembalian</td>
                                <td class="text-end py-2 text-success fw-bold border-0 h5 mb-0">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
