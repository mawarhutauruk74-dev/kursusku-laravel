# KursusKu — Aplikasi Pengelolaan Kursus

## 1. Deskripsi Proyek

KursusKu merupakan aplikasi web berbasis Laravel yang dikembangkan untuk praktikum Pemrograman Web III. Aplikasi ini digunakan untuk menampilkan dan mengelola informasi kursus, data peserta, serta pendaftaran kursus.

Aplikasi ini menerapkan konsep pengembangan web menggunakan Route, Controller, Model, Blade Template Engine, dan database.

## 2. Tujuan Pengembangan

Tujuan pengembangan KursusKu adalah:
1. Menerapkan penggunaan framework Laravel dalam pengembangan aplikasi web.
2. Memahami hubungan antara route, controller, model, database, dan Blade.
3. Menampilkan data kursus secara dinamis.
4. Mengelola data kursus dan pendaftaran peserta.
5. Menerapkan pencarian, filter, dan pagination pada data.
6. Mendokumentasikan proses pengembangan dan pengujian aplikasi.

## 3. Teknologi yang Digunakan

Teknologi yang digunakan dalam proyek ini meliputi:
- PHP
- Laravel
- Blade Template Engine
- Bootstrap
- JavaScript dan jQuery
- Vite
- SQLite sebagai database proyek
- Eloquent ORM untuk interaksi dengan database
- Git untuk pengelolaan versi kode

## 4. Fitur Aplikasi

Fitur utama KursusKu meliputi:

1. Halaman beranda yang menampilkan informasi dan statistik kursus.
2. Katalog untuk melihat daftar kursus.
3. Pengelolaan data kursus melalui fitur CRUD.
4. Pencarian dan filter data kursus.
5. Pagination untuk membagi tampilan daftar data.
6. Pendaftaran peserta kursus.
7. Pengelolaan data peserta dan enrollment.
8. Relasi data menggunakan Eloquent ORM.
9. Tampilan responsif menggunakan Bootstrap.
10. Pengecekan ketersediaan kursus melalui route yang disediakan aplikasi.

## 5. Data Kursus

Berikut contoh data kursus yang digunakan dalam proyek:

| Kode | Nama Kursus | Biaya |
|---|---|---:|
| WEB001 | Pemrograman Web Dasar | Rp200.000 |
| PHP001 | Pemrograman PHP | Rp250.000 |
| LAR001 | Laravel Fundamental | Rp350.000 |

Data kursus yang ditampilkan pada aplikasi mengikuti isi database yang digunakan.

## 6. Alur Halaman Beranda

Halaman beranda menggunakan route utama `/` yang diberi nama `home`.

Route tersebut memanggil method `index()` pada `HomeController`. Controller mengambil maksimal enam kursus dengan status `open`, mengurutkannya berdasarkan tanggal mulai, serta menghitung statistik kursus, kursus yang dibuka, peserta, dan pendaftaran.

Data tersebut dikirim ke `home.blade.php` menggunakan `compact('featured', 'stats')`.

Alur pemrosesan halaman beranda adalah:

1. Pengguna membuka halaman KursusKu melalui browser.
2. Laravel menerima permintaan melalui route pada `routes/web.php`.
3. Route memanggil `HomeController@index`.
4. Controller mengambil data yang diperlukan melalui model dan database.
5. Controller mengirim data ke `home.blade.php`.
6. Blade menghasilkan tampilan HTML yang dikirim kembali ke browser.

## 7. Struktur Proyek

Struktur utama proyek KursusKu adalah:

```text
kursusku-laravel-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
├── public/
│   └── images/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── evidence/
│   └── week-07/
├── README.md
├── package.json
└── artisan
```

Keterangan:
- `app/Http/Controllers/` menyimpan controller aplikasi.
- `app/Models/` menyimpan model untuk berinteraksi dengan database.
- `database/` berisi berkas dan konfigurasi terkait database proyek.
- `public/` menyimpan aset publik, termasuk gambar.
- `resources/views/` menyimpan template Blade.
- `routes/web.php` berisi definisi route aplikasi.
- `evidence/week-07/` menyimpan bukti praktikum Pertemuan 7.

