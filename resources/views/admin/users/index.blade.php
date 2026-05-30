@extends('layouts.app')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Manajemen User</h4>
        <p class="text-muted small mb-0">Kelola hak akses dan pengguna sistem</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold text-white">
        <i class="fa fa-plus me-2"></i> Tambah User
    </a>
</div>

<div class="card overflow-hidden">
    <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
        <h5 class="fw-bold mb-0">Daftar Pengguna</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap-table">
                <thead class="bg-light">
                    <tr>
                        <th class="px-3 px-md-4 py-3">#</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3 text-nowrap">Email</th>
                        <th class="py-3">Role</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="px-3 px-md-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="px-3 px-md-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                        </td>
                        <td class="text-nowrap">{{ $user->email }}</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-1 fw-bold bg-opacity-10 {{ $user->role->name === 'admin' ? 'bg-danger text-danger' : 'bg-info text-info' }}">
                                {{ $user->role->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-1 fw-bold bg-opacity-10 {{ $user->is_active ? 'bg-success text-success' : 'bg-secondary text-secondary' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-3 px-md-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light border-0 rounded-pill hover-warning">
                                    <i class="fa fa-edit text-warning"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light border-0 rounded-pill hover-danger">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25">
                                <i class="fa fa-users fa-3x mb-3"></i>
                                <p class="fw-bold mb-0">Belum ada user</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-transparent border-0 px-3 px-md-4 py-3">
        {{ $users->links() }}
    </div>
    @endif
</div>

<style>
    .hover-warning:hover { background-color: #ffc107 !important; }
    .hover-warning:hover i { color: white !important; }
    .hover-danger:hover { background-color: #dc3545 !important; }
    .hover-danger:hover i { color: white !important; }
</style>
@endsection
