@extends('layouts.app')
@section('title', 'Katalog Obat / Produk')
@section('page-title', 'Katalog Obat')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Manajemen Inventori</h4>
        <p class="text-muted small mb-0">Kelola stok dan informasi obat di apotek Anda</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('apoteker.products.expired') }}" class="btn btn-warning rounded-pill px-3 shadow-sm fw-bold">
            <i class="fa fa-hourglass-half me-1"></i> Kadaluarsa
        </a>
        <a href="{{ route('apoteker.products.create') }}" class="btn btn-info text-white rounded-pill px-4 shadow-sm fw-bold">
            <i class="fa fa-plus me-1"></i> Tambah
        </a>
    </div>
</div>

<div class="card overflow-hidden border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 px-3 px-md-4 border-bottom-0">
        <form action="{{ route('apoteker.products.index') }}" method="GET" class="row g-2">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Cari nama obat..." value="{{ request('search') }}">
                    <button class="btn btn-info text-white px-3" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="px-4 py-3 border-0 small text-uppercase fw-bold">Produk</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold">Kategori</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-center">Stok</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold">Harga Jual</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-center">Kadaluarsa</th>
                        <th class="px-4 py-3 border-0 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 text-info p-2 rounded me-3">
                                    <i class="fa fa-pills"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $product->name }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">Satuan: {{ $product->unit }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border rounded-pill px-3 fw-normal">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <span class="fw-bold {{ $product->stock <= 10 ? 'text-danger' : 'text-dark' }}">
                                    {{ number_format($product->stock) }}
                                </span>
                                @if($product->stock == 0)
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-0" style="font-size: 0.6rem;">Kosong</span>
                                @elseif($product->stock <= 10)
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2 py-0" style="font-size: 0.6rem;">Menipis</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-info">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            @if($product->expiry_date)
                                @php $isExpired = \Carbon\Carbon::parse($product->expiry_date)->isPast(); @endphp
                                <span class="badge {{ $isExpired ? 'bg-danger text-danger' : 'bg-light text-secondary border' }} bg-opacity-10 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.7rem;">
                                    {{ \Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="px-4 text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0 rounded-pill" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                    <li>
                                        <button class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#stockModal{{ $product->id }}">
                                            <i class="fa fa-plus-circle me-2 text-success"></i> Tambah Stok
                                        </button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('apoteker.products.edit', $product) }}">
                                            <i class="fa fa-edit me-2 text-warning"></i> Edit Detail
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider opacity-50"></li>
                                    <li>
                                        <form method="POST" action="{{ route('apoteker.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item py-2 text-danger">
                                                <i class="fa fa-trash me-2"></i> Hapus Produk
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Modern Modal Tambah Stok -->
                    <div class="modal fade" id="stockModal{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title fw-bold">Tambah Stok</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="{{ route('apoteker.products.stock', $product) }}">
                                    @csrf
                                    <div class="modal-body text-center pt-3">
                                        <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle d-inline-flex mb-3">
                                            <i class="fa fa-box-open fs-4"></i>
                                        </div>
                                        <p class="small text-muted mb-3">{{ $product->name }}</p>
                                        <div class="px-3">
                                            <label class="form-label small fw-bold d-block text-start">Jumlah Tambah</label>
                                            <input type="number" name="qty" class="form-control form-control-lg text-center fw-bold" min="1" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0 px-4 pb-4">
                                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2 shadow-sm">Simpan Stok Baru</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center opacity-25">
                                <i class="fa fa-pills fa-4x mb-3"></i>
                                <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
                                <p class="mb-0">Silakan tambah produk baru ke dalam sistem</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white border-top-0 py-3 px-4">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
