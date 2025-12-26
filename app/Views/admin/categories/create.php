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

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Kategori Baru</h3>
    </div>

    <form action="<?= base_url('/admin/categories/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       id="name" name="name" value="<?= old('name') ?>" required>
                <?php if(isset($errors['name'])): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?= $errors['name'] ?></strong>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                          id="description" name="description" rows="3"
                          placeholder="Masukkan deskripsi kategori (pilihan)"><?= old('description') ?></textarea>
                <?php if(isset($errors['description'])): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?= $errors['description'] ?></strong>
                    </span>
                <?php endif; ?>
                <small class="form-text text-muted">Maximum 1000 karakter</small>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox"
                           id="is_active" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?>>
                    <label for="is_active" class="custom-control-label">
                        Kategori aktif
                    </label>
                </div>
                <small class="form-text text-muted">Kategori aktif boleh digunakan untuk produk baru</small>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?= base_url('/admin/categories') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>

<?php $this->endSection() ?>
