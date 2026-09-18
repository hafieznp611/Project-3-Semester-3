'use strict';

const peserta = [
  { id: 1, nama: 'Alya', prodi: 'Teknik Informatika' },
  { id: 2, nama: 'Bima', prodi: 'Sistem Informasi' },
];

const form = document.querySelector('#form-peserta');
const namaInput = document.querySelector('#nama');
const prodiInput = document.querySelector('#prodi');
const filterInput = document.querySelector('#filter-prodi');
const daftar = document.querySelector('#daftar-peserta');
const status = document.querySelector('#status');
const errorNama = document.querySelector('#error-nama');
const errorProdi = document.querySelector('#error-prodi');

function validasiPeserta(calon) {
  let pesanNama = '';
  let pesanProdi = '';

  if (!calon.nama || calon.nama.trim() === '') {
    pesanNama = 'Nama peserta wajib diisi.';
  } else if (calon.nama.trim().length < 3) {
    pesanNama = 'Nama minimal 3 karakter.';
  }

  if (!calon.prodi) {
    pesanProdi = 'Program studi wajib dipilih.';
  }

  return {
    valid: pesanNama === '' && pesanProdi === '',
    errorNama: pesanNama,
    errorProdi: pesanProdi,
  };
}

function buatKartuPeserta(item) {
  const article = document.createElement('article');
  article.className = 'kartu';

  const judul = document.createElement('h2');
  judul.textContent = item.nama;

  const deskripsi = document.createElement('p');
  deskripsi.textContent = item.prodi;

  article.append(judul, deskripsi);
  return article;
}

function renderPeserta(data) {
  daftar.textContent = '';

  if (data.length === 0) {
    const kosong = document.createElement('p');
    kosong.textContent = 'Belum ada peserta yang terdaftar.';
    daftar.append(kosong);
    return;
  }

  data.forEach((item) => {
    daftar.append(buatKartuPeserta(item));
  });
}

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const calon = {
    nama: namaInput.value,
    prodi: prodiInput.value,
  };

  const hasil = validasiPeserta(calon);

  namaInput.setAttribute('aria-invalid', hasil.errorNama ? 'true' : 'false');
  prodiInput.setAttribute('aria-invalid', hasil.errorProdi ? 'true' : 'false');
  errorNama.textContent = hasil.errorNama;
  errorProdi.textContent = hasil.errorProdi;

  if (!hasil.valid) {
    status.textContent = 'Periksa kembali data yang diisi.';
    return;
  }

  const idBaru = peserta.length > 0
    ? Math.max(...peserta.map((p) => p.id)) + 1
    : 1;

  peserta.push({
    id: idBaru,
    nama: calon.nama.trim(),
    prodi: calon.prodi,
  });

  form.reset();
  status.textContent = 'Peserta berhasil ditambahkan.';
  renderPeserta(peserta);
});

filterInput.addEventListener('change', () => {
  const nilaiFilter = filterInput.value;

  if (nilaiFilter === 'semua') {
    renderPeserta(peserta);
  } else {
    const hasilFilter = peserta.filter((item) => item.prodi === nilaiFilter);
    renderPeserta(hasilFilter);
  }
});

renderPeserta(peserta);