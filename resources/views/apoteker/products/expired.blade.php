@extends('layouts.app')
@section('title', 'Obat Kadaluarsa')
@section('page-title', 'Obat Kadaluarsa')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Obat Kadaluarsa</h4>
        <p class="text-muted small mb-0">Daftar produk yang telah melewati masa berlaku</p>
    </div>
    <div class="d-flex flex-wrap gap-2 mt-3 mt-sm-0">
        <a href="{{ route('apoteker.products.index') }}" class="btn btn-light rounded-pill px-4 py-2 shadow-sm fw-bold text-nowrap d-flex align-items-center">
            <i class="fa fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="alert alert-danger border-0 shadow-sm mb-4 rounded-4 d-flex align-items-center p-3">
    <div class="bg-danger bg-opacity-10 p-2 rounded-3 me-3">
        <i class="fa fa-exclamation-triangle text-danger fs-4"></i>
    </div>
    <div>
        <h6 class="fw-bold mb-0 text-danger">Peringatan Stok Kadaluarsa</h6>
        <p class="small mb-0 opacity-75 text-danger">Segera lakukan penghapusan atau retur untuk produk-produk di bawah ini.</p>
    </div>
</div>

<div class="card overflow-hidden border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
        <h5 class="fw-bold mb-0 text-danger">Produk Kadaluarsa</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3 border-0">#</th>
                        <th class="py-3 border-0">Nama Produk</th>
                        <th class="py-3 border-0">Kategori</th>
                        <th class="py-3 border-0 text-center">Stok</th>
                        <th class="py-3 border-0 text-center">Tgl Kadaluarsa</th>
                        <th class="px-4 py-3 border-0 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="px-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                            <small class="text-muted">{{ $product->unit }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border fw-normal px-3 rounded-pill">{{ $product->category->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-danger">{{ $product->stock }}</span>
                        </td>
                        <td class="text-center">
                            <div class="text-danger fw-bold">{{ \Carbon\Carbon::parse($product->expiry_date)->format('d M Y') }}</div>
                            <small class="text-muted small">Sudah kadaluarsa</small>
                        </td>
                        <td class="px-4 text-end">
                            <form method="POST" action="{{ route('apoteker.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk kadaluarsa ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border-0 rounded-pill hover-danger">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-check-circle fa-3x mb-3 text-success"></i>
                                <p class="fw-bold mb-0">Tidak ada produk kadaluarsa</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .hover-danger:hover { background-color: #dc3545 !important; }
    .hover-danger:hover i { color: white !important; }
</style>
@endsection
