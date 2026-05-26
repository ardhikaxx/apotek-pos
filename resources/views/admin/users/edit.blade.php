@extends('layouts.app')
@section('title', 'Edit User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Edit User</h4>
    <p class="text-muted small mb-0">Perbarui informasi profil dan hak akses pengguna</p>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Informasi Pengguna</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NAMA LENGKAP</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">ALAMAT EMAIL</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">ROLE PENGGUNA</label>
                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">STATUS AKUN</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">PASSWORD BARU <small class="text-muted fw-normal">(Kosongkan jika tidak diubah)</small></label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                            <button class="btn btn-outline-light border text-muted toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">KONFIRMASI PASSWORD</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            <button class="btn btn-outline-light border text-muted toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
                            <i class="fa fa-save me-2"></i> Perbarui User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
