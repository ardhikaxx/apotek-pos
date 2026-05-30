@extends('layouts.app')
@section('title', 'POS Kasir')
@section('page-title', 'Point of Sale')

@push('styles')
<style>
    .pos-container { min-height: calc(100vh - 180px); }
    .product-search-card { height: 100%; }
    .search-result-item { 
        border: 1px solid #f1f5f9;
        transition: all 0.2s;
        border-radius: 12px;
        cursor: pointer;
    }
    .search-result-item:hover { 
        background-color: #f8fafc;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .cart-card { 
        position: sticky;
        top: 90px;
    }
    @media (max-width: 991.98px) {
        .cart-card { position: static; }
        .pos-container { min-height: auto; }
    }
    .cart-item-qty { width: 60px; text-align: center; }
    #search-results { max-height: 550px; overflow-y: auto; scrollbar-width: thin; }
    .total-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #fff;
        border-radius: 12px;
        padding: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Point of Sale</h4>
        <p class="text-muted small mb-0">Kelola transaksi penjualan obat dengan cepat dan mudah</p>
    </div>
</div>

<div class="row g-3 g-md-4 pos-container">
    <!-- Pencarian Produk -->
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-sm product-search-card">
            <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                <h5 class="fw-bold mb-0"><i class="fa fa-magnifying-glass me-2 text-primary"></i>Cari Obat / Produk</h5>
                <span class="badge bg-light text-muted fw-normal rounded-pill px-3">Scan Barcode atau Ketik Nama</span>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="input-group input-group-lg mb-4 shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-4"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" id="search-input" class="form-control border-0 px-3" placeholder="Ketik nama obat atau kategori..." autocomplete="off">
                </div>
                
                <div id="search-results" class="row g-3">
                    <!-- Produk akan muncul di sini via JS -->
                    <div class="col-12 text-center py-5 opacity-50">
                        <i class="fa fa-box-open fa-3x mb-3"></i>
                        <p>Mulai mengetik untuk mencari produk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keranjang & Pembayaran -->
    <div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-sm cart-card overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0"><i class="fa fa-shopping-basket me-2 text-success"></i>Pesanan Saat Ini</h6>
                <button class="btn btn-sm btn-light rounded-pill" onclick="resetPos()">Bersihkan</button>
            </div>
            
            <div class="card-body p-0">
                <!-- Customer Selection -->
                <div class="p-4 bg-light bg-opacity-50 border-bottom">
                    <label class="form-label small fw-bold text-secondary mb-2">Informasi Pelanggan</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fa fa-user small"></i></span>
                        <select id="customer-id" class="form-select border-start-0">
                            <option value="">-- Umum / Tanpa Nama --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Cart Items -->
                <div class="table-responsive" style="max-height: 300px;">
                    <table class="table table-hover align-middle mb-0" id="cart-table">
                        <thead class="bg-light">
                            <tr class="small text-uppercase">
                                <th class="ps-4 py-2 border-0">Item</th>
                                <th class="py-2 border-0 text-center">Qty</th>
                                <th class="py-2 border-0 text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            <tr id="empty-row">
                                <td colspan="3" class="text-center py-5 opacity-50">
                                    <small class="d-block">Keranjang Masih Kosong</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white p-4 border-0 shadow-lg mt-auto">
                <div class="total-banner mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <small class="opacity-75">Grand Total</small>
                        <h2 class="fw-bold mb-0" id="total-display">Rp 0</h2>
                    </div>
                    <div class="d-flex justify-content-between align-items-center opacity-75">
                        <small>Total Item</small>
                        <small id="item-count">0 items</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nominal Pembayaran (Cash)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold border-end-0">Rp</span>
                        <input type="number" id="paid-input" class="form-control form-control-lg border-start-0 fw-bold" min="0" placeholder="0">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3 border border-dashed border-success">
                    <span class="text-success small fw-bold">Kembalian</span>
                    <h5 class="text-success fw-bold mb-0" id="change-display">Rp 0</h5>
                </div>

                <button id="btn-checkout" class="btn btn-info w-100 py-3 rounded-pill fw-bold shadow-sm" disabled>
                    PROSES PEMBAYARAN <i class="fa fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modern Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <div class="modal-body py-5 text-center">
                <div class="bg-success bg-opacity-10 text-success p-4 rounded-circle d-inline-flex mb-4">
                    <i class="fa fa-check-double fa-3x"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Berhasil!</h4>
                <p class="text-muted mb-4" id="invoice-display">Transaksi telah selesai diproses</p>
                
                <div class="d-grid gap-2 px-3">
                    <a id="btn-print" href="#" target="_blank" class="btn btn-light rounded-pill py-2">
                        <i class="fa fa-print me-2"></i>Cetak Struk
                    </a>
                    <button class="btn btn-success rounded-pill py-2 fw-bold" onclick="resetPos()">
                        Transaksi Baru
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let cart = [];
let searchTimeout;

const formatRp = n => 'Rp ' + parseInt(n).toLocaleString('id-ID');

