# Implementasi Hak Akses - Pelanggan & Member (Laravel)

Modul Pelanggan & Member (Sistem Venue Olahraga) dengan pembatasan hak akses
memakai Middleware, Gate, dan Policy.

## Cara Menjalankan

1. `composer install`
2. Salin `.env.example` menjadi `.env`, lalu atur database MySQL:
   - `DB_CONNECTION=mysql`
   - `DB_DATABASE=venue_laravel_akses`
3. `php artisan key:generate`
4. `php artisan migrate --seed` (jawab yes jika database belum ada)
5. `php artisan serve`, lalu buka `http://127.0.0.1:8000`

Membutuhkan PHP 8.3 atau lebih dan MySQL.

## Akun Uji

| Peran  | Email             | Kata sandi  |
|--------|-------------------|-------------|
| Admin  | admin@venue.test  | password123 |
| Staff  | staff@venue.test  | password123 |
| Member | member@venue.test | password123 |

## Matriks Hak Akses

| Aksi                   | Belum login        | Member | Staff              | Admin |
|------------------------|--------------------|--------|--------------------|-------|
| Lihat daftar pelanggan | Dialihkan ke login | 403    | Ya                 | Ya    |
| Lihat kartu ringkasan  | Dialihkan ke login | 403    | Ya                 | Ya    |
| Tambah pelanggan       | Dialihkan ke login | 403    | Ya                 | Ya    |
| Ubah pelanggan         | Dialihkan ke login | 403    | Hanya status aktif | Ya    |
| Hapus pelanggan        | Dialihkan ke login | 403    | Tidak (403)        | Ya    |

## Implementasi

- **Autentikasi:** `AuthController` (login dan logout), middleware `auth` dan `guest`.
- **Middleware:** `EnsureUserHasRole` (alias `role`) pada `routes/web.php`.
- **Gate:** `lihat-ringkasan` di `AppServiceProvider`.
- **Policy:** `PelangganPolicy` (`viewAny`, `create`, `update`, `delete`).
- **Tampilan:** tombol disesuaikan lewat `@can` dan `@canany`. Penjagaan sebenarnya
  ada di server (`Gate::authorize` pada controller).