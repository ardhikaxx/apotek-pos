@extends('layouts.app')
@section('title', 'Obat / Produk')
@section('page-title', 'Obat / Produk')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="fa fa-pills me-2 text-info"></i>Daftar Produk
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Nama</th><th>Kategori</th><th>Satuan</th><th>Harga Jual</th><th>Stok</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                    <td>
                        {{ $product->stock }}
                        @if($product->stock == 0)
                            <span class="badge bg-danger badge-stock ms-1">Habis</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#stockModal{{ $product->id }}">
                            <i class="fa fa-plus-circle"></i> Tambah Stok
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="stockModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Tambah Stok — {{ $product->name }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('apoteker.products.stock', $product) }}">
                                @csrf
                                <div class="modal-body">
                                    <label class="form-label">Jumlah Tambah</label>
                                    <input type="number" name="qty" class="form-control" min="1" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white">{{ $products->links() }}</div>
    @endif
</div>
@endsection