function fetchProducts(q = '') {
    const el = document.getElementById('search-results');
    el.innerHTML = '<div class="col-12 text-center py-5"><div class="spinner-border text-primary"></div></div>';
    
    fetch(`{{ route('apoteker.pos.search') }}?q=${encodeURIComponent(q)}`, {
        headers: { 
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(async r => {
        if (!r.ok) {
            console.error("HTTP Error", r.status, await r.text());
            throw new Error("HTTP Status " + r.status);
        }
        return r.json();
    })
    .then(data => {
        if (!data.length) { 
            el.innerHTML = '<div class="col-12 text-center py-5 opacity-50"><i class="fa fa-search fa-3x mb-3"></i><p>Produk tidak ditemukan.</p></div>'; 
            return; 
        }
        el.innerHTML = data.map(p =>
            `<div class="col-md-6 col-xl-4">
                <div class="search-result-item p-3 h-100 d-flex flex-column" onclick="addToCart(${p.id},'${p.name.replace(/'/g,"\\'")}',${p.selling_price},${p.stock},'${p.unit}')">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill small px-2 py-1">${p.category.name}</span>
                        <small class="text-muted">Stok: ${p.stock}</small>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">${p.name}</h6>
                    <small class="text-muted mb-3 d-block">Satuan: ${p.unit}</small>
                    <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">${formatRp(p.selling_price)}</span>
                        <i class="fa fa-plus-circle text-light fs-5"></i>
                    </div>
                </div>
            </div>`
        ).join('');
    })
    .catch(err => {
        el.innerHTML = '<div class="col-12 text-center py-5 text-danger"><i class="fa fa-circle-exclamation fa-3x mb-3"></i><p>Gagal memuat data.</p></div>';
    });
}

document.addEventListener('DOMContentLoaded', () => { fetchProducts(); });

document.getElementById('search-input').addEventListener('input', function () {
    clearTimeout(searchTimeout);
    const q = this.value.trim();
    searchTimeout = setTimeout(() => { fetchProducts(q); }, 300);
});

function addToCart(id, name, price, stock, unit) {
    if (stock <= 0) { alert('Stok produk habis!'); return; }
    const existing = cart.find(i => i.id === id);
    if (existing) {
        if (existing.qty >= stock) { alert('Stok tidak mencukupi!'); return; }
        existing.qty++;
        existing.subtotal = existing.qty * price;
    } else {
        cart.push({ id, name, price, stock, unit, qty: 1, subtotal: price });
    }
    renderCart();
}

function updateQty(id, qty) {
    const item = cart.find(i => i.id === id);
    if (!item) return;
    qty = parseInt(qty);
    if (qty < 1) { removeItem(id); return; }
    if (qty > item.stock) { alert('Stok tidak mencukupi!'); return; }
    item.qty = qty;
    item.subtotal = qty * item.price;
    renderCart();
}

function removeItem(id) {
    cart = cart.filter(i => i.id !== id);
    renderCart();
}

function renderCart() {
    const tbody = document.getElementById('cart-body');
    if (!cart.length) {
        tbody.innerHTML = '<tr id="empty-row"><td colspan="3" class="text-center py-5 opacity-50"><small class="d-block">Keranjang Masih Kosong</small></td></tr>';
        updateTotal();
        return;
    }
    tbody.innerHTML = cart.map(item =>
        `<tr>
            <td class="ps-4">
                <div class="d-flex flex-column">
                    <span class="fw-bold small text-dark">${item.name}</span>
                    <small class="text-muted" style="font-size: 0.7rem;">${formatRp(item.price)}</small>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center justify-content-center">
                    <input type="number" class="form-control form-control-sm border-0 bg-light text-center fw-bold cart-item-qty" value="${item.qty}" min="1" max="${item.stock}" onchange="updateQty(${item.id}, this.value)">
                </div>
            </td>
            <td class="pe-4 text-end fw-bold text-dark small">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    ${formatRp(item.subtotal)}
                    <button class="btn btn-link btn-sm text-danger p-0" onclick="removeItem(${item.id})"><i class="fa fa-times-circle"></i></button>
                </div>
            </td>
        </tr>`
    ).join('');
    updateTotal();
}

function updateTotal() {
    const total = cart.reduce((s, i) => s + i.subtotal, 0);
    const count = cart.reduce((s, i) => s + i.qty, 0);
    document.getElementById('total-display').textContent = formatRp(total);
    document.getElementById('item-count').textContent = count + ' items';
    
    const paid = parseFloat(document.getElementById('paid-input').value) || 0;
    const change = paid - total;
    document.getElementById('change-display').textContent = formatRp(change >= 0 ? change : 0);
    document.getElementById('btn-checkout').disabled = !(cart.length && paid >= total);
}

document.getElementById('paid-input').addEventListener('input', updateTotal);

document.getElementById('btn-checkout').addEventListener('click', function () {
    const paid = parseFloat(document.getElementById('paid-input').value);
    const customerId = document.getElementById('customer-id').value;
    const items = cart.map(i => ({ id: i.id, qty: i.qty }));

    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>PROSESING...';

    fetch('{{ route('apoteker.pos.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ items, paid_amount: paid, customer_id: customerId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('invoice-display').textContent = 'ID Transaksi: #' + data.transaction_id;
            document.getElementById('btn-print').href = `/apoteker/pos/${data.transaction_id}/pdf`;
            new bootstrap.Modal(document.getElementById('successModal')).show();
        } else {
            alert(data.message || 'Terjadi kesalahan.');
        }
    })
    .catch(() => alert('Terjadi kesalahan, coba lagi.'))
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = 'PROSES PEMBAYARAN <i class="fa fa-arrow-right ms-2"></i>';
    });
});

function resetPos() {
    cart = [];
    renderCart();
    document.getElementById('paid-input').value = '';
    document.getElementById('search-input').value = '';
    fetchProducts();
    const modalElement = document.getElementById('successModal');
    const modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) modal.hide();
}
</script>
@endpush
