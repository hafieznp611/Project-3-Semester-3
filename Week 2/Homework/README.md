# Interactive Profile Card

Kartu profil interaktif yang memuat data profil dan daftar keterampilan
secara asinkron dari `data/profile.json`. Mendukung buka/tutup detail,
ganti tema terang/gelap, tambah keterampilan (dengan validasi), dan
hapus keterampilan.

## Struktur Proyek

```
profile-card/
├── index.html
├── style.css
├── app.js
├── profile.json
├── profile.ong
└── README.md
```

## Cara Menjalankan

Halaman ini **memuat `data/profile.json` menggunakan `fetch()`**, yang
mengharuskan file dibuka lewat server, bukan langsung dibuka dari
`file://` di browser (permintaan `fetch` ke file lokal diblokir oleh
kebijakan CORS browser). Kalau dibuka langsung dari file, halaman akan
tersangkut di state loading lalu menampilkan pesan error dengan tombol
**Coba Lagi**.

Pilih salah satu cara berikut untuk menjalankan local server dari
folder `profile-card/`:

### Opsi 1: Python (paling umum, tidak perlu install apa pun)

```bash
cd profile-card
python -m http.server 8000
```

Buka `http://localhost:8000` di browser.

### Opsi 2: Node.js (`http-server`)

```bash
npm install -g http-server
cd profile-card
http-server -p 8000
```

Buka `http://localhost:8000`.

### Opsi 3: Ekstensi Live Server di VS Code

1. Install ekstensi **Live Server** (oleh Ritwick Dey) di VS Code.
2. Buka folder `profile-card/` di VS Code.
3. Klik kanan `index.html` → **Open with Live Server**.

## Fitur

- **Muat data asinkron** — profil dan keterampilan awal diambil dari
  `data/profile.json` lewat `fetch()`.
- **State lengkap**:
  - *Loading* — teks di `#status-fetch` ("Memuat profil...") ditampilkan selagi `fetch()` berjalan.
  - *Empty* — pesan "Belum ada keterampilan yang ditambahkan" muncul di `#daftar-keterampilan` kalau daftar kosong.
  - *Error* + **Coba Lagi** — kalau `fetch()` gagal, `#status-fetch` menampilkan pesan error dan `#tombol-coba-lagi` muncul untuk memuat ulang.
- **Detail profil** — tombol "Lihat Detail" pakai `classList.toggle()`
  dan atribut `aria-expanded` untuk aksesibilitas.
- **Tambah keterampilan** — form dengan validasi lewat fungsi
  `validasiKeterampilan()` (pola sama seperti `validasiPeserta` di
  contoh Daftar Peserta): menolak input kosong dan menolak nama yang
  sudah ada di daftar. Status hasil validasi ditandai lewat
  `aria-invalid="true"/"false"` pada input dan pesan error di `<small>`.
- **Hapus keterampilan** — setiap item punya tombol hapus sendiri.
- **Anti-duplikasi** — daftar keterampilan selalu digambar ulang dari
  satu sumber data (`daftarKeterampilanData`) memakai
  `replaceChildren()`, jadi klik berulang pada tombol apa pun (tambah,
  hapus, atau Coba Lagi) tidak pernah menghasilkan data ganda di layar.
- **Ganti tema** — tombol ikon bulan/matahari untuk beralih antara
  tema terang dan gelap.

## Mengedit Data Profil

Cukup ubah isi `data/profile.json`:

```json
{
    "nama": "Nama Kamu",
    "jabatan": "Jabatan/Peran",
    "foto": "URL atau path foto",
    "bio": "Deskripsi singkat",
    "email": "email@contoh.com",
    "keterampilan": ["Skill 1", "Skill 2"]
}
```
