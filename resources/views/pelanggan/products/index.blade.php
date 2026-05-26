@extends('layouts.pelanggan')
@section('title', 'Katalog Obat')
@section('page-title', 'Katalog Obat')

@section('content')
<!-- Service Features -->
<div class="row mb-5 g-4 mt-n5 position-relative z-2">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle">
                    <i class="fa fa-shield-halved fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">100% Produk Asli</h6>
                    <small class="text-muted">Jaminan kualitas dari pabrik resmi</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle">
                    <i class="fa fa-tags fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Harga Terjangkau</h6>
                    <small class="text-muted">Lebih hemat untuk keluarga Anda</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle">
                    <i class="fa fa-user-doctor fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Apoteker Berlisensi</h6>
                    <small class="text-muted">Konsultasi gratis via WhatsApp</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5 align-items-center">
    <div class="col-lg-5">
        <h4 class="fw-bold mb-1">Temukan Kebutuhan Medis Anda</h4>
        <p class="text-muted small mb-0">Cari dari ratusan produk kesehatan yang kami sediakan</p>
    </div>
    <div class="col-lg-7 mt-3 mt-lg-0">
        <div class="card border-0 shadow-sm rounded-pill overflow-hidden bg-white">
            <div class="card-body p-1">
                <form action="{{ route('pelanggan.products.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 ps-4">
                            <i class="fa fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 shadow-none py-3" placeholder="Ketik nama obat atau vitamin..." value="{{ request('search') }}">
                        <button class="btn btn-info px-4 rounded-pill me-1 my-1 fw-bold shadow-sm">
                            CARI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    @forelse($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card h-100 p-3 product-card border-light border-opacity-50">
            <div class="card-body text-center d-flex flex-column p-0">
                <div class="bg-light rounded-4 py-5 mb-4 position-relative overflow-hidden product-image-container">
                    <i class="fa fa-pills fa-4x text-info opacity-25"></i>
                    @if($product->stock <= 5 && $product->stock > 0)
                        <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark rounded-pill fw-bold" style="font-size: 0.65rem;">Hampir Habis</span>
                    @endif
                    <div class="hover-overlay">
                        <a href="{{ route('pelanggan.products.show', $product) }}" class="btn btn-white btn-sm rounded-pill px-3 fw-bold">Detail Cepat</a>
                    </div>
                </div>
                
                <h6 class="fw-bold text-dark mb-1 px-2 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                <div class="d-flex justify-content-center mb-3">
                    <span class="badge bg-light text-secondary rounded-pill px-3 py-1 fw-normal" style="font-size: 0.7rem;">
                        {{ $product->category->name }}
                    </span>
                </div>
                
                <div class="mt-auto pt-3 border-top">
                    <div class="mb-3 px-2">
                        <div class="text-primary h5 fw-bold mb-1">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                        @if($product->stock > 0)
                            <small class="text-success fw-bold"><i class="fa fa-circle small me-1" style="font-size: 0.5rem;"></i> Tersedia</small>
                        @else
                            <small class="text-danger fw-bold"><i class="fa fa-circle small me-1" style="font-size: 0.5rem;"></i> Stok Habis</small>
                        @endif
                    </div>
                    
                    <a href="{{ route('pelanggan.products.show', $product) }}" class="btn btn-outline-info w-100 rounded-pill py-2 fw-bold small hover-info transition">
                        LIHAT SELENGKAPNYA
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="opacity-25 mb-4 text-info">
            <i class="fa fa-magnifying-glass-plus fa-5x"></i>
        </div>
        <h4 class="fw-bold text-dark">Yah, produk tidak ditemukan...</h4>
        <p class="text-muted">Coba cari dengan kata kunci lain atau hubungi admin kami.</p>
        <a href="{{ route('pelanggan.products.index') }}" class="btn btn-info rounded-pill px-4 mt-2 shadow-sm">Reset Pencarian</a>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-5 mb-5">
    {{ $products->links() }}
</div>

<style>
    .mt-n5 { margin-top: -3rem !important; }
    .product-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .product-card:hover {
        border-color: var(--primary-color) !important;
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
    .product-image-container {
        transition: all 0.3s ease;
    }
    .hover-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(14, 165, 233, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .product-card:hover .hover-overlay {
        opacity: 1;
    }
    .btn-white {
        background: white;
        color: var(--primary-color);
        border: none;
    }
    .btn-white:hover {
        background: #f8fafc;
        color: var(--primary-dark);
    }
</style>
@endsection

