# Tugas Pendahuluan: Database Akademik (PHP & MySQL)

Aplikasi sederhana untuk mengelola data mahasiswa (NIM, Nama, Umur) menggunakan PHP murni dan MySQL.

## Isi Folder

| File | Fungsi |
|---|---|
| `database.sql` | Membuat database `akademik`, tabel `mahasiswa`, dan 5 data awal |
| `koneksi.php` | Koneksi PHP ke database MySQL |
| `tampil.php` | Membaca tabel dan menampilkan data ke layar |
| `input.php` | Form untuk menambah data mahasiswa ke tabel |

## Kebutuhan

- XAMPP (Apache + MySQL + PHP)
- Browser (Chrome, Edge, dll.)

## Langkah Menjalankan

### 1. Jalankan Server
1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada **Apache** dan **MySQL** sampai keduanya berwarna hijau.

### 2. Buka phpMyAdmin
1. Buka browser, lalu akses: `http://localhost/phpmyadmin`
2. Halaman phpMyAdmin akan terbuka.

### 3. Buat Database dan Tabel
1. Di phpMyAdmin, klik tab **SQL** pada menu atas.
2. Buka file `database.sql` dengan Notepad, salin seluruh isinya, lalu tempel di kolom SQL.
3. Klik tombol **Kirim / Go**.
4. Cek di panel kiri: database **akademik** dan tabel **mahasiswa** harus muncul.
5. Klik tabel `mahasiswa`, lalu tab **Jelajahi**. Harus ada **5 data** mahasiswa.

### 4. Pasang File PHP
1. Buka folder `C:\xampp\htdocs\`.
2. Buat folder baru bernama `akademik`.
3. Salin `koneksi.php`, `tampil.php`, dan `input.php` ke dalam folder tersebut.
   Hasil akhir: `C:\xampp\htdocs\akademik\`.

### 5. Jalankan Program
- **Menampilkan data:** `http://localhost/akademik/tampil.php`
  Akan tampil tabel berisi data mahasiswa.
- **Menambah data:** `http://localhost/akademik/input.php`
  Isi NIM, Nama, dan Umur, lalu klik **Simpan**. Buka kembali `tampil.php` untuk melihat data baru.

## Pengaturan Koneksi

Konfigurasi ada di `koneksi.php`:

```php
$host = "localhost";
$user = "root";
$pass = "";          
$db   = "akademik";
```

Jika MySQL memakai password, isi pada `$pass`.

## Struktur Tabel

```sql
CREATE TABLE mahasiswa (
    NIM  VARCHAR(10) PRIMARY KEY,
    NAMA VARCHAR(100) NOT NULL,
    UMUR INT NOT NULL
);
```

## Pemecahan Masalah

| Masalah | Solusi |
|---|---|
| `404 Not Found` | Pastikan nama file dan folder benar, dan file ada di `htdocs/akademik` |
| `Koneksi gagal` | Pastikan MySQL sudah Start dan `$pass` di `koneksi.php` sesuai |
| Kode PHP tampil mentah | Buka lewat `http://localhost/...`, bukan klik dua kali file |
| Apache tidak mau Start | Port 80 bentrok; ubah `Listen 80` menjadi `Listen 8080` di `httpd.conf`, lalu akses lewat `localhost:8080` |
| Gagal simpan data | NIM sudah ada (NIM bersifat unik), gunakan NIM lain |

## Identitas

- Nama : HAFIEZ NOVRIZAL PUTRA
- NIM  : 251511011
