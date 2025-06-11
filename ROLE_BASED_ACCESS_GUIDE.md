# Implementasi Role-Based Access Control dengan Spatie Permission

## Setup Guide

Untuk menerapkan sistem role-based access control dalam aplikasi JITUPASNA, ikuti langkah-langkah berikut:

### 1. Persiapan Database

Pastikan database sudah siap dan migrasi telah dijalankan:

```bash
php artisan migrate
```

### 2. Menjalankan Seeder untuk Role dan Permission

Untuk mengatur role dan permission dasar serta membuat user admin dan regular:

```bash
php artisan roles:refresh
```

Command ini akan membuat:
- Admin user (email: admin@example.com, password: password)
- Regular user (email: user@example.com, password: password)

### 3. Daftar Role dan Permission

Aplikasi ini memiliki dua role utama:
- **Admin**: Memiliki akses penuh ke semua fitur
- **User**: Memiliki akses terbatas ke formulir tertentu

### 4. Fitur yang Telah Diimplementasi

1. **Menu berbeda untuk admin dan user**:
   - Admin melihat semua menu dan form
   - User hanya melihat form yang relevan

2. **Middleware Admin**:
   - Melindungi route yang hanya boleh diakses admin

3. **Manajemen Pengguna**:
   - Admin dapat menambah, mengedit, dan menghapus user
   - Admin dapat mengubah role user

### 5. Penggunaan

- Login sebagai admin untuk akses penuh
- Login sebagai user untuk akses terbatas
- Admin dapat mengakses manajemen pengguna lewat menu "Manajemen Pengguna" di sidebar

### 6. Petunjuk Pengembangan Lanjutan

- Untuk menambah role atau permission baru, edit file `RoleSeeder.php`
- Untuk menambah menu khusus role tertentu, gunakan directive `@role('nama_role')` dalam view

## Troubleshooting

Jika mengalami masalah dengan permission:

```bash
php artisan cache:clear
php artisan config:clear
php artisan roles:refresh
```
