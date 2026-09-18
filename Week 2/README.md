# Project-3-Semester-3

Kumpulan proyek latihan **Modul 2 — Vanilla JavaScript dan Interaktivitas Web**, mencakup dasar JavaScript, DOM & Event, validasi form, hingga Asynchronous JavaScript (Promise/fetch).

## Struktur Folder

```
Project-3-Semester-3/
├── eksperimen-2-dom-event/
│   ├── index.html
│   ├── style.css
│   └── app.js
├── eksperimen-4-async-loader/
│   ├── index.html
│   ├── style.css
│   ├── app.js
│   └── features.json
├── 251511011_Hafiez_Novrizal_Putra_Worksheet_Modul2_pdf.docx
└── README.md
```

> Catatan: sesuaikan penamaan folder `eksperimen-2-dom-event` dan `eksperimen-4-async-loader` di atas dengan struktur folder lokal Anda yang sebenarnya.

## 1. Eksperimen 2 — DOM dan Event

**Lokasi:** `eksperimen-2-dom-event/`

Latihan manipulasi DOM dan penanganan event dasar.

**Fitur:**
- Tombol **Ubah judul** — mengubah teks judul halaman (`textContent`) dan menampilkan pesan status.
- Tombol **Toggle status** — menambah/menghapus class `is-active` pada `<body>` untuk mengganti tampilan (mode gelap/terang) sekaligus memperbarui atribut `aria-pressed`.
- Input **Nama mahasiswa** — menghitung jumlah karakter yang diketik secara real-time dan menampilkannya sebagai counter (maksimal 30 karakter).

**Konsep yang dilatih:** `querySelector`, `addEventListener`, manipulasi `textContent` dan `classList`, atribut ARIA untuk aksesibilitas.

**Cara menjalankan:** buka `index.html` langsung di browser.

## 2. Eksperimen 4 — Asynchronous JavaScript (Async Data Loader)

**Lokasi:** `eksperimen-4-async-loader/`

Latihan penggunaan `Promise`, `async/await`, dan `fetch` untuk memuat data secara asynchronous, lengkap dengan penanganan state UI (idle, loading, success, empty, error).

**Fitur:**
- Tombol **Muat data** — mengambil data dari `features.json` menggunakan `fetch`, lalu me-render setiap item sebagai kartu (`article.feature-card`) di dalam halaman.
- Penanganan status/state UI melalui atribut `data-state` (`idle`, `loading`, `success`, `empty`, `error`) yang juga mengubah tampilan warna indikator status (lihat `style.css`).
- Penanganan error: HTTP tidak `ok`, data bukan array, hingga data kosong.
- Tombol otomatis dinonaktifkan (`disabled` + `aria-busy`) selama proses pemuatan berlangsung, dan diaktifkan kembali melalui blok `finally`.
- Contoh demonstrasi *event loop*: urutan log `A → B → C` untuk menunjukkan bahwa `setTimeout(..., 0)` tetap dijalankan setelah kode sinkron selesai.

**Data:** `features.json` berisi array objek dengan properti `judul` dan `deskripsi`.

**Cara menjalankan:** karena menggunakan `fetch` ke file lokal, jalankan melalui *server pengembangan lokal* (misalnya ekstensi Live Server di VS Code, atau `npx serve`), bukan dibuka langsung sebagai file (`file://`).

## Worksheet

File `251511011_Hafiez_Novrizal_Putra_Worksheet_Modul2_pdf.docx` berisi worksheet mahasiswa yang mendokumentasikan proses eksperimen (prediksi, hasil aktual, dan bukti pengujian) serta jawaban pertanyaan pemahaman terkait materi Modul 2.

## Teknologi

- HTML5 (semantik + atribut aksesibilitas seperti `aria-live`, `aria-pressed`, `aria-busy`)
- CSS3 (transisi sederhana, styling berbasis `data-state`)
- Vanilla JavaScript (ES6+): DOM API, Event Listener, Promise, `async/await`, `fetch`
