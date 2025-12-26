<?php $this->extend('layouts/admin') ?>

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

<!-- Action Buttons -->
<div class="mb-3">
    <a href="<?= base_url('/admin/categories/create') ?>" class="btn btn-primary">
        <i class="ti ti-plus me-2"></i>Tambah Kategori Baru
    </a>
</div>

<!-- Categories Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Senarai Kategori Produk</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Jumlah Produk</th>
                        <th>Dibuat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($categories)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tiada kategori ditemui</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($categories as $index => $category): ?>
                            <?php
                            // Count products in this category
                            $productCount = 0;
                            if (isset($category['id'])) {
                                $productCount = \Config\Database::connect()->table('products')->where('category_id', $category['id'])->countAllResults();
                            }
                            ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <strong><?= esc($category['name']) ?></strong>
                                </td>
                                <td>
                                    <?= $category['description'] ? esc(substr($category['description'], 0, 50)) . (strlen($category['description']) > 50 ? '...' : '') : '<em class="text-muted">Tiada deskripsi</em>' ?>
                                </td>
                                <td>
                                    <?php if($category['is_active']): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-info"><?= $productCount ?> produk</span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($category['created_at'])) ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/categories/' . $category['id']) ?>" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/categories/' . $category['id'] . '/edit') ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-<?= $category['is_active'] ? 'secondary' : 'success' ?> toggle-status"
                                                data-id="<?= $category['id'] ?>"
                                                data-status="<?= $category['is_active'] ?>"
                                                title="<?= $category['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                            <i class="ti ti-<?= $category['is_active'] ? 'ban' : 'check' ?>"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger delete-category"
                                                data-id="<?= $category['id'] ?>"
                                                data-name="<?= esc($category['name']) ?>"
                                                data-product-count="<?= $productCount ?>"
                                                title="Padam">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Padam Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Adakah anda pasti mahu memadam kategori <strong id="categoryName"></strong>?</p>
                <p>Kategori ini mempunyai <strong id="productCount"></strong> produk.</p>
                <div id="warningMessage" class="alert alert-warning" style="display: none;">
                    <strong>Amaran!</strong> Kategori yang mempunyai produk tidak boleh dipadam.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Padam</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Delete category functionality
    $('.delete-category').on('click', function() {
        var categoryId = $(this).data('id');
        var categoryName = $(this).data('name');
        var productCount = $(this).data('product-count');

        $('#categoryName').text(categoryName);
        $('#productCount').text(productCount + ' produk');

        if (productCount > 0) {
            $('#warningMessage').show();
            $('#confirmDelete').prop('disabled', true);
        } else {
            $('#warningMessage').hide();
            $('#confirmDelete').prop('disabled', false);
        }

        $('#confirmDelete').data('id', categoryId);
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').on('click', function() {
        var categoryId = $(this).data('id');

        $.ajax({
            url: '<?= base_url('/admin/categories/') ?>' + categoryId,
            type: 'DELETE',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error occurred while deleting category');
            }
        });

        $('#deleteModal').modal('hide');
    });

    // Toggle category status
    $('.toggle-status').on('click', function() {
        var categoryId = $(this).data('id');
        var currentStatus = $(this).data('status');
        var button = $(this);

        $.ajax({
            url: '<?= base_url('/admin/categories/toggle-status/') ?>' + categoryId,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error occurred while toggling category status');
            }
        });
    });
});
</script>

<?php $this->endSection() ?>
