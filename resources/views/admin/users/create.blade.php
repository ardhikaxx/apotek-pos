@extends('layouts.app')
@section('title', 'Tambah User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Tambah User</h4>
        <p class="text-muted small mb-0">Buat akun pengguna baru dalam sistem</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">
        <i class="fa fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
                <h5 class="fw-bold mb-0">Form User</h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">NAMA LENGKAP</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">ALAMAT EMAIL</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">ROLE PENGGUNA</label>
                                <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                                @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Placeholder for layout balance if needed -->
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                                    <button class="btn btn-outline-light border text-muted toggle-password" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">KONFIRMASI PASSWORD</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                                    <button class="btn btn-outline-light border text-muted toggle-password" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="reset" class="btn btn-light rounded-pill px-4 fw-bold">Reset</button>
                        <button type="submit" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
                            <i class="fa fa-save me-2"></i> Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
