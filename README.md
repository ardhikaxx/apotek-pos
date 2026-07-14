# 💊 Apotek App - Sistem Informasi Manajemen Apotek

Apotek App adalah platform manajemen farmasi modern yang dibangun dengan Laravel 12. Sistem ini dirancang untuk menyederhanakan operasional apotek, mulai dari manajemen inventaris, pencatatan pembelian stok, hingga transaksi kasir (POS) yang cepat dan akurat.

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 🚀 Fitur Utama

Sistem ini mendukung multi-role dengan hak akses yang disesuaikan untuk Admin, Apoteker, dan Pelanggan.

### 🔐 Role: Admin (Otoritas Penuh)
- **Dashboard:** Ringkasan statistik (pendapatan hari ini/bulan ini, total produk, stok kritis).
- **Manajemen Produk:** Kelola data obat, kategori, satuan, dan pemantauan stok.
- **Monitoring Expired:** Laporan otomatis obat yang sudah atau hampir kedaluwarsa.
- **Supplier & Customer:** Kelola database pemasok dan pelanggan tetap.
- **Pembelian (Restock):** Pencatatan stok masuk dari supplier dengan update otomatis ke inventaris.
- **Laporan Penjualan:** Filter berdasarkan tanggal dan ekspor ke PDF (DomPDF).
- **Manajemen User:** Kelola akun staf (Admin & Apoteker).
- **Point of Sale (POS):** Akses penuh ke sistem kasir.

### 👨‍⚕️ Role: Apoteker (Operasional)
- **Dashboard:** Statistik penjualan harian pribadi dan alert stok habis.
- **Smart POS:** Sistem kasir cepat dengan pencarian produk real-time dan cetak struk PDF (80mm/Thermal).
- **Stok Monitoring:** Memantau sisa stok dan produk expired secara berkala.
- **Laporan Harian:** Rekap transaksi yang dilakukan pada shift berjalan.

### 👥 Role: Pelanggan (Informasi)
- **Katalog Produk:** Mencari dan melihat daftar obat yang tersedia.
- **Status Stok:** Informasi real-time apakah produk sedang *Ready* atau *Kosong*.

---

## 🛠️ Tech Stack

- **Backend:** [Laravel 12](https://laravel.com)
- **Frontend:** [Tailwind CSS 4](https://tailwindcss.com), Blade Templating
- **Bundler:** [Vite](https://vitejs.dev)
- **Database:** MySQL / SQLite
- **PDF Engine:** [DomPDF](https://github.com/barryvdh/laravel-dompdf)
- **Icons:** Heroicons

---

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/apotek-app.git
   cd apotek-app
   ```

2. **Instal Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Sesuaikan pengaturan database di file `.env`.*

4. **Migrasi & Seeding**
   ```bash
   php artisan migrate --seed
   ```

5. **Build Aset Frontend**
   ```bash
   npm run build
   # atau untuk development:
   npm run dev
   ```

6. **Jalankan Server**
   ```bash
   php artisan serve
   ```

---

## 🔑 Akun Default (Demo)

Gunakan akun berikut setelah menjalankan `php artisan db:seed`:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `password` |
| **Apoteker** | `apoteker@gmail.com` | `password` |

---

## 📊 Database Schema Highlights

- **Integritas Data:** Menggunakan `DB::transaction` untuk memastikan data penjualan dan stok selalu konsisten.
- **Concurrency:** Implementasi `lockForUpdate` pada modul POS untuk mencegah *race conditions* saat stok menipis.
- **Relasi:** Eloquent Relationship yang kuat antara Produk, Kategori, Transaksi, dan User.

---

## 📜 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).


## Donasi

Jika project ini bermanfaat, Anda dapat mendukung pengembangan selanjutnya melalui donasi:

<div align="center">

<img src="public/assets/qris.png" alt="QRIS" width="250" />

**Scan QRIS di atas untuk berdonasi**

Setiap donasi akan digunakan untuk:
- Pengembangan fitur baru
- Perbaikan bug & maintenance
- Infrastruktur server

</div>