<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Admin Dashboard - Inventory App' ?></title>

    <!-- Google Fonts: Modern Font Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css">
    <!-- Clean Modern CSS -->
    <style>
        <?php
        // Helper function to check active menu state
        $currentUri = uri_string();

        function isActive($patterns) {
            $currentUri = uri_string();
            if (is_array($patterns)) {
                foreach ($patterns as $pattern) {
                    if (strpos($currentUri, $pattern) !== false) {
                        return 'active';
                    }
                }
            } else {
                if (strpos($currentUri, $patterns) !== false) {
                    return 'active';
                }
            }
            return '';
        }

        function isMenuOpen($patterns) {
            return isActive($patterns) ? 'menu-open' : '';
        }
        ?>
        :root {
            /* Tabler-inspired color palette */
            --primary-color: #206bc4;    /* Tabler blue */
            --primary-light: #4299e1;    /* Light blue */
            --secondary-color: #6c757d;  /* Gray */
            --success-color: #2fb344;    /* Green */
            --warning-color: #f59e0b;    /* Amber */
            --danger-color: #d63939;     /* Red */
            --info-color: #0d6efd;       /* Blue */
            --light: #f8f9fa;
            --dark: #212529;
            --white: #ffffff;
            --gray-50: #f8f9fa;
            --gray-100: #e9ecef;
            --gray-200: #dee2e6;
            --gray-300: #ced4da;
            --gray-400: #adb5bd;
            --gray-500: #6c757d;
            --gray-600: #495057;
            --gray-700: #343a40;
            --gray-800: #212529;
            --gray-900: #000000;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --border-radius: 4px;        /* Tabler uses 4px border radius */
            --transition: all 0.2s ease;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-700);
        }

        /* Tabler Navbar Styling */
        .navbar-vertical {
            background-color: var(--gray-800);
            border-right: 1px solid var(--gray-700);
            width: 16rem;
        }

        .navbar-brand {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-700);
        }

        .navbar-brand-image {
            height: 2rem;
        }

        .navbar-nav {
            padding: 1rem 0;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            margin: 0.125rem 1rem;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .navbar-nav .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .navbar-nav .nav-link.dropdown-toggle::after {
            margin-left: auto;
            border: none;
            width: 1rem;
            height: 1rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.7;
        }

        /* Nav Section Headers */
        .nav-header {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.5rem 1.5rem 0.75rem;
            margin-top: 1rem;
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            background-color: var(--gray-700);
            border: 1px solid var(--gray-600);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            margin-top: 0.25rem;
            min-width: 14rem;
        }

        .dropdown-menu .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            margin: 0.125rem 0.25rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .dropdown-menu .dropdown-item.active {
            background-color: var(--primary-color);
            color: white;
        }

        .dropdown-menu .dropdown-item.disabled {
            color: rgba(255, 255, 255, 0.5);
            cursor: not-allowed;
        }

        /* User Info Section */
        .navbar-user {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-700);
            margin-bottom: 1rem;
        }

        .navbar-user .row {
            align-items: center;
        }

        .navbar-user .avatar {
            width: 2.5rem;
            height: 2.5rem;
        }

        .navbar-user .font-weight-medium {
            font-size: 0.875rem;
            color: white;
            margin-bottom: 0.25rem;
        }

        .navbar-user .text-muted {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .brand-link {
            background-color: var(--gray-900) !important;
            border-bottom: 1px solid var(--gray-700);
            color: white;
        }

        .brand-text {
            font-weight: 600;
        }

        /* Clean Navbar */
        .main-header.navbar {
            background-color: white;
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        .navbar-nav .nav-link {
            transition: var(--transition);
            border-radius: 6px;
            padding: 8px 12px;
        }

        .navbar-nav .nav-link:hover {
            background-color: var(--gray-100);
            color: var(--primary-color);
        }

        /* Clean Content */
        .content-wrapper {
            background-color: var(--gray-50);
        }

        .content-header {
            padding: 20px 30px 0;
        }

        .content-header h1 {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0;
        }

        /* Clean Cards */
        .card {
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            background-color: white;
        }

        .card:hover {
            box-shadow: var(--shadow);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 20px 25px;
        }

        .card-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* Clean Statistics Boxes */
        .small-box {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            background-color: white;
        }

        .small-box:hover {
            box-shadow: var(--shadow);
        }

        .small-box .inner {
            padding: 20px;
        }

        .small-box h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .small-box p {
            font-size: 1rem;
            font-weight: 500;
        }

        .small-box .icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 3rem;
            opacity: 0.3;
        }

        .small-box-footer {
            background-color: var(--gray-50);
            padding: 8px 15px;
            text-align: center;
            border-top: 1px solid var(--gray-200);
        }

        /* Clean Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-info {
            background-color: var(--info-color);
            border-color: var(--info-color);
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        /* Clean Tables */
        .table thead th {
            background-color: var(--gray-50);
            border-bottom: 2px solid var(--gray-300);
            font-weight: 600;
            color: var(--gray-700);
            padding: 15px;
        }

        .table tbody tr:hover {
            background-color: var(--gray-50);
        }

        /* Clean Alerts */
        .alert {
            border-radius: var(--border-radius);
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-color: #fde68a;
            color: #92400e;
        }

        .alert-info {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        /* Clean Form Elements */
        .form-control {
            border-radius: 6px;
            border: 1px solid var(--gray-300);
            transition: var(--transition);
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Clean Modal */
        .modal-content {
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
        }

        /* Simple Loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-300);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Clean Footer */
        .main-footer {
            background-color: var(--gray-100);
            color: var(--gray-600);
            border-top: 1px solid var(--gray-200);
            padding: 15px;
        }

        /* Clean Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }

        /* Simple Notification */
        .modern-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content-header h1 {
                font-size: 1.5rem;
            }

            .small-box h3 {
                font-size: 2rem;
            }

            .card-body {
                padding: 15px;
            }

            .modern-notification {
                left: 10px;
                right: 10px;
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="layout-fluid">


        <!-- Main Sidebar Container -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <!-- Brand Logo -->
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="<?= base_url('/dashboard') ?>">
                        <img src="https://preview.tabler.io/static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
            </div>

            <!-- Sidebar -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar-nav pt-lg-3">
                    <!-- User Info -->
                    <div class="navbar-nav-header">
                        <div class="navbar-user d-none d-md-flex">
                            <a href="#" class="navbar-user-link">
                                <span class="avatar avatar-sm" style="background-image: url(https://preview.tabler.io/static/avatars/000m.jpg)"></span>
                                <div class="navbar-user-info">
                                    <div class="navbar-user-name"><?= session()->get('name') ?? 'Administrator' ?></div>
                                    <div class="navbar-user-role text-muted">
                                        <i class="ti ti-crown me-1"></i>
                                        <?= ucfirst(session()->get('role') ?? 'admin') ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <ul class="navbar-nav flex-column">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= isActive('dashboard') ? 'active' : '' ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="nav-link-title">
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <!-- Master Data -->
                        <li class="nav-header">MASTER DATA</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-tag"></i>
                                </span>
                                <span class="nav-link-title">
                                    Kategori
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item <?= uri_string() === 'admin/categories' ? 'active' : '' ?>" href="<?= base_url('/admin/categories') ?>">
                                            Lihat Semua
                                        </a>
                                        <a class="dropdown-item <?= uri_string() === 'admin/categories/create' ? 'active' : '' ?>" href="<?= base_url('/admin/categories/create') ?>">
                                            Tambah Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="nav-link-title">
                                    Produk
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item disabled" href="#">
                                            <em>Coming Soon</em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Transaction -->
                        <li class="nav-header">TRANSACTION</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-transfer"></i>
                                </span>
                                <span class="nav-link-title">
                                    Stock Movement
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item disabled" href="#">
                                            <em>Coming Soon</em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Reports -->
                        <li class="nav-header">LAPORAN</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-chart-bar"></i>
                                </span>
                                <span class="nav-link-title">
                                    Laporan
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item disabled" href="#">
                                            <em>Coming Soon</em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- User Management -->
                        <li class="nav-header">PENGURUSAN PENGGUNA</li>

                        <li class="navbar-nav-item <?= isMenuOpen('admin/users') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="nav-link-title">
                                    Pengguna
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item <?= uri_string() === 'admin/users' ? 'active' : '' ?>" href="<?= base_url('/admin/users') ?>">
                                            Lihat Semua
                                        </a>
                                        <a class="dropdown-item <?= uri_string() === 'admin/users/create' ? 'active' : '' ?>" href="<?= base_url('/admin/users/create') ?>">
                                            Tambah Pengguna
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Page Content -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                <?= $page_title ?? 'Dashboard' ?>
                            </h2>
                            <div class="text-muted mt-1">
                                Welcome back, <?= session()->get('name') ?? 'Administrator' ?>!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="link-secondary">Documentation</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="link-secondary">License</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="link-secondary">About</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; 2025
                                <a href="#" class="link-secondary">Inventory App</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="link-secondary" tabindex="-1">v1.0.0</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modern Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle text-warning mr-2"></i>
                        Pengesahan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-cancel">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-danger btn-confirm">
                        <i class="fas fa-check mr-1"></i>Ya, Teruskan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>

    <script>
        $(document).ready(function() {
            // Simple loading states
            $('form').on('submit', function() {
                $('#loadingOverlay').show();
            });

            // Simple tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Loading overlay hide on page load
            $(window).on('load', function() {
                $('#loadingOverlay').hide();
            });

            // Simple confirmation dialogs
            window.confirmDelete = function(message) {
                return new Promise((resolve) => {
                    $('#confirmModal .modal-body p').text(message);
                    $('#confirmModal').modal('show');

                    $('#confirmModal .btn-confirm').one('click', function() {
                        $('#confirmModal').modal('hide');
                        resolve(true);
                    });

                    $('#confirmModal .btn-cancel').one('click', function() {
                        $('#confirmModal').modal('hide');
                        resolve(false);
                    });
                });
            };
        });

        // Simple notification system
        window.showNotification = function(message, type = 'info') {
            var alertClass = 'alert-' + type;
            var icon = '';

            switch(type) {
                case 'success': icon = 'fas fa-check-circle'; break;
                case 'error': icon = 'fas fa-exclamation-triangle'; break;
                case 'warning': icon = 'fas fa-exclamation-circle'; break;
                default: icon = 'fas fa-info-circle';
            }

            var notification = $(`
                <div class="alert ${alertClass} alert-dismissible fade show modern-notification">
                    <i class="${icon} mr-2"></i>
                    ${message}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            `);

            $('.content-wrapper').prepend(notification);

            setTimeout(function() {
                notification.fadeOut();
            }, 5000);
        };
    </script>
</body>
</html>
