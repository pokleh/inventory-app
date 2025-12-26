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
    <!-- Custom Modern CSS for User -->
    <style>
        :root {
            --user-primary: #17a2b8;
            --user-gradient: linear-gradient(135deg, #17a2b8 0%, #4dd0e1 100%);
            --shadow-light: 0 2px 10px rgba(0,0,0,0.08);
            --shadow-medium: 0 4px 20px rgba(0,0,0,0.12);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
        }

        /* Modern User Sidebar */
        .main-sidebar {
            background: linear-gradient(180deg, #17a2b8 0%, #4dd0e1 100%);
            box-shadow: var(--shadow-medium);
            border: none;
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link {
            border-radius: 8px;
            margin: 2px 8px;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-light);
            border-left-color: #fff;
            transform: translateX(5px);
        }

        .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(3px);
            border-left-color: rgba(255, 255, 255, 0.5);
        }

        .brand-link {
            background: var(--user-gradient) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Modern Navbar */
        .main-header.navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            box-shadow: var(--shadow-light);
        }

        /* Modern Content */
        .content-wrapper {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 60px);
        }

        /* Modern Cards */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Modern Small Boxes */
        .small-box {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            border: none;
            overflow: hidden;
        }

        .small-box:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Modern Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            box-shadow: var(--shadow-light);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-medium);
        }

        .btn-primary {
            background: var(--user-gradient);
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

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-widget="fullscreen" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <span class="d-none d-md-inline"><?= session()->get('name') ?? 'User' ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/auth/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-info elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/dashboard') ?>" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Inventory Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Inventory App</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('name') ?? 'User' ?></a>
                        <small class="text-muted">
                            <i class="fas fa-user mr-1"></i>
                            <?= ucfirst(session()->get('role') ?? 'user') ?>
                        </small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Products -->
                        <li class="nav-header">PRODUK</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Produk
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
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
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
