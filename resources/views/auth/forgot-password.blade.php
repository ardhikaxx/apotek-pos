@extends('layouts.auth')

@section('content')
<div class="card p-4 p-md-5">
    <div class="brand-logo">
        <i class="fa fa-key fa-2x text-info"></i>
    </div>
    
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Lupa Password?</h4>
        <p class="text-muted small">Masukkan email Anda untuk verifikasi akun</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 small py-2 mb-4">
            <i class="fa fa-exclamation-circle me-1"></i>{{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope-open small"></i></span>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
            </div>
        </div>

        <button type="submit" class="btn btn-info w-100 text-white fw-bold shadow-sm mb-4">
            VERIFIKASI EMAIL <i class="fa fa-arrow-right ms-2"></i>
        </button>

        <div class="text-center">
            <p class="small text-muted mb-0">Ingat password Anda? <a href="{{ route('login') }}" class="text-info text-decoration-none fw-bold">Login di sini</a></p>
        </div>
    </form>
</div>
@endsection
