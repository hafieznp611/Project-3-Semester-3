# Activity Manager v1

Aplikasi manajemen kegiatan sederhana berbasis Laravel, dibangun sebagai bagian dari **Proyek 3 – Proyek Pengembangan Perangkat Lunak Berbasis Web, Modul 3: Frameworks in Programming - Laravel Basic**.

Aplikasi ini menangani CRUD kegiatan (daftar, detail, tambah, ubah, hapus), aturan transisi status kegiatan (`Planned → Ongoing → Done`), serta filter daftar kegiatan berdasarkan status dan kategori.

## Informasi Versi

- PHP: 8.3
- Composer: 2.x
- Laravel: 13.x
- Database: SQLite (baseline kelas)

## Fitur

- Daftar dan detail kegiatan (`GET /activities`, `GET /activities/{activity}`)
- Tambah, ubah, dan hapus kegiatan melalui resource controller
- Validasi input pada boundary HTTP menggunakan Form Request (`StoreActivityRequest`, `UpdateActivityRequest`)
- Business rule transisi status (`Planned → Ongoing → Done`, tidak dapat mundur) ditangani oleh `ActivityService`
- Filter daftar kegiatan berdasarkan `status` dan `category` melalui query string, contoh: `/activities?status=Planned&category=Workshop`

## Cara Menjalankan Proyek

1. **Clone repository**

   ```bash
   git clone <URL_REPOSITORY_ANDA>
   cd activity-manager
   ```

2. **Install dependency PHP**

   ```bash
   composer install
   ```

3. **Salin file environment**

   ```bash
   cp .env.example .env
   ```

4. **Generate application key**

   ```bash
   php artisan key:generate
   ```

5. **Siapkan database SQLite**

   ```bash
   touch database/database.sqlite
   ```

   Pastikan `.env` sudah mengarah ke SQLite:

   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/ke/database/database.sqlite
   ```

6. **Jalankan migration dan seeder**

   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan server pengembangan**

   ```bash
   php artisan serve
   ```

8. Buka `http://127.0.0.1:8000/activities` di browser.

## Route Utama

| Method    | URI                          | Action              | Deskripsi                      |
|-----------|-------------------------------|----------------------|----------------------------------|
| GET       | `/activities`                 | `index`             | Daftar kegiatan (mendukung filter `?status=` dan `?category=`) |
| GET       | `/activities/create`          | `create`             | Form tambah kegiatan            |
| POST      | `/activities`                 | `store`               | Simpan kegiatan baru             |
| GET       | `/activities/{activity}`      | `show`               | Detail kegiatan                 |
| GET       | `/activities/{activity}/edit` | `edit`                 | Form ubah kegiatan               |
| PUT/PATCH | `/activities/{activity}`      | `update`             | Simpan perubahan kegiatan        |
| DELETE    | `/activities/{activity}`      | `destroy`           | Hapus kegiatan                   |

Lihat daftar lengkap dengan:

```bash
php artisan route:list
```

## Struktur Proyek (bagian relevan)

```
activity-manager/
├── app/
│   ├── Http/
│   │   ├── Controllers/ActivityController.php
│   │   └── Requests/
│   │       ├── StoreActivityRequest.php
│   │       └── UpdateActivityRequest.php
│   ├── Models/Activity.php
│   └── Services/ActivityService.php
├── database/
│   ├── migrations/
│   └── seeders/ActivitySeeder.php
├── resources/views/
│   ├── layouts/app.blade.php
│   └── activities/
│       ├── index.blade.php
│       ├── show.blade.php
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── _form.blade.php
├── routes/web.php
├── sonar-project.properties
└── README.md
```

## Business Rules

| ID     | Aturan                                                                 |
|--------|--------------------------------------------------------------------------|
| BR-01  | Judul kegiatan wajib diisi, 5–100 karakter.                              |
| BR-02  | Tanggal kegiatan wajib diisi dan valid.                                  |
| BR-03  | Status hanya boleh `Planned`, `Ongoing`, atau `Done`.                    |
| BR-03A | Transisi status hanya berjalan maju (`Planned → Ongoing → Done`), tidak boleh mundur. |

## Static Analysis

Proyek ini menggunakan SonarQube untuk memeriksa code smell, duplication, complexity, dan maintainability issue.

```bash
sonar-scanner -Dsonar.host.url=<ALAMAT_SONARQUBE> -Dsonar.token=<TOKEN_ANDA>
```

Konfigurasi ada pada `sonar-project.properties`.

## Formatting

Konsistensi gaya kode dijaga menggunakan Laravel Pint:

```bash
./vendor/bin/pint
```

## Catatan

- Fitur authentication, session, ownership pengguna, dan role **belum** diimplementasikan pada versi ini (v1). Fitur tersebut direncanakan pada Modul 4 dan Modul 5.
- Aksi penting (logging) belum diimplementasikan penuh; direncanakan pada Modul 4.
