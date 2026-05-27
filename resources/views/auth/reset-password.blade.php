@extends('layouts.auth')

@section('content')
<div class="card p-4 p-md-5">
    <div class="brand-logo">
        <i class="fa fa-shield-alt fa-2x text-info"></i>
    </div>
    
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Ubah Password</h4>
        <p class="text-muted small">Silakan masukkan password baru Anda</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 small py-2 mb-4">
            <i class="fa fa-exclamation-circle me-1"></i>{{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Password Baru</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock small"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required autofocus>
                <button class="btn btn-outline-light border-start-0 toggle-password text-secondary" style="border-color: #e2e8f0;" type="button">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Konfirmasi Password Baru</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock small"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                <button class="btn btn-outline-light border-start-0 toggle-password text-secondary" style="border-color: #e2e8f0;" type="button">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-info w-100 text-white fw-bold shadow-sm">
            UBAH PASSWORD <i class="fa fa-check-circle ms-2"></i>
        </button>
    </form>
</div>
@endsection
