<?php $this->extend('layouts/' . (session()->get('role') === 'admin' || session()->get('role') === 'manager' ? 'admin' : 'user')) ?>

<?php $this->section('content') ?>

<!-- Success/Error Messages -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <i class="ti ti-check-circle"></i>
            </div>
            <div class="ms-2">
                <h4 class="alert-title">Success!</h4>
                <div class="text-muted"><?= session()->getFlashdata('success') ?></div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <i class="ti ti-alert-circle"></i>
            </div>
            <div class="ms-2">
                <h4 class="alert-title">Error!</h4>
                <div class="text-muted"><?= session()->getFlashdata('error') ?></div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
<?php endif; ?>

<!-- Welcome Card -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-package"></i>
                        </span>
                    </div>
                    <div class="col">
                        <h3 class="card-title mb-1">Selamat Datang di Inventory App</h3>
                        <p class="text-muted mb-0">Sistem pengurusan inventori yang lengkap untuk perniagaan anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row row-deck row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Jumlah Produk</div>
                    <div class="ms-auto lh-1">
                        <div class="text-muted small">Total</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="h1 mb-0 me-2"><?= $total_products ?? 0 ?></div>
                    <div class="text-muted small">
                        <i class="ti ti-trending-up text-success"></i> +2.5%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Jumlah Kategori</div>
                    <div class="ms-auto lh-1">
                        <div class="text-muted small">Total</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="h1 mb-0 me-2"><?= $total_categories ?? 0 ?></div>
                    <div class="text-muted small">
                        <i class="ti ti-trending-up text-success"></i> +1.2%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Stok Rendah</div>
                    <div class="ms-auto lh-1">
                        <div class="text-muted small">Alert</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="h1 mb-0 me-2"><?= $low_stock_products ?? 0 ?></div>
                    <div class="text-muted small">
                        <i class="ti ti-trending-down text-danger"></i> -0.8%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Pergerakan Hari Ini</div>
                    <div class="ms-auto lh-1">
                        <div class="text-muted small">Today</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="h1 mb-0 me-2">0</div>
                    <div class="text-muted small">
                        <i class="ti ti-minus text-muted"></i> 0.0%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & System Info -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tindakan Pantas
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="fas fa-plus mr-2"></i>Tambah Produk
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success btn-block">
                            <i class="fas fa-tags mr-2"></i>Tambah Kategori
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-info btn-block">
                            <i class="fas fa-chart-bar mr-2"></i>Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Maklumat Sistem
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-right">
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

<!-- Recent Activity (for admin/manager only) -->
<?php if(session()->get('role') === 'admin' || session()->get('role') === 'manager'): ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-2"></i>Aktiviti Terkini
                </h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="time-label">
                        <span class="bg-red">Hari Ini</span>
                    </div>
                    <div>
                        <i class="fas fa-user-plus bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 12 min ago</span>
                            <h3 class="timeline-header">Sistem authentication telah dilaksanakan</h3>
                            <div class="timeline-body">
                                Sistem login, register dan forgot password telah berjaya diimplementasikan.
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-database bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 15 min ago</span>
                            <h3 class="timeline-header">Database migration selesai</h3>
                            <div class="timeline-body">
                                Semua table database telah berjaya dibuat dengan struktur yang lengkap.
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-code bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 30 min ago</span>
                            <h3 class="timeline-header">AdminLTE layout diintegrasikan</h3>
                            <div class="timeline-body">
                                Sistem layout dengan AdminLTE telah siap untuk admin dan user.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $this->endSection() ?>
