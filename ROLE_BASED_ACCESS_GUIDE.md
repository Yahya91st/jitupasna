# Implementasi Role-Based Access Control dengan Spatie Permission

## Setup Guide

Untuk menerapkan sistem role-based access control dalam aplikasi JITUPASNA, ikuti langkah-langkah berikut:

### 1. Persiapan Database

Pastikan database sudah siap dan migrasi telah dijalankan:

```bash
php artisan migrate
```

### 2. Menjalankan Seeder untuk Role dan Permission

Untuk mengatur role dan permission dasar serta membuat user default:

```bash
php artisan db:seed --class=RoleSeeder
```

Command ini akan membuat:
- Super Admin user (email: super-admin@example.com, password: password)
- Admin user (email: admin@example.com, password: password)
- Regular user (email: user@example.com, password: password)

### 3. Daftar Role dan Permission

Aplikasi ini memiliki tiga role utama:

- **Super Admin**:
  - Memiliki permission: manage admins, manage categories, view forms, edit forms, manage disasters
  - Hanya dapat mengelola akun admin
  - Tidak dapat mengelola pengguna biasa

- **Admin**:
  - Memiliki permission: manage users, manage categories, view forms, edit forms, manage disasters
  - Hanya dapat mengelola akun pengguna biasa 
  - Tidak dapat mengelola admin lain atau super admin

- **User**:
  - Memiliki permission: view forms
  - Memiliki akses terbatas ke formulir tertentu
  - Tidak dapat mengelola pengguna lain

### 4. Struktur Permission

Permission dalam sistem ini:
- **manage users**: Mengelola akun pengguna biasa
- **manage admins**: Mengelola akun admin
- **manage categories**: Mengelola kategori data dasar
- **view forms**: Melihat formulir
- **edit forms**: Mengedit formulir
- **manage disasters**: Mengelola data bencana

### 5. Middleware

Aplikasi menggunakan dua middleware untuk mengamankan akses:
- **AdminMiddleware**: Membatasi akses hanya untuk role admin
- **RoleAccess**: Middleware yang lebih fleksibel untuk mengontrol akses berdasarkan role

### 6. Manajemen Pengguna

Manajemen pengguna dibagi sebagai berikut:
- **Super Admin** melihat dan mengelola hanya akun admin
- **Admin** melihat dan mengelola hanya akun pengguna biasa
- Setiap role hanya dapat membuat dan mengedit user dengan role yang sesuai:
  - Super Admin hanya dapat membuat dan mengedit akun admin
  - Admin hanya dapat membuat dan mengedit akun pengguna biasa

### 7. Penggunaan

- Login sebagai super-admin untuk mengelola admin (super-admin@example.com)
- Login sebagai admin untuk mengelola pengguna biasa (admin@example.com)
- Login sebagai user untuk akses terbatas ke formulir (user@example.com)
- Menu "Manajemen Pengguna" menampilkan konten yang berbeda berdasarkan role

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
