'use strict';

let keterampilan = [];

const statusFetch = document.querySelector('#status-fetch');
const tombolCobaLagi = document.querySelector('#tombol-coba-lagi');
const kartuProfil = document.querySelector('#kartu-profil');

const fotoProfil = document.querySelector('#foto-profil');
const namaProfil = document.querySelector('#nama-profil');
const jabatanProfil = document.querySelector('#jabatan-profil');
const bioProfil = document.querySelector('#bio-profil');
const emailProfil = document.querySelector('#email-profil');

const tombolDetail = document.querySelector('#tombol-detail');
const detailProfil = document.querySelector('#detail-profil');

const tombolTema = document.querySelector('#tombol-tema');

const formKeterampilan = document.querySelector('#form-keterampilan');
const inputKeterampilan = document.querySelector('#nama-keterampilan');
const errorKeterampilan = document.querySelector('#error-keterampilan');
const statusKeterampilan = document.querySelector('#status-keterampilan');
const daftarKeterampilan = document.querySelector('#daftar-keterampilan');


function validasiKeterampilan(nama) {
  let pesan = '';

  if (!nama || nama.trim() === '') {
    pesan = 'Nama keterampilan wajib diisi.';
  } else if (keterampilan.some((item) => item.toLowerCase() === nama.trim().toLowerCase())) {
    pesan = 'Keterampilan ini sudah ada di daftar.';
  }

  return {
    valid: pesan === '',
    error: pesan,
  };
}


function buatKartuKeterampilan(nama, index) {
  const article = document.createElement('article');
  article.className = 'kartu-kecil';

  const teks = document.createElement('span');
  teks.textContent = nama;

  const tombolHapus = document.createElement('button');
  tombolHapus.type = 'button';
  tombolHapus.textContent = 'Hapus';
  tombolHapus.setAttribute('aria-label', `Hapus keterampilan ${nama}`);
  tombolHapus.addEventListener('click', () => {
    keterampilan.splice(index, 1);
    statusKeterampilan.textContent = `${nama} dihapus dari daftar.`;
    renderKeterampilan();
  });

  article.append(teks, tombolHapus);
  return article;
}

function renderKeterampilan() {
  daftarKeterampilan.textContent = '';

  if (keterampilan.length === 0) {
    const kosong = document.createElement('p');
    kosong.textContent = 'Belum ada keterampilan yang ditambahkan.';
    daftarKeterampilan.append(kosong);
    return;
  }

  keterampilan.forEach((nama, index) => {
    daftarKeterampilan.append(buatKartuKeterampilan(nama, index));
  });
}


function renderProfil(data) {
  fotoProfil.src = data.foto || '';
  fotoProfil.alt = data.nama || 'Foto profil';
  namaProfil.textContent = data.nama || '';
  jabatanProfil.textContent = data.jabatan || '';
  bioProfil.textContent = data.bio || '';
  emailProfil.textContent = data.email || '';

  keterampilan = Array.isArray(data.keterampilan) ? [...data.keterampilan] : [];
  renderKeterampilan();
}


function muatProfil() {
  statusFetch.hidden = false;
  statusFetch.textContent = 'Memuat profil...';
  tombolCobaLagi.hidden = true;
  kartuProfil.hidden = true;

  fetch('profise.json')
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Gagal memuat data (status ${response.status})`);
      }
      return response.json();
    })
    .then((data) => {
      renderProfil(data);
      statusFetch.hidden = true;
      kartuProfil.hidden = false;
    })
    .catch((error) => {
      statusFetch.textContent = `Terjadi kesalahan: ${error.message}`;
      tombolCobaLagi.hidden = false;
    });
}


formKeterampilan.addEventListener('submit', (event) => {
  event.preventDefault();

  const nilai = inputKeterampilan.value;
  const hasil = validasiKeterampilan(nilai);

  inputKeterampilan.setAttribute('aria-invalid', hasil.valid ? 'false' : 'true');
  errorKeterampilan.textContent = hasil.error;

  if (!hasil.valid) {
    statusKeterampilan.textContent = 'Periksa kembali keterampilan yang diisi.';
    return;
  }

  keterampilan.push(nilai.trim());
  formKeterampilan.reset();
  statusKeterampilan.textContent = 'Keterampilan berhasil ditambahkan.';
  renderKeterampilan();
});


tombolDetail.addEventListener('click', () => {
  const terbuka = tombolDetail.getAttribute('aria-expanded') === 'true';
  tombolDetail.setAttribute('aria-expanded', String(!terbuka));
  detailProfil.classList.toggle('terbuka', !terbuka);
});


tombolTema.addEventListener('click', () => {
  document.body.classList.toggle('gelap');
  tombolTema.textContent = document.body.classList.contains('gelap') ? '☀' : '🌙';
});


tombolCobaLagi.addEventListener('click', muatProfil);
muatProfil();