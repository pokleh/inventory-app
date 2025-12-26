<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Register - Inventory App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .register-header {
            background: #667eea;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        .register-body {
            padding: 40px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: #667eea;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
        }
        .btn-register:hover {
            background: #5a67d8;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .password-strength {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-container">
                    <div class="register-header">
                        <h3><i class="fas fa-user-plus me-2"></i>Daftar Akaun Baru</h3>
                        <p class="mb-0">Sertai Inventory App hari ini</p>
                    </div>

                    <div class="register-body">
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('/auth/attemptRegister') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nama Penuh
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           name="name"
                                           value="<?= old('name') ?>"
                                           required>
                                    <?php if(isset($errors['name'])): ?>
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?= $errors['name'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">
                                        <i class="fas fa-at me-2"></i>Username
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="username"
                                           name="username"
                                           value="<?= old('username') ?>"
                                           required>
                                    <?php if(isset($errors['username'])): ?>
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?= $errors['username'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       value="<?= old('email') ?>"
                                       required>
                                <?php if(isset($errors['email'])): ?>
                                    <div class="text-danger small mt-1">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $errors['email'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <input type="password"
                                           class="form-control"
                                           id="password"
                                           name="password"
                                           required>
                                    <?php if(isset($errors['password'])): ?>
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?= $errors['password'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirm" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Konfirmasi Password
                                    </label>
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirm"
                                           name="password_confirm"
                                           required>
                                    <?php if(isset($errors['password_confirm'])): ?>
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?= $errors['password_confirm'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-user-plus me-2"></i>Daftar Akaun
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <span class="text-muted">Sudah ada akaun?</span>
                            <a href="<?= base_url('/auth/login') ?>" class="text-decoration-none ms-1">
                                <strong>Log Masuk</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            updatePasswordStrength(strength);
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            return strength;
        }

        function updatePasswordStrength(strength) {
            const indicator = document.querySelector('.password-strength');
            if (!indicator) return;

            let text, className;
            switch(strength) {
                case 0:
                case 1:
                    text = 'Lemah';
                    className = 'strength-weak';
                    break;
                case 2:
                case 3:
                    text = 'Sederhana';
                    className = 'strength-medium';
                    break;
                case 4:
                case 5:
                    text = 'Kuat';
                    className = 'strength-strong';
                    break;
            }

            indicator.textContent = `Kekuatan password: ${text}`;
            indicator.className = `password-strength ${className}`;
        }
    </script>
</body>
</html>
