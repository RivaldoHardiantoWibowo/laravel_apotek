<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VitaCare – Sistem Apotek</title>

    <!-- Font + Bootstrap + Custom -->
    <link rel="icon" href="{{ asset('assets/vitacare.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-weight: 600;
            color: #c91919 !important;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1b8f73 !important;
        }

        .btn-logout {
            font-weight: 500;
        }

        .navbar {
            background-color: #f9fdfb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                {{-- Optional logo --}}
                {{-- <img src="{{ asset('assets/logo.svg') }}" alt="VitaCare Logo" height="28" class="me-2"> --}}
                VitaCare
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}"
                            href="{{ url('/home') }}">Dashboard</a>
                    </li>

                    @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('medicine*') ? 'active' : '' }}" href="#"
                            role="button" data-bs-toggle="dropdown">
                            Obat
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('medicine.home') }}">Data Obat</a></li>
                            <li><a class="dropdown-item" href="{{ route('medicine.create') }}">Tambah</a></li>
                            <li><a class="dropdown-item" href="{{ route('medicine.stock') }}">Stok</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('account*') ? 'active' : '' }}"
                            href="{{ route('account.home') }}">Kelola Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('order*') ? 'active' : '' }}"
                            href="{{ route('order.data') }}">Data Pembelian</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kasir/order*') ? 'active' : '' }}"
                            href="{{ route('kasir.order.index') }}">Pembelian</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-lg-3 btn-logout">
                                Logout
                            </button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- layout template -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById("salesChart");
        if (!canvas) return;

        new Chart(canvas, {
            type: "line",
            data: {
                labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
                datasets: [{
                    label: "Penjualan",
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: "top" },
                    title: { display: true, text: "Penjualan 7 Hari Terakhir" }
                }
            }
        });
    });
    </script>

    @stack('script')
</body>

</html>
