<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Apotek Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary-color: #0ea5e9;
            --primary-dark: #0284c7;
        }
        body { 
            background-color: #f8fafc; 
            font-family: 'Inter', sans-serif;
            color: #334155;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8) !important;
        }
        .navbar-brand { font-weight: 800; color: var(--primary-color) !important; letter-spacing: -0.02em; }
        .hero-section { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            color: white; 
            padding: 60px 0; 
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        @media (min-width: 992px) {
            .hero-section {
                padding: 80px 0;
                margin-bottom: 50px;
            }
        }
        .hero-section h1 { font-size: 2.5rem; }
        @media (min-width: 992px) {
            .hero-section h1 { font-size: 3.5rem; }
        }
        .hero-section::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.05;
        }
        .footer { 
            background: #0f172a; 
            color: #ffffff; 
            padding: 60px 0; 
            margin-top: 80px; 
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
        }
        .btn-info {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
        }
        .btn-info:hover {
            background-color: var(--primary-dark);
            color: white;
        }
        .nav-link { font-weight: 500; color: #64748b !important; }
        .nav-link:hover { color: var(--primary-color) !important; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('pelanggan.products.index') }}">
                <div class="bg-info bg-opacity-10 px-3 py-2 rounded-3 me-2">
                    <i class="fa fa-mortar-pestle text-info"></i>
                </div>
                APOTEK
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa fa-bars text-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-4 me-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('pelanggan.products.index') }}">Katalog Obat</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill px-3 border-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    <i class="fa fa-user"></i>
                                </div>
                                <span class="small fw-bold">{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2 p-2" style="min-width: 200px;">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger rounded-3 py-2">
                                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-muted fw-bold small">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-info px-4 rounded-pill shadow-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(request()->routeIs('pelanggan.products.index'))
    <div class="hero-section text-center d-flex align-items-center">
        <div class="container position-relative z-1">
            <h1 class="display-3 fw-bold mb-3 tracking-tight">Solusi Kesehatan <span class="text-info">Terpercaya</span></h1>
            <p class="lead opacity-75 mb-0 mx-auto" style="max-width: 600px;">Temukan berbagai kebutuhan obat-obatan dan vitamin asli dengan harga terbaik untuk keluarga Anda.</p>
        </div>
    </div>
    @endif

    <div class="container min-vh-100">
        @yield('content')
    </div>

    <footer class="footer py-5">
        <div class="container text-center">
            <a class="navbar-brand d-inline-flex align-items-center mb-3 p-0 text-white" href="#">
                <div class="bg-info bg-opacity-20 px-3 py-2 rounded-3 me-2">
                    <i class="fa fa-mortar-pestle text-white"></i>
                </div>
                APOTEK
            </a>
            <p class="small opacity-50 mb-4 mx-auto" style="max-width: 500px;">
                Melayani kebutuhan obat-obatan dan vitamin asli dengan pelayanan terpercaya.
                <br>Jl. Kesehatan No. 123, Jakarta Selatan
            </p>
            <div class="d-flex justify-content-center gap-4 mb-4">
                <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-whatsapp fa-lg"></i></a>
            </div>
            <hr class="border-secondary opacity-10 mb-4">
            <p class="small opacity-50 mb-0">&copy; {{ date('Y') }} Apotek. All rights reserved.</p>
        </div>
    </footer>

    <style>
        .hover-opacity-100:hover { opacity: 1 !important; transition: 0.3s; }
        .hover-text-white:hover { color: white !important; }
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
