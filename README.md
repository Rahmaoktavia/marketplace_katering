# Marketplace Katering

## Deskripsi

Marketplace Katering adalah aplikasi berbasis web yang dibangun menggunakan Laravel 12 untuk menghubungkan penyedia usaha katering dengan customer yang membutuhkan layanan makanan. Aplikasi ini menyediakan fitur pengelolaan profil usaha, kategori dan menu katering, pemesanan, pembayaran, serta invoice.

## Fitur

### Merchant
- Registrasi dan login sebagai merchant.
- Mengelola profil usaha katering.
- Mengelola kategori dan menu katering.
- Melihat pesanan masuk dan memperbarui status pesanan.
- Melihat invoice terkait pesanan.

### Customer
- Registrasi dan login sebagai customer.
- Mencari menu berdasarkan kata kunci, kota, dan kategori.
- Melihat detail menu dan informasi merchant.
- Memesan menu berdasarkan jumlah porsi dan tanggal pengiriman.
- Melakukan pembayaran melalui Midtrans.
- Melihat riwayat dan detail pesanan.
- Melihat invoice pesanan.

## Teknologi

- PHP
- Laravel 12
- MySQL
- Bootstrap 5
- Midtrans untuk integrasi pembayaran

## Persyaratan

Pastikan perangkat telah memiliki:
- PHP 8.2 atau versi yang sesuai dengan persyaratan Laravel 12.
- Composer.
- MySQL.
- Web browser.

## Persiapan dan Instalasi

1. Clone repository:
   git clone <URL_REPOSITORY>

2. Masuk ke folder project:
   cd marketplace-katering

3. Instal dependensi PHP:
   composer install

4. Salin file konfigurasi environment .env.example menjadi .env.

5. Buat application key:
   php artisan key:generate

6. Buat database MySQL, lalu sesuaikan konfigurasi 

7. Impor database dari file SQL yang tersedia di database/marketplace_katering.sql melalui phpMyAdmin atau klien MySQL. 

8. Sesuaikan konfigurasi Midtrans berdasarkan kredensial dan variabel environment yang digunakan aplikasi. 

9. Jika aplikasi menggunakan penyimpanan foto melalui Laravel public storage, jalankan:
   php artisan storage:link

10. Jalankan aplikasi:
    php artisan serve

12. Buka alamat lokal yang ditampilkan oleh Laravel pada browser.

## Database

File SQL tersedia di database/marketplace_katering.sql

