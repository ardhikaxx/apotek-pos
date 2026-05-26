@extends('layouts.app')
@section('title', 'Detail Pembelian Stok')
@section('page-title', 'Detail Pembelian')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Invoice Pembelian #PUR-{{ str_pad($purchase->id, 5, '0', STR_PAD_LEFT) }}</h4>
        <p class="text-muted small mb-0">Rincian detail transaksi stok masuk dari supplier</p>
    </div>
    <a href="{{ route('admin.purchases.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm">
        <i class="fa fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-sm mb-4 h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-receipt me-2 text-primary"></i>Ringkasan Transaksi</h6>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="p-3 bg-light rounded-4 mb-4 text-center">
                    <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.05em;">Total Pembelian</small>
                    <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($purchase->total, 0, ',', '.') }}</h3>
                </div>

                <div class="list-group list-group-flush border-0">
                    <div class="list-group-item bg-transparent border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">No. Referensi</span>
                        <span class="fw-bold small">#PUR-{{ str_pad($purchase->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="list-group-item bg-transparent border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Tanggal</span>
                        <span class="fw-bold small">{{ \Carbon\Carbon::parse($purchase->purchase_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="list-group-item bg-transparent border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Supplier</span>
                        <span class="fw-bold small">{{ $purchase->supplier->name }}</span>
                    </div>
                    <div class="list-group-item bg-transparent border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Admin / Petugas</span>
                        <span class="fw-bold small text-primary">{{ $purchase->user->name }}</span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <button class="btn btn-outline-info w-100 rounded-pill py-2 fw-bold small" onclick="window.print()">
                        <i class="fa fa-print me-2"></i>CETAK INVOICE
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-box me-2 text-primary"></i>Daftar Item Barang</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase fw-bold">
                            <tr>
                                <th class="ps-4 py-3 border-0">Produk</th>
                                <th class="py-3 border-0 text-center">Jumlah</th>
                                <th class="py-3 border-0 text-end">Harga Satuan</th>
                                <th class="pe-4 py-3 border-0 text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->items as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded me-3">
                                            <i class="fa fa-pills"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">{{ $item->product->name }}</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Satuan: {{ $item->product->unit }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark rounded-pill px-3">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="small">Rp {{ number_format($item->purchase_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="fw-bold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light bg-opacity-50">
                            <tr class="fw-bold">
                                <td colspan="3" class="ps-4 py-3 text-end border-0">Grand Total</td>
                                <td class="pe-4 py-3 text-end text-primary border-0">Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
