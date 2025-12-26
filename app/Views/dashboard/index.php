<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background: #343a40;
            min-height: 100vh;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: #0d6efd;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="text-center mb-4">
                        <i class="fas fa-boxes me-2"></i>Inventory
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="<?= base_url('/dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-box me-2"></i>Produk
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-tags me-2"></i>Kategori
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-line me-2"></i>Laporan Stok
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>Pengguna
                        </a>
                        <hr class="my-3">
                        <a class="nav-link text-danger" href="<?= base_url('/auth/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Log Keluar
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <div>
                        <span class="text-muted">Selamat datang, </span>
                        <strong><?= session()->get('name') ?? 'User' ?></strong>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Welcome Card -->
                <div class="card welcome-card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fas fa-handshake me-2"></i>Selamat Datang di Inventory App
                        </h4>
                        <p class="card-text">Sistem pengurusan inventori yang lengkap untuk perniagaan anda.</p>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon text-primary">
                                    <i class="fas fa-box"></i>
                                </div>
                                <h3 class="card-title mb-0">0</h3>
                                <p class="card-text text-muted">Jumlah Produk</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon text-success">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <h3 class="card-title mb-0">0</h3>
                                <p class="card-text text-muted">Jumlah Kategori</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon text-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h3 class="card-title mb-0">0</h3>
                                <p class="card-text text-muted">Stok Rendah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon text-info">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h3 class="card-title mb-0">0</h3>
                                <p class="card-text text-muted">Pergerakan Hari Ini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-plus-circle me-2"></i>Tindakan Pantas
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Produk Baru
                                    </a>
                                    <a href="#" class="btn btn-success">
                                        <i class="fas fa-tags me-2"></i>Tambah Kategori Baru
                                    </a>
                                    <a href="#" class="btn btn-info">
                                        <i class="fas fa-chart-bar me-2"></i>Lihat Laporan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Maklumat Sistem
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <h4 class="text-primary">v1.0</h4>
                                            <small class="text-muted">Versi</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="text-success">
                                            <i class="fas fa-circle"></i>
                                        </h4>
                                        <small class="text-muted">Status</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
