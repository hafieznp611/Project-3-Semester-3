
Landing page sederhana berbasis HTML & CSS untuk memperkenalkan Program Studi D3 Teknik Informatika, mencakup informasi umum (Visi & Misi), kurikulum, prospek karier, dan fasilitas.

Website ini merupakan halaman satu-page (single page) yang menampilkan:
- **Navbar** dengan navigasi ke bagian Tentang, Kurikulum, Karier, dan Fasilitas
- **Section Tentang** — foto laboratorium, nama program studi, serta Visi dan Misi
- **Section Content** — informasi Kurikulum & Peminatan, Prospek Karier, dan Fasilitas


Strukrtur
├── index.html      # Struktur utama halaman
├── style.css       # Styling (warna, layout, efek hover, dsb.)
├── LabAI.png       # Gambar laboratorium yang ditampilkan di section Tentang
└── README.md       # Dokumentasi proyek ini
```

- Desain tema gelap dengan aksen warna emas (`#c9a227`)
- Layout section "Tentang" menggunakan CSS Grid: gambar di kiri, nama prodi di tengah, Visi & Misi tersusun vertikal di kanan
- Kartu konten (Kurikulum, Karier, Fasilitas) dengan efek *hover* mengangkat (transform + shadow)
- Navbar fixed di bagian atas dengan efek hover pada tombol navigasi
- Responsive dasar menggunakan `flex-wrap` pada navbar

Teknologi yang Digunakan
- HTML5
- CSS3 (Flexbox & Grid)

