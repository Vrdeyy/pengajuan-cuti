# 🌴 Sistem Pengajuan Cuti (Absensi)

Aplikasi manajemen cuti berbasis web modern yang dibangun menggunakan **Laravel 12** dan **Filament PHP**. Didesain untuk mempermudah karyawan dalam mengajukan cuti dan HR/Admin dalam mengelola persetujuan cuti.

---

## 🚀 Fitur Utama

### 👑 Admin

- **Dashboard Statistik**: Melihat ringkasan jumlah user, cuti pending, dan statistik cuti (Grafik Tren).
- **Manajemen User**: Tambah, edit, dan hapus data karyawan.
- **Manajemen Jenis Cuti**: Mengatur tipe cuti (Cuti Tahunan, Sakit, dll) dan apakah memotong kuota cuti.
- **Approval Cuti**: Menyetujui atau menolak pengajuan cuti karyawan.
- **Laporan/Chart**: Visualisasi data cuti yang disetujui per bulan.

### 👤 Karyawan (User)

- **Dashboard Personal**: Melihat sisa kuota cuti dan status pengajuan terakhir.
- **Pengajuan Cuti**: Form mudah untuk mengajukan cuti baru.
- **Riwayat Cuti**: Memantau status pengajuan (Pending, Approved, Rejected).

---

## 🛠️ Tech Stack

- **Backend Framework**: Laravel 12
- **Admin Panel**: Filament PHP 3.2
- **Database**: MySQL
- **Frontend**: Blade & Tailwind CSS (via Filament)
- **Charts**: Chart.js (via Filament Widgets)

---

## 🔄 Alur Kerja Sistem (Flow)

### 1. Alur Karyawan

1. **Login** sebagai User.
2. Masuk ke **Dashboard** untuk melihat sisa cuti.
3. Masuk menu **Pengajuan Cuti** -> Klik **New Leave Request**.
4. Isi form (Tanggal Mulai, Selesai, Alasan).
5. Klik **Submit**. Status awal adalah **Pending**.
6. Menunggu persetujuan Admin.

### 2. Alur Admin

1. **Login** sebagai Admin.
2. Melihat notifikasi atau widget **Statistik** di Dashboard (misal: "Total Pending").
3. Buka menu **Leave Requests**.
4. Mengubah status pengajuan dari **Pending** menjadi **Approved** atau **Rejected**.
5. Jika **Approved**, kuota cuti karyawan akan otomatis berkurang (jika jenis cuti memotong saldo).

---

## ⚡ Cara Setup (Instalasi)

Ikuti langkah berikut untuk menjalankan project di local:

### Prasyarat

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Langkah-langkah

1. **Clone Repository**

    ```bash
    git clone https://github.com/vrdeyy/pengajuan-cuti.git
    cd pengajuan-cuti
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Setup Environment**
   Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Atur konfigurasi database di file `.env`:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cuti
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. **Generate Key**

    ```bash
    php artisan key:generate
    ```

5. **Migrate & Seed Database** (Penting untuk data awal)
   Perintah ini akan membuat tabel dan mengisi data dummy (15 user + data cuti):

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Build Assets**

    ```bash
    npm run build
    ```

7. **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Buka browser di: `http://127.0.0.1:8000/admin`

---

## 🔑 Akun Default

Gunakan akun berikut untuk login:

| Role         | Email            | Password   |
| ------------ | ---------------- | ---------- |
| **Admin**    | `admin@cuti.com` | `password` |
| **Karyawan** | `staff@cuti.com` | `password` |

_Note: Ada juga 15 user random lain yang dibuat oleh seeder dengan password `password`._

---

# 👨‍💻 Dev by Vrdeyy

Copyright © 2026 Vrdeyy. All rights reserved.
