<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel - TR11 Shop</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #102a43;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            min-height: 74px;
            background: #ffffff;
            border-bottom: 1px solid #e5eaf0;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 12px 7%;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;

            background: linear-gradient(
                135deg,
                #092c4c,
                #1769aa
            );

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
            font-size: 18px;

            box-shadow: 0 5px 15px rgba(23, 105, 170, 0.25);
        }

        .brand-text strong {
            display: block;
            font-size: 15px;
            color: #092c4c;
        }

        .brand-text span {
            display: block;
            font-size: 10px;
            color: #7b8a9a;
            letter-spacing: 1px;
            margin-top: 3px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;
            background: #092c4c;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
        }

        .user-info strong {
            display: block;
            font-size: 14px;
        }

        .user-info span {
            display: block;
            font-size: 11px;
            color: #1769aa;
            font-weight: bold;
        }

        /* LOGOUT */

        .logout-form {
            margin-left: 8px;
        }

        .logout-button {
            border: none;
            background: #dc3545;
            color: white;

            padding: 9px 15px;
            border-radius: 9px;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .logout-button:hover {
            background: #b42333;
            transform: translateY(-1px);
        }

        /* =========================
           MAIN
        ========================= */

        .container {
            width: 86%;
            max-width: 1200px;
            margin: auto;
            padding: 45px 0;
        }

        .breadcrumb {
            font-size: 12px;
            font-weight: bold;
            color: #1769aa;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 34px;
            margin-bottom: 8px;
        }

        .page-description {
            color: #718096;
            margin-bottom: 30px;
        }

        /* =========================
           ADMIN HEADER
        ========================= */

        .admin-header {
            background: linear-gradient(
                135deg,
                #092c4c,
                #1769aa
            );

            color: white;

            border-radius: 18px;
            padding: 35px;

            margin-bottom: 40px;

            box-shadow: 0 15px 35px rgba(9, 44, 76, 0.18);
        }

        .admin-label {
            font-size: 12px;
            letter-spacing: 2px;
            opacity: 0.8;
            margin-bottom: 10px;
        }

        .admin-header h2 {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .admin-header p {
            max-width: 700px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .admin-badge {
            display: inline-block;

            margin-top: 20px;

            background: rgba(255,255,255,0.15);

            padding: 9px 15px;
            border-radius: 30px;

            font-size: 13px;
            font-weight: bold;
        }

        /* =========================
           SECTION
        ========================= */

        .section-title {
            font-size: 21px;
            margin-bottom: 18px;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;

            margin-bottom: 45px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e5eaf0;
            border-radius: 15px;

            padding: 22px;

            box-shadow: 0 5px 20px rgba(16,42,67,0.05);
        }

        .stat-icon {
            font-size: 25px;
            margin-bottom: 12px;
        }

        .stat-label {
            color: #718096;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #092c4c;
        }

        /* =========================
           ADMIN GRID
        ========================= */

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .admin-card {
            background: white;

            border: 1px solid #e5eaf0;
            border-radius: 15px;

            padding: 25px;

            box-shadow: 0 5px 20px rgba(16,42,67,0.05);

            transition: 0.2s;
        }

        .admin-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 12px 30px rgba(16,42,67,0.10);
        }

        .admin-card-icon {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .admin-card h3 {
            margin-bottom: 10px;
        }

        .admin-card p {
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .admin-button {
            display: inline-block;

            padding: 9px 15px;

            border-radius: 9px;

            background: #092c4c;
            color: white;

            font-size: 13px;
            font-weight: bold;

            transition: 0.2s;
        }

        .admin-button:hover {
            background: #14558a;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            text-align: center;
            padding: 30px;
            color: #718096;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .admin-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .navbar {
                padding: 12px 20px;
            }

            .user-info {
                display: none;
            }

            .container {
                width: 92%;
                padding-top: 30px;
            }

            .page-title {
                font-size: 26px;
            }

            .stats,
            .admin-grid {
                grid-template-columns: 1fr;
            }

            .admin-header {
                padding: 25px;
            }

            .admin-header h2 {
                font-size: 23px;
            }

            .logout-button {
                padding: 8px 11px;
            }

            .avatar {
                display: none;
            }

        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <a href="{{ route('dashboard') }}" class="brand">

            <div class="brand-logo">
                TR
            </div>

            <div class="brand-text">

                <strong>TR11 SHOP</strong>

                <span>E-COMMERCE SYSTEM</span>

            </div>

        </a>


        <div class="nav-right">

            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="user-info">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    {{ strtoupper(auth()->user()->role) }}
                </span>

            </div>


            <!-- LOGOUT -->

            <form
                method="POST"
                action="{{ route('logout') }}"
                class="logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Logout
                </button>

            </form>

        </div>

    </nav>


    <!-- MAIN -->

    <main class="container">

        <div class="breadcrumb">
            ADMIN PANEL
        </div>

        <h1 class="page-title">
            Admin Dashboard
        </h1>

        <p class="page-description">
            Kelola sistem e-commerce TR11 dari halaman administrator.
        </p>


        <!-- ADMIN HEADER -->

        <section class="admin-header">

            <div class="admin-label">
                TR11 E-COMMERCE
            </div>

            <h2>
                Selamat datang,
                {{ auth()->user()->name }} 👋
            </h2>

            <p>
                Kamu sedang menggunakan akun administrator.
                Halaman ini hanya dapat diakses oleh pengguna
                dengan role <strong>admin</strong>.
            </p>

            <div class="admin-badge">
                🔐 Role: ADMIN
            </div>

        </section>


        <!-- STATISTICS -->

        <h2 class="section-title">
            Ringkasan Sistem
        </h2>

        <div class="stats">

            <div class="stat-card">

                <div class="stat-icon">
                    📦
                </div>

                <div class="stat-label">
                    Total Produk
                </div>

                <div class="stat-value">
                    {{ \App\Models\Product::count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    🏷️
                </div>

                <div class="stat-label">
                    Kategori
                </div>

                <div class="stat-value">
                    {{ \App\Models\Category::count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    🛒
                </div>

                <div class="stat-label">
                    Pesanan
                </div>

                <div class="stat-value">
                    {{ \App\Models\Order::count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    👥
                </div>

                <div class="stat-label">
                    Pengguna
                </div>

                <div class="stat-value">
                    {{ \App\Models\User::count() }}
                </div>

            </div>

        </div>


        <!-- ADMIN MENU -->

        <h2 class="section-title">
            Admin Actions
        </h2>

        <div class="admin-grid">


            <!-- PRODUCTS -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    📦
                </div>

                <h3>
                    Produk
                </h3>

                <p>
                    Lihat dan kelola seluruh produk
                    yang tersedia di database e-commerce.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="admin-button"
                >
                    Kelola Produk
                </a>

            </div>


            <!-- ORDERS -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    🛒
                </div>

                <h3>
                    Pesanan
                </h3>

                <p>
                    Lihat daftar pesanan dan informasi
                    transaksi pelanggan.
                </p>

                <a
                    href="{{ route('orders.index') }}"
                    class="admin-button"
                >
                    Kelola Pesanan
                </a>

            </div>


            <!-- POSTS -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    📝
                </div>

                <h3>
                    Posts
                </h3>

                <p>
                    Kelola konten post menggunakan sistem
                    authorization dan PostPolicy.
                </p>

                <a
                    href="{{ route('posts.index') }}"
                    class="admin-button"
                >
                    Kelola Posts
                </a>

            </div>


            <!-- DASHBOARD -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    🏠
                </div>

                <h3>
                    Dashboard
                </h3>

                <p>
                    Kembali ke dashboard utama
                    TR11 E-Commerce.
                </p>

                <a
                    href="{{ route('dashboard') }}"
                    class="admin-button"
                >
                    Dashboard
                </a>

            </div>


            <!-- PROFILE -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    👤
                </div>

                <h3>
                    Profile
                </h3>

                <p>
                    Kelola informasi akun dan
                    keamanan password.
                </p>

                <a
                    href="{{ route('profile.edit') }}"
                    class="admin-button"
                >
                    Profile
                </a>

            </div>


            <!-- EDITOR -->

            <div class="admin-card">

                <div class="admin-card-icon">
                    ✏️
                </div>

                <h3>
                    Editor Panel
                </h3>

                <p>
                    Halaman khusus untuk pengguna
                    dengan role editor.
                </p>

                <a
                    href="{{ route('editor') }}"
                    class="admin-button"
                >
                    Editor Panel
                </a>

            </div>

        </div>

    </main>


    <!-- FOOTER -->

    <footer class="footer">

        TR11 E-Commerce © {{ date('Y') }}

    </footer>

</body>

</html>