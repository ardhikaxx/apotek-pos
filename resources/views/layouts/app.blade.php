<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Apotek POS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --primary-color: #0ea5e9;
            --bg-light: #f8fafc;
        }
        body { 
            background: var(--bg-light); 
            font-family: 'Inter', sans-serif;
            color: #334155;
        }
        .sidebar { 
            height: 100vh; 
            background: var(--sidebar-bg); 
            width: 260px; 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        .sidebar .brand { 
            padding: 1.5rem; 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link { 
            color: #94a3b8; 
            padding: 0.8rem 1.2rem; 
            border-radius: 10px; 
            margin: 4px 12px; 
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover { 
            background: var(--sidebar-hover); 
            color: #fff; 
        }
        .sidebar .nav-link.active { 
            background: var(--primary-color); 
            color: #fff; 
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }
        .sidebar .nav-link i { 
            width: 24px; 
            font-size: 1.1rem;
        }
        .main-content { 
            margin-left: 260px; 
            padding: 2rem; 
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }
            .sidebar.mobile-active {
                transform: translateX(0) !important;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .sidebar-overlay {
                visibility: hidden;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                z-index: 1040;
                opacity: 0;
                transition: all 0.3s ease;
                pointer-events: none;
            }
            .sidebar-overlay.mobile-active {
                visibility: visible;
                opacity: 1;
                pointer-events: auto;
            }
            .topbar {
                margin: -1rem -1rem 1rem;
                padding: 1rem;
            }
        }

        .topbar { 
            background: rgba(255,255,255,0.8); 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0; 
            padding: 1rem 2rem; 
            margin: -2rem -2rem 2rem; 
            position: sticky;
            top: 0;
            z-index: 900;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }
        .btn-info { background-color: var(--primary-color); border-color: var(--primary-color); color: #fff; }
        .btn-info:hover { background-color: #0284c7; border-color: #0284c7; color: #fff; }
        
        .user-profile-section {
            margin-top: auto;
            padding: 1.2rem;
            background: rgba(255,255,255,0.03);
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        
        /* Custom Pagination */
        .pagination { margin-bottom: 0; }
        .page-link { 
            border: none; 
            margin: 0 3px; 
            border-radius: 8px !important; 
            color: #64748b;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 0.8rem;
        }
        .page-item.active .page-link { background-color: var(--primary-color); box-shadow: 0 4px 10px rgba(14, 165, 233, 0.2); }
        .page-link:hover { background-color: #f1f5f9; color: var(--primary-color); }

        /* Modern Thin Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.2); border-radius: 20px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.5); }
        
        /* Firefox Support */
        * { scrollbar-width: thin; scrollbar-color: rgba(148, 163, 184, 0.2) transparent; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="sidebar d-flex flex-column" id="sidebar">
        <div class="brand">
            <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fa fa-clinic-medical text-info fs-4"></i>
            </div>
            <span class="text-white fw-bold fs-5 tracking-tight">Apotek POS</span>
            <button class="btn btn-link text-white d-lg-none ms-auto p-0" id="sidebarClose">
                <i class="fa fa-times fs-5"></i>
            </button>
        </div>
        
        <div class="py-3 overflow-y-auto grow">
            <small class="text-uppercase px-4 mb-2 d-block text-white opacity-50 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.05em;">Menu Utama</small>
            <nav class="nav flex-column">
                @if(auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-gauge-high me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fa fa-user-shield me-2"></i> Manajemen User
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="fa fa-users me-2"></i> Pelanggan
                    </a>
                    
                    <small class="text-uppercase px-4 mt-4 mb-2 d-block text-white opacity-50 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.05em;">Inventori & Stok</small>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fa fa-tags me-2"></i> Kategori
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fa fa-pills me-2"></i> Obat / Produk
                    </a>
                    <a href="{{ route('admin.suppliers.index') }}" class="nav-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                        <i class="fa fa-truck me-2"></i> Supplier
                    </a>
                    <a href="{{ route('admin.purchases.index') }}" class="nav-link {{ request()->routeIs('admin.purchases.*') ? 'active' : '' }}">
                        <i class="fa fa-shopping-cart me-2"></i> Pembelian Stok
                    </a>
                    
                    <small class="text-uppercase px-4 mt-4 mb-2 d-block text-white opacity-50 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.05em;">Transaksi</small>
                    <a href="{{ route('admin.transactions.create') }}" class="nav-link {{ request()->routeIs('admin.transactions.create') ? 'active' : '' }}">
                        <i class="fa fa-cash-register me-2"></i> POS / Kasir
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" class="nav-link {{ request()->routeIs('admin.transactions.index') ? 'active' : '' }}">
                        <i class="fa fa-receipt me-2"></i> Riwayat Transaksi
                    </a>
                    <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <i class="fa fa-chart-line me-2"></i> Laporan
                    </a>
                @elseif(auth()->user()->role->name === 'apoteker')
                    <a href="{{ route('apoteker.dashboard') }}" class="nav-link {{ request()->routeIs('apoteker.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-gauge-high me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('apoteker.pos') }}" class="nav-link {{ request()->routeIs('apoteker.pos') ? 'active' : '' }}">
                        <i class="fa fa-cash-register me-2"></i> POS / Kasir
                    </a>
                    <a href="{{ route('apoteker.products.index') }}" class="nav-link {{ request()->routeIs('apoteker.products.*') ? 'active' : '' }}">
                        <i class="fa fa-pills me-2"></i> Obat / Produk
                    </a>
                    <a href="{{ route('apoteker.reports') }}" class="nav-link {{ request()->routeIs('apoteker.reports*') ? 'active' : '' }}">
                        <i class="fa fa-chart-line me-2"></i> Laporan Hari Ini
                    </a>
                @elseif(auth()->user()->role->name === 'pelanggan')
                    <a href="{{ route('pelanggan.products.index') }}" class="nav-link {{ request()->routeIs('pelanggan.products.*') ? 'active' : '' }}">
                        <i class="fa fa-pills me-2"></i> Katalog Obat
                    </a>
                @endif
            </nav>
        </div>

        <div class="user-profile-section">
            <div class="d-flex align-items-center mb-3">
                <div class="shrink-0">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <div class="grow ms-3 overflow-hidden">
                    <h6 class="text-white mb-0 text-truncate" style="font-size: 0.85rem;">{{ auth()->user()->name }}</h6>
                    <span class="badge bg-info bg-opacity-10 text-info text-uppercase" style="font-size: 0.6rem;">{{ auth()->user()->role->name }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger w-100 border-0 text-start px-3 py-2">
                    <i class="fa fa-sign-out-alt me-2"></i> Keluar Sistem
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button type="button" class="btn text-dark d-lg-none me-3 p-0 border-0" id="sidebarToggle">
                    <i class="fa fa-bars fs-4"></i>
                </button>
                <div>
                    <nav aria-label="breadcrumb" class="mb-1 d-none d-md-block">
                        <ol class="breadcrumb mb-0" style="font-size: 0.75rem;">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Aplikasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Dashboard')</li>
                        </ol>
                    </nav>
                    <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-end d-none d-md-block me-3">
                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu Server</small>
                    <span class="fw-semibold small">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown">
                        <div class="bg-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                            <i class="fa fa-bell text-muted"></i>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-3" style="width: 300px; border-radius: 12px;">
                        <h6 class="fw-bold mb-3">Notifikasi</h6>
                        <div class="text-center py-4">
                            <i class="fa fa-bell-slash text-muted fa-2x mb-2 opacity-25"></i>
                            <p class="text-muted small mb-0">Tidak ada notifikasi baru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="fa fa-check-circle text-success"></i>
                    </div>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show rounded-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="fa fa-exclamation-circle text-danger"></i>
                    </div>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function toggleSidebar(e) {
                if (e) e.preventDefault();
                sidebar.classList.toggle('mobile-active');
                sidebarOverlay.classList.toggle('mobile-active');
                document.body.classList.toggle('overflow-hidden');
            }

            if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
            if (sidebarClose) sidebarClose.addEventListener('click', toggleSidebar);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.closest('.input-group').querySelector('input');
                    const icon = this.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
