<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'User Dashboard - Inventory App' ?></title>

    <!-- Google Fonts: Modern Font Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Clean Modern CSS for User -->
    <style>
        <?php
        // Helper function to check active menu state
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
            --user-primary: #17a2b8;
            --user-light: #4dd0e1;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --border-radius: 8px;
            --transition: all 0.2s ease;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f9ff;
            color: #475569;
        }

        /* Clean User Sidebar */
        .main-sidebar {
            background-color: var(--user-primary);
            box-shadow: var(--shadow);
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link {
            border-radius: 6px;
            margin: 2px 8px;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-left-color: white;
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--user-light);
        }

        /* Treeview Child Menu Styling */
        .sidebar-dark-info .nav-treeview>.nav-item>.nav-link {
            padding-left: 25px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar-dark-info .nav-treeview>.nav-item>.nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border-left: 3px solid var(--user-primary-light);
        }

        .sidebar-dark-info .nav-treeview>.nav-item>.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* Parent menu styling when expanded */
        .sidebar-dark-info .nav-sidebar>.nav-item.menu-open>.nav-link {
            background-color: rgba(255, 255, 255, 0.08);
            border-left-color: var(--user-primary-light);
            font-weight: 600;
        }

        /* Better spacing for treeview */
        .nav-treeview {
            padding-left: 0;
        }

        .nav-treeview .nav-item {
            margin-left: 0;
        }

        .brand-link {
            background-color: var(--user-primary) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Clean Navbar */
        .main-header.navbar {
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
        }

        /* Clean Content */
        .content-wrapper {
            background-color: #f8fafc;
        }

        /* Clean Cards */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            background-color: white;
        }

        .card:hover {
            box-shadow: var(--shadow);
        }

        /* Clean Statistics Boxes */
        .small-box {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid #e2e8f0;
            background-color: white;
        }

        .small-box:hover {
            box-shadow: var(--shadow);
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
            background-color: var(--user-primary);
            border-color: var(--user-primary);
        }

        .btn-primary:hover {
            background-color: var(--user-light);
            border-color: var(--user-light);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .small-box h3 {
                font-size: 2rem;
            }

            .card-body {
                padding: 15px;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Main Sidebar Container -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <!-- Brand -->
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="<?= base_url('/dashboard') ?>">
                        <img src="https://preview.tabler.io/static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
            </div>

            <!-- User Info -->
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <div class="navbar-nav pt-lg-3">
                    <div class="navbar-nav-header">
                        <div class="navbar-user">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar avatar-sm" style="background-image: url(https://preview.tabler.io/static/avatars/000m.jpg)"></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium"><?= session()->get('name') ?? 'User' ?></div>
                                    <div class="text-muted text-uppercase font-size-xs">
                                        <i class="ti ti-user me-1"></i>
                                        <?= ucfirst(session()->get('role') ?? 'user') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <ul class="navbar-nav flex-column">
                        <!-- Dashboard -->
                        <li class="navbar-nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= isActive('dashboard') ? 'active' : '' ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="nav-link-title">
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <!-- Products -->
                        <li class="nav-header">PRODUK</li>

                        <li class="navbar-nav-item">
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
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Stock Movement
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><em>Coming Soon</em></p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Reports -->
                        <li class="nav-header">LAPORAN</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><em>Coming Soon</em></p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $page_title ?? 'Dashboard' ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $page_title ?? 'Dashboard' ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="#">Inventory App</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Smooth transitions for user layout
            $('.card').hover(
                function() { $(this).addClass('shadow-lg'); },
                function() { $(this).removeClass('shadow-lg'); }
            );

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Enhanced button interactions
            $('.btn').on('mousedown', function() {
                $(this).addClass('btn-pressed');
            }).on('mouseup mouseleave', function() {
                $(this).removeClass('btn-pressed');
            });
        });
    </script>
</body>
</html>
