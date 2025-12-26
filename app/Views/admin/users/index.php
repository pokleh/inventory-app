<?php $this->extend('layouts/admin') ?>

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

<!-- Action Buttons -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Pengguna Baru
        </a>
    </div>
</div>

<!-- Users Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Senarai Pengguna Sistem</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tiada pengguna ditemui</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td>
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
                                    <span class="badge <?= $roleClass ?>"><?= $roleText ?></span>
                                </td>
                                <td>
                                    <?php if($user['is_active']): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/users/' . $user['id']) ?>" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/users/' . $user['id'] . '/edit') ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if($user['id'] != session()->get('user_id')): ?>
                                            <button type="button" class="btn btn-sm btn-<?= $user['is_active'] ? 'secondary' : 'success' ?> toggle-status"
                                                    data-id="<?= $user['id'] ?>"
                                                    data-status="<?= $user['is_active'] ?>"
                                                    title="<?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                                <i class="fas fa-<?= $user['is_active'] ? 'ban' : 'check' ?>"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete-user"
                                                    data-id="<?= $user['id'] ?>"
                                                    data-name="<?= esc($user['name']) ?>"
                                                    title="Padam">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                    location.reload();
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
