@extends('layouts.app')
@section('title', 'Catat Pembelian Stok')
@section('page-title', 'Catat Pembelian')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold mb-1">Pencatatan Stok Masuk</h4>
        <p class="text-muted small">Input data pembelian obat dari supplier untuk menambah inventori</p>
    </div>
</div>

<form action="{{ route('admin.purchases.store') }}" method="POST">
    @csrf
    <div class="row g-4">
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-info-circle me-2 text-primary"></i>Informasi Pembelian</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Pilih Supplier</label>
                        <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror rounded-3" required>
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Tanggal Transaksi</label>
                        <input type="date" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror rounded-3" value="{{ date('Y-m-d') }}" required>
                        @error('purchase_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info text-white fw-bold rounded-pill py-2 shadow-sm">
                            <i class="fa fa-save me-2"></i>SIMPAN PEMBELIAN
                        </button>
                        <a href="{{ route('admin.purchases.index') }}" class="btn btn-light rounded-pill py-2">Batal</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-list-check me-2 text-primary"></i>Detail Item Produk</h6>
                    <button type="button" id="add-item" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="fa fa-plus me-1"></i> Tambah Baris
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0" id="purchase-table">
                            <thead class="bg-light text-secondary small text-uppercase fw-bold">
                                <tr>
                                    <th class="ps-4 py-3 border-0">Produk</th>
                                    <th class="py-3 border-0 text-center" style="width: 120px;">Jumlah</th>
                                    <th class="py-3 border-0" style="width: 220px;">Harga Beli Satuan</th>
                                    <th class="pe-4 py-3 border-0" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="purchase-items">
                                <tr>
                                    <td class="ps-4">
                                        <select name="items[0][product_id]" class="form-select border-0 bg-light rounded-3" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach($products as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->unit }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][quantity]" class="form-control border-0 bg-light rounded-3 text-center fw-bold" min="1" required placeholder="0">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0 fw-bold text-muted">Rp</span>
                                            <input type="number" name="items[0][purchase_price]" class="form-control border-0 bg-light rounded-end-3" min="0" required placeholder="0">
                                        </div>
                                    </td>
                                    <td class="pe-4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 text-center opacity-50 bg-light border-top" id="empty-state" style="display: none;">
                        <i class="fa fa-boxes-stacked fa-2x mb-2"></i>
                        <p class="small mb-0">Klik tombol "Tambah Baris" untuk menginput produk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const tbody = document.getElementById('purchase-items');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="ps-4">
                <select name="items[${itemIndex}][product_id]" class="form-select border-0 bg-light rounded-3" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->unit }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control border-0 bg-light rounded-3 text-center fw-bold" min="1" required placeholder="0">
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 fw-bold text-muted">Rp</span>
                    <input type="number" name="items[${itemIndex}][purchase_price]" class="form-control border-0 bg-light rounded-end-3" min="0" required placeholder="0">
                </div>
            </td>
            <td class="pe-4 text-end">
                <button type="button" class="btn btn-sm btn-link text-danger p-0 remove-item"><i class="fa fa-circle-xmark fs-5"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
        itemIndex++;
        checkEmpty();
    });

    document.getElementById('purchase-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.parentElement.classList.contains('remove-item')) {
            const btn = e.target.classList.contains('remove-item') ? e.target : e.target.parentElement;
            btn.closest('tr').remove();
            checkEmpty();
        }
    });

    function checkEmpty() {
        const rows = document.querySelectorAll('#purchase-items tr');
        document.getElementById('empty-state').style.display = rows.length === 0 ? 'block' : 'none';
    }
</script>
@endpush
@endsection
