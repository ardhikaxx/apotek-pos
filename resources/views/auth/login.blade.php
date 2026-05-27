@extends('layouts.auth')

@section('content')
<div class="card p-4 p-md-5">
    <div class="brand-logo">
        <i class="fa fa-clinic-medical fa-2x text-info"></i>
    </div>
    
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Selamat Datang!</h4>
        <p class="text-muted small">Silakan login untuk mengakses layanan Apotek POS</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 small py-2 mb-4">
            <i class="fa fa-check-circle me-1"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 small py-2 mb-4">
            <i class="fa fa-exclamation-circle me-1"></i>{{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope-open small"></i></span>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}" class="small text-info text-decoration-none fw-bold">Lupa password?</a>
        </div>

        <button type="submit" class="btn btn-info w-100 text-white fw-bold shadow-sm mb-4">
            SIGN IN <i class="fa fa-arrow-right ms-2"></i>
        </button>

        <div class="text-center">
            <p class="small text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-info text-decoration-none fw-bold">Daftar Pelanggan</a></p>
        </div>
    </form>
</div>
@endsection