## 8. Persyaratan Sistem

Perangkat yang digunakan untuk menjalankan proyek perlu memiliki:
- PHP dengan versi yang sesuai dengan kebutuhan proyek.
- Composer.
- Laravel sesuai dependensi proyek.
- Node.js dan npm untuk pengelolaan aset frontend.
- Database yang sesuai dengan konfigurasi proyek.

## 9. Cara Menjalankan Aplikasi

### 9.1. Masuk ke direktori proyek

Buka terminal pada direktori proyek:

```bash
cd C:\laragon\www\kursusku-laravel-app
```

### 9.2. Instal dependensi PHP jika diperlukan

```bash
composer install
```

Langkah ini diperlukan apabila dependensi proyek belum tersedia.

### 9.3. Periksa konfigurasi lingkungan

Pastikan file `.env` tersedia dan konfigurasi database sesuai dengan proyek yang digunakan.

Jangan mengganti konfigurasi database atau membuat ulang database apabila aplikasi sudah berjalan dengan konfigurasi yang ada.

### 9.4. Jalankan server Laravel

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

### 9.5. Buka aplikasi

Akses alamat berikut melalui browser:

http://127.0.0.1:8000

### 9.6. Jalankan aset frontend jika diperlukan

```bash
npm run dev
```

Jika PowerShell memblokir `npm.ps1`, perintah berikut dapat digunakan:

```powershell
npm.cmd run dev
```

Server aset frontend hanya perlu dijalankan apabila dibutuhkan oleh konfigurasi Vite proyek.

## 10. Pengujian Aplikasi

Pengujian dilakukan untuk memastikan fungsi utama aplikasi berjalan sesuai kebutuhan.

Pemeriksaan meliputi:
1. Memastikan halaman beranda dapat dibuka.
2. Memastikan route aplikasi terdaftar.
3. Memastikan data kursus ditampilkan pada halaman beranda.
4. Memastikan foto dan aset tampilan dapat dimuat.
5. Memeriksa tampilan aplikasi pada layar desktop dan perangkat mobile.
6. Memastikan fitur pengelolaan kursus dan pendaftaran berjalan.
7. Memeriksa dokumentasi dan bukti praktikum.

## 11. Dokumentasi Praktikum Pertemuan 7

Bukti praktikum disimpan dalam direktori:

```text
evidence/week-07/
```

Berkas bukti yang disiapkan meliputi:

| Nama Berkas | Keterangan |
|---|---|
| `01-tools.png` | Screenshot informasi perangkat dan versi teknologi |
| `02-laravel-home.png` | Screenshot halaman beranda KursusKu |
| `03-route-list.png` | Screenshot daftar route Laravel |
| `04-mobile-view.png` | Screenshot tampilan aplikasi pada layar mobile |
| `05-git-log.png` | Screenshot riwayat commit Git |
| `request-lifecycle.png` | Diagram alur request Laravel |
| `ai-usage-log.md` | Catatan penggunaan AI dalam pengerjaan praktikum |

## 12. Penggunaan AI

AI digunakan sebagai alat bantu belajar untuk memahami struktur proyek Laravel, menjelaskan konsep route dan controller, membantu mengidentifikasi kendala, serta menyusun dokumentasi praktikum.

Saran yang diberikan perlu disesuaikan dan diverifikasi terhadap kondisi proyek. Pengujian aplikasi dan pemahaman terhadap kode tetap menjadi tanggung jawab mahasiswa.

Catatan penggunaan AI lebih lanjut tersedia pada `evidence/week-07/ai-usage-log.md`.

## 13. Penutup

KursusKu merupakan proyek praktikum yang menerapkan konsep pengembangan aplikasi web menggunakan Laravel. Melalui proyek ini, mahasiswa mempelajari pengelolaan route, controller, model, database, Blade, serta dokumentasi dan pengujian aplikasi.

---