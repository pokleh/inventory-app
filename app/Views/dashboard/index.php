<?php $this->extend('layouts/' . (session()->get('role') === 'admin' || session()->get('role') === 'manager' ? 'admin' : 'user')) ?>

<?php $this->section('content') ?>

<!-- Success/Error Messages -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-check"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-ban"></i> <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Welcome Card -->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-handshake mr-2"></i>Selamat Datang di Inventory App
                </h4>
                <p class="card-text">Sistem pengurusan inventori yang lengkap untuk perniagaan anda.</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info stat-card">
            <div class="inner">
                <h3><?= $total_products ?? 0 ?></h3>
                <p>Jumlah Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="#" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success stat-card">
            <div class="inner">
                <h3><?= $total_categories ?? 0 ?></h3>
                <p>Jumlah Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="#" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning stat-card">
            <div class="inner">
                <h3><?= $low_stock_products ?? 0 ?></h3>
                <p>Stok Rendah</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="#" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger stat-card">
            <div class="inner">
                <h3>0</h3>
                <p>Pergerakan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
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
