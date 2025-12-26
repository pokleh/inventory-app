<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Maklumat Pengguna: <?= esc($user['name']) ?></h3>
        <div class="card-actions">
            <a href="<?= base_url('/admin/users/' . $user['id'] . '/edit') ?>" class="btn btn-warning btn-sm">
                <i class="ti ti-edit me-1"></i>Edit
            </a>
            <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Nama Penuh</th>
                            <td>: <?= esc($user['name']) ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>: <?= esc($user['username']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= esc($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>:
                                <?php
                                $roleClass = '';
                                $roleText = '';
                                switch($user['role']) {
                                    case 'admin':
                                        $roleClass = 'badge-danger';
                                        $roleText = 'Administrator';
                                        break;
                                    case 'manager':
                                        $roleClass = 'badge-warning';
                                        $roleText = 'Manager';
                                        break;
                                    case 'user':
                                        $roleClass = 'badge-info';
                                        $roleText = 'User';
                                        break;
                                }
                                ?>
                                <span class="badge <?= $roleClass ?> badge-lg"><?= $roleText ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                <?php if($user['is_active']): ?>
                                    <span class="badge badge-success badge-lg">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary badge-lg">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>: <?= date('d F Y, H:i:s', strtotime($user['created_at'])) ?></td>
                        </tr>
                        <?php if($user['updated_at']): ?>
                        <tr>
                            <th>Dikemaskini Pada</th>
                            <td>: <?= date('d F Y, H:i:s', strtotime($user['updated_at'])) ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <div class="text-center">
                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                         class="img-circle elevation-2" alt="User Image"
                         style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="mt-3"><?= esc($user['name']) ?></h5>
                    <p class="text-muted">
                        <i class="ti ti-<?= $user['role'] == 'admin' ? 'crown' : ($user['role'] == 'manager' ? 'user-check' : 'user') ?> me-1"></i>
                        <?= ucfirst($user['role']) ?>
                    </p>
                </div>

                <div class="mt-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="ti ti-calendar"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tarikh Daftar</span>
                            <span class="info-box-number">
                                <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-<?= $user['is_active'] ? 'success' : 'secondary' ?>">
                            <i class="ti ti-<?= $user['is_active'] ? 'check-circle' : 'ban' ?>"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Status Akaun</span>
                            <span class="info-box-number">
                                <?= $user['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="btn-group">
                    <a href="<?= base_url('/admin/users/' . $user['id'] . '/edit') ?>" class="btn btn-warning">
                        <i class="ti ti-edit me-2"></i>Edit Pengguna
                    </a>

                    <?php if($user['id'] != session()->get('user_id')): ?>
                        <button type="button" class="btn btn-<?= $user['is_active'] ? 'secondary' : 'success' ?> toggle-status"
                                data-id="<?= $user['id'] ?>"
                                data-status="<?= $user['is_active'] ?>">
                            <i class="ti ti-<?= $user['is_active'] ? 'ban' : 'check' ?> me-2"></i>
                            <?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?> Akaun
                        </button>

                        <button type="button" class="btn btn-danger delete-user"
                                data-id="<?= $user['id'] ?>"
                                data-name="<?= esc($user['name']) ?>">
                            <i class="ti ti-trash me-2"></i>Padam Pengguna
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Padam Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Adakah anda pasti mahu memadam pengguna <strong id="userName"></strong>?</p>
                <p class="text-danger">Tindakan ini tidak boleh dibuat asal!</p>
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
    // Delete user functionality
    $('.delete-user').on('click', function() {
        var userId = $(this).data('id');
        var userName = $(this).data('name');

        $('#userName').text(userName);
        $('#confirmDelete').data('id', userId);
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').on('click', function() {
        var userId = $(this).data('id');

        $.ajax({
            url: '<?= base_url('/admin/users/') ?>' + userId,
            type: 'DELETE',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = '<?= base_url('/admin/users') ?>';
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error occurred while deleting user');
            }
        });

        $('#deleteModal').modal('hide');
    });

    // Toggle user status
    $('.toggle-status').on('click', function() {
        var userId = $(this).data('id');
        var currentStatus = $(this).data('status');
        var button = $(this);

        $.ajax({
            url: '<?= base_url('/admin/users/toggle-status/') ?>' + userId,
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
                alert('Error occurred while toggling user status');
            }
        });
    });
});
</script>

<?php $this->endSection() ?>
