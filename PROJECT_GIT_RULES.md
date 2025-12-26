# Project Git Rules - Inventory App

## Overview
Dokumen ini menetapkan aturan dan prosedur untuk pengelolaan version control Git pada project Inventory App. Semua perubahan kode harus mengikuti panduan ini untuk memastikan konsistensi dan traceability yang baik.

## Aturan Umum

### 1. Branch Management
- **Main branch**: `master` (untuk production code)
- **Development branch**: `develop` (untuk development aktif)
- **Feature branches**: `feature/nama-fitur` (untuk fitur baru)
- **Bug fix branches**: `bugfix/nama-bug` (untuk perbaikan bug)
- **Hotfix branches**: `hotfix/nama-hotfix` (untuk perbaikan urgent)

### 2. Commit Messages
Setiap commit harus mengikuti format standar:
```
<type>(<scope>): <description>

[optional body]

[optional footer]
```

**Types:**
- `feat`: Fitur baru
- `fix`: Perbaikan bug
- `docs`: Perubahan dokumentasi
- `style`: Perubahan style (formatting, missing semicolons, etc)
- `refactor`: Refactoring kode
- `test`: Menambah atau memperbaiki test
- `chore`: Perubahan maintenance

**Examples:**
```
feat(auth): add user login functionality
fix(validation): correct email validation regex
docs(readme): update installation instructions
refactor(user): simplify user creation logic
```

### 3. Workflow Perubahan

#### Sebelum Melakukan Perubahan
1. **Check status repository**:
   ```bash
   git status
   git log --oneline -5
   ```

2. **Pastikan branch yang benar**:
   ```bash
   git branch
   git checkout <appropriate-branch>
   ```

#### Saat Melakukan Perubahan
1. **Buat branch baru untuk fitur/perbaikan** (jika belum ada):
   ```bash
   git checkout -b feature/nama-fitur
   # atau
   git checkout -b bugfix/nama-bug
   ```

2. **Lakukan perubahan kode**

3. **Test perubahan** (jalankan test jika ada)

4. **Stage perubahan**:
   ```bash
   git add <files>
   # atau untuk semua perubahan
   git add .
   ```

5. **Commit dengan pesan yang jelas**:
   ```bash
   git commit -m "feat(user): add password reset functionality

   - Add reset password endpoint
   - Implement email notification
   - Add validation for reset token"
   ```

6. **Push ke remote**:
   ```bash
   git push origin <branch-name>
   ```

#### Setelah Perubahan Selesai
1. **Buat Pull Request** (jika menggunakan GitHub/GitLab)
2. **Merge ke branch utama** setelah review
3. **Hapus branch lokal** setelah merge:
   ```bash
   git branch -d feature/nama-fitur
   ```

### 4. Emergency Procedures

#### Jika Ada Konflik Merge
```bash
# Abort merge jika ada masalah
git merge --abort

# Atau resolve konflik secara manual kemudian:
git add <resolved-files>
git commit -m "fix(merge): resolve merge conflicts"
```

#### Jika Commit Salah
```bash
# Amend commit terakhir
git commit --amend -m "Updated commit message"

# Atau reset ke commit sebelumnya (hati-hati!)
git reset --soft HEAD~1  # Keep changes staged
git reset --mixed HEAD~1 # Unstage changes but keep in working directory
git reset --hard HEAD~1  # Delete changes completely
```

#### Jika Ada Perubahan yang Tidak Diinginkan
```bash
# Discard working directory changes
git checkout -- <file>
# atau untuk semua files
git checkout -- .
```

### 5. Code Review Requirements
- Setiap Pull Request harus memiliki minimal 1 reviewer
- Semua tests harus pass
- Code coverage minimal 80%
- Tidak ada linting errors

### 6. Backup dan Recovery
- Backup repository dilakukan otomatis setiap hari
- Emergency restore procedure tersedia di folder `docs/backup-recovery.md`

### 7. Monitoring dan Auditing
- Semua commits akan dilog dengan timestamp
- Regular audit dilakukan setiap bulan
- Security scan dilakukan setiap minggu

## Tools dan Integration

### Git Hooks (Pre-commit)
Project ini menggunakan pre-commit hooks untuk:
- Menjalankan linting
- Menjalankan tests
- Memvalidasi commit messages
- Mengecek file yang tidak boleh di-commit

### CI/CD Integration
- GitHub Actions untuk automated testing
- CodeQL untuk security scanning
- Dependabot untuk dependency updates

## Exceptions
Aturan ini dapat dikecualikan hanya dalam kondisi emergency dengan persetujuan dari project lead. Semua exceptions harus didokumentasikan.

## Contact
Untuk pertanyaan tentang git management, hubungi:
- Project Lead: [nama/email]
- DevOps Team: [nama/email]

---

**Last Updated**: December 26, 2025
**Version**: 1.0
