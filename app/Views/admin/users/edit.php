<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<!-- Error Messages -->
<?php if(isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        <ul class="mb-0">
            <?php foreach($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Pengguna: <?= esc($user['name']) ?></h3>
    </div>

    <form action="<?= base_url('/admin/users/' . $user['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama Penuh <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                               id="name" name="name" value="<?= old('name', $user['name']) ?>" required>
                        <?php if(isset($errors['name'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                               id="username" name="username" value="<?= old('username', $user['username']) ?>" required>
                        <?php if(isset($errors['username'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['username'] ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                               id="email" name="email" value="<?= old('email', $user['email']) ?>" required>
                        <?php if(isset($errors['email'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['email'] ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Role <span class="text-danger">*</span></label>
                        <select class="form-control <?= isset($errors['role']) ? 'is-invalid' : '' ?>"
                                id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Administrator</option>
                            <option value="manager" <?= old('role', $user['role']) == 'manager' ? 'selected' : '' ?>>Manager</option>
                            <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : '' ?>>User</option>
                        </select>
                        <?php if(isset($errors['role'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['role'] ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                               id="password" name="password">
                        <?php if(isset($errors['password'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['password'] ?></strong>
                            </span>
                        <?php endif; ?>
                        <small class="form-text text-muted">Biarkan kosong jika tidak mahu tukar password</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirm">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                               id="password_confirm" name="password_confirm">
                        <?php if(isset($errors['password_confirm'])): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?= $errors['password_confirm'] ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox"
                           id="is_active" name="is_active" value="1" <?= old('is_active', $user['is_active']) ? 'checked' : '' ?>>
                    <label for="is_active" class="custom-control-label">
                        Akaun aktif
                    </label>
                </div>
                <small class="form-text text-muted">Pengguna boleh log masuk jika akaun aktif</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Dibuat Pada</label>
                        <input type="text" class="form-control" value="<?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>" readonly>
                    </div>
                </div>
                <?php if($user['updated_at']): ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Dikemaskini Pada</label>
                        <input type="text" class="form-control" value="<?= date('d/m/Y H:i', strtotime($user['updated_at'])) ?>" readonly>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-2"></i>Kemaskini
            </button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Password confirmation validation (only if password is being changed)
    $('#password_confirm').on('keyup', function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();

        if (password && password !== confirmPassword) {
            $(this).addClass('is-invalid');
            $('.password-match').remove();
            $(this).after('<div class="invalid-feedback password-match">Password tidak sama</div>');
        } else {
            $(this).removeClass('is-invalid');
            $('.password-match').remove();
        }
    });

    // Form validation before submit
    $('form').on('submit', function(e) {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirm').val();

        if (password && password !== confirmPassword) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak sama!');
            return false;
        }
    });
});
</script>

<?php $this->endSection() ?>
