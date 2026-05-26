@extends('layouts.auth')

@section('content')
<div class="card p-4 p-md-5 my-4">
    <div class="brand-logo">
        <i class="fa fa-user-plus fa-2x text-info"></i>
    </div>
    
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Daftar Akun</h4>
        <p class="text-muted small">Lengkapi data untuk bergabung sebagai pelanggan</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 small py-2 mb-4">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user small"></i></span>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope-open small"></i></span>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Nomor Telepon</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-phone small"></i></span>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-shield-alt small"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                <button class="btn btn-outline-light border-start-0 toggle-password text-secondary" style="border-color: #e2e8f0;" type="button">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-check-circle small"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                <button class="btn btn-outline-light border-start-0 toggle-password text-secondary" style="border-color: #e2e8f0;" type="button">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-info w-100 text-white fw-bold shadow-sm mb-4">
            CREATE ACCOUNT <i class="fa fa-user-check ms-2"></i>
        </button>

        <div class="text-center">
            <p class="small text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-info text-decoration-none fw-bold">Login Sekarang</a></p>
        </div>
    </form>
</div>
@endsection
