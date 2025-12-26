<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Admin Dashboard - Inventory App' ?></title>

    <!-- Google Fonts: Modern Font Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom Modern CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            --shadow-light: 0 2px 10px rgba(0,0,0,0.08);
            --shadow-medium: 0 4px 20px rgba(0,0,0,0.12);
            --shadow-heavy: 0 8px 40px rgba(0,0,0,0.16);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Modern Sidebar */
        .main-sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: var(--shadow-heavy);
            border: none;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link {
            border-radius: 8px;
            margin: 2px 8px;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background: var(--primary-gradient);
            box-shadow: var(--shadow-medium);
            border-left-color: #fff;
            transform: translateX(5px);
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(3px);
            border-left-color: rgba(255, 255, 255, 0.5);
        }

        .brand-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
        }

        .brand-text {
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        /* Modern Navbar */
        .main-header.navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            box-shadow: var(--shadow-light);
        }

        .navbar-nav .nav-link {
            transition: var(--transition);
            border-radius: 6px;
            padding: 8px 12px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        /* Modern Content */
        .content-wrapper {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 60px);
        }

        .content-header {
            padding: 20px 30px 0;
        }

        .content-header h1 {
            font-weight: 600;
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0;
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

        .card-header {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 20px 25px;
        }

        .card-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* Modern Small Boxes (Statistics) */
        .small-box {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            border: none;
            overflow: hidden;
            position: relative;
        }

        .small-box:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: var(--shadow-heavy);
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
            background: rgba(0,0,0,0.1);
            padding: 8px 15px;
            text-align: center;
            transition: var(--transition);
        }

        .small-box-footer:hover {
            background: rgba(0,0,0,0.2);
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
            background: var(--primary-gradient);
        }

        .btn-success {
            background: var(--success-gradient);
        }

        .btn-info {
            background: var(--info-gradient);
        }

        .btn-warning {
            background: var(--warning-gradient);
        }

        .btn-danger {
            background: var(--danger-gradient);
        }

        /* Modern Tables */
        .table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 15px;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        /* Modern Alerts */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-light);
        }

        /* Modern Form Elements */
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: var(--transition);
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-1px);
        }

        /* Modern Modal */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-heavy);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Modern Footer */
        .main-footer {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: rgba(255, 255, 255, 0.8);
            border-top: none;
            padding: 15px;
        }

        /* Ripple Effect */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn {
            position: relative;
            overflow: hidden;
        }

        /* Modern Notification */
        .modern-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Enhanced Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .fade-in-down {
            animation: fadeInDown 0.6s ease-out;
        }

        /* Stagger animations for cards */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Enhanced shadow system */
        .shadow-glass {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
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
                        <span class="d-none d-md-inline"><?= session()->get('name') ?? 'Admin' ?></span>
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/dashboard') ?>" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                        <a href="#" class="d-block"><?= session()->get('name') ?? 'Administrator' ?></a>
                        <small class="text-muted">
                            <i class="fas fa-crown mr-1"></i>
                            <?= ucfirst(session()->get('role') ?? 'admin') ?>
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

                        <!-- Master Data -->
                        <li class="nav-header">MASTER DATA</li>

                        <li class="nav-item">
                            <a href="<?= base_url('/admin/categories') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Kategori
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('/admin/categories') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lihat Semua</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/admin/categories/create') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Baru</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

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

                        <!-- User Management -->
                        <li class="nav-header">PENGURUSAN PENGGUNA</li>

                        <li class="nav-item">
                            <a href="<?= base_url('/admin/users') ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pengguna
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('/admin/users') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lihat Semua</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/admin/users/create') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Pengguna</p>
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
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Modern loading states
            $('form').on('submit', function() {
                $('#loadingOverlay').fadeIn(200);
            });

            // Smooth page transitions
            $('a[href^="/"]').on('click', function(e) {
                if (!$(this).hasClass('no-loading') && !$(this).attr('target')) {
                    $('#loadingOverlay').fadeIn(200);
                }
            });

            // Enhanced tooltips
            $('[data-toggle="tooltip"]').tooltip({
                delay: { show: 300, hide: 100 },
                animation: true
            });

            // Card hover effects
            $('.card').hover(
                function() { $(this).addClass('pulse'); },
                function() { $(this).removeClass('pulse'); }
            );

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = $(this.hash);
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 70
                    }, 500, 'easeInOutExpo');
                }
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Enhanced sidebar animation
            $('.nav-sidebar .nav-link').on('mouseenter', function() {
                $(this).find('i').addClass('fa-bounce');
            }).on('mouseleave', function() {
                $(this).find('i').removeClass('fa-bounce');
            });

            // Loading overlay hide on page load
            $(window).on('load', function() {
                $('#loadingOverlay').fadeOut(300);
            });

            // Modern confirmation dialogs
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

            // Add ripple effect to buttons
            $('.btn').on('click', function(e) {
                var ripple = $('<span class="ripple-effect"></span>');
                var btnOffset = $(this).offset();
                var relX = e.pageX - btnOffset.left;
                var relY = e.pageY - btnOffset.top;

                ripple.css({
                    left: relX,
                    top: relY
                });

                $(this).append(ripple);
                setTimeout(function() {
                    ripple.remove();
                }, 600);
            });
        });

        // Modern notification system
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
