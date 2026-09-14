

Halaman artikel/berita sederhana berbasis HTML & CSS yang menampilkan publikasi kegiatan Program Studi D3 Teknik Informatika, dalam contoh ini berupa berita "Lokakarya Web Dasar".


Halaman ini menyajikan artikel kegiatan dengan format:
- **Navbar** — judul portal dan navigasi ke bagian Kegiatan
- **Section Overview** — judul artikel, penulis, waktu publikasi, lokasi, dan ringkasan singkat
- **Section Content** — pembahasan lebih detail berupa Latar Belakang dan Rangkaian Kegiatan
- **Footer** — catatan penutup artikel


Struktur signkat
├── artikel.html    # Struktur halaman artikel
├── style.css       # Styling utama (navbar, kartu konten, footer, background blur)
├── artikel.css     # Styling navbar (varian warna merah)
├── images.jpg      # Gambar background halaman
└── README.md       # Dokumentasi proyek ini
```

Tampilan
- Background halaman berupa gambar gedung dengan efek blur menggunakan `body::before`
- Navbar fixed dengan gradasi warna biru–oranye (`style.css`)
- Kartu konten (`.Sub-Content`) bergradasi senada dengan efek bayangan (shadow) dan blur transparan (glassmorphism)
- Footer dengan gradasi warna transparan dan efek blur serupa

Teknologi yang Digunakan
- HTML5
- CSS 


