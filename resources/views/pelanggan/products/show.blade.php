@extends('layouts.pelanggan')
@section('title', $product->name . ' - Detail Obat')
@section('page-title', 'Detail Obat')

@section('content')
<div class="row justify-content-center mb-5 py-1">
    <div class="col-lg-10">
        <nav aria-label="breadcrumb" class="mb-4 mt-5">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.products.index') }}" class="text-decoration-none text-muted">Katalog</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="card overflow-hidden border-0 shadow-lg" style="border-radius: 30px;">
            <div class="row g-0">
                <div class="col-md-5 bg-light d-flex align-items-center justify-content-center py-5 position-relative">
                    <div class="text-center p-4">
                        <div class="bg-white p-5 rounded-circle shadow-sm mb-4 d-inline-flex animate-float">
                            <i class="fa fa-pills fa-5x text-info opacity-50"></i>
                        </div>
                        <h6 class="text-uppercase tracking-widest text-muted small fw-bold mb-0">Kode Produk</h6>
                        <code class="bg-white px-3 py-1 rounded-pill shadow-sm mt-2 d-inline-block text-dark">#PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</code>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold small mb-3">
                                <i class="fa fa-tag me-1"></i> {{ $product->category->name }}
                            </span>
                            <h1 class="fw-bold text-dark mb-2 display-6">{{ $product->name }}</h1>
                            <p class="text-muted mb-0">Tersedia dalam satuan: <span class="fw-bold text-dark">{{ $product->unit }}</span></p>
                        </div>

                        <div class="p-4 bg-info bg-opacity-10 rounded-4 mb-4 border border-info border-opacity-10">
                            <small class="text-info d-block fw-bold text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.1em;">Harga Retail Resmi</small>
                            <h2 class="fw-bold text-dark mb-0">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</h2>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-6">
                                <div class="p-3 border rounded-4 h-100">
                                    <small class="text-muted d-block mb-1">Status Stok</small>
                                    @if($product->stock > 0)
                                        <span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i> Tersedia</span>
                                    @else
                                        <span class="text-danger fw-bold"><i class="fa fa-times-circle me-1"></i> Stok Habis</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-4 h-100">
                                    <small class="text-muted d-block mb-1">Masa Berlaku</small>
                                    <span class="fw-bold text-dark">{{ $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->translatedFormat('d M Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="{{ route('pelanggan.products.index') }}" class="btn btn-light rounded-pill py-3 fw-bold border">
                                <i class="fa fa-arrow-left me-2"></i>KEMBALI KE KATALOG
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mt-lg-5 g-3 g-lg-4">
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 align-items-center bg-white p-3 rounded-4 shadow-sm h-100">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle shrink-0">
                        <i class="fa fa-user-shield fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Privasi Terjamin</h6>
                        <p class="small text-muted mb-0">Kemasan rapi & tertutup</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 align-items-center bg-white p-3 rounded-4 shadow-sm h-100">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle shrink-0">
                        <i class="fa fa-certificate fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Original 100%</h6>
                        <p class="small text-muted mb-0">Langsung dari distributor</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 align-items-center bg-white p-3 rounded-4 shadow-sm h-100">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle shrink-0">
                        <i class="fa fa-clock-rotate-left fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Layanan 24/7</h6>
                        <p class="small text-muted mb-0">Siap melayani kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .breadcrumb {
        display: flex;
        align-items: center;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 0.7rem;
        color: #cbd5e1;
        display: inline-block;
        vertical-align: middle;
        padding-top: 2px; /* Fine-tuned alignment */
    }
</style>
@endsection
