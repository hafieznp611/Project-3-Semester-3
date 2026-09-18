'use strict';
 
const bagianMateri = {
  Kelulusan: document.querySelector('#Kelulusan'),
  Karir: document.querySelector('#Karir'),
  Fasilitas: document.querySelector('#Fasilitas'),
};
 
const daftarFaq = document.querySelector('#daftar-faq');
 
function buatIsiSection(item) {
  const fragmen = document.createDocumentFragment();
 
  const judul = document.createElement('h2');
  judul.textContent = item.title;
  fragmen.append(judul);
 
  item.items.forEach((teks) => {
    const p = document.createElement('p');
    p.textContent = teks;
    fragmen.append(p);
  });
 
  return fragmen;
}
 
async function ambilJson(path) {
  const response = await fetch(path);
 
  if (!response.ok) {
    throw new Error(`Gagal memuat ${path} (status ${response.status})`);
  }
 
  return response.json();
}
 
function renderMateri(data) {
  data.forEach((item) => {
    const target = bagianMateri[item.target];
 
    if (!target) {
      console.warn(`Elemen untuk target "${item.target}" tidak ditemukan.`);
      return;
    }
 
    target.replaceChildren(buatIsiSection(item));
  });
}
 
function toggleFaq(tombol, panel) {
  const sedangTerbuka = tombol.getAttribute('aria-expanded') === 'true';
  const akanTerbuka = !sedangTerbuka;
 
  tombol.setAttribute('aria-expanded', String(akanTerbuka));
  panel.classList.toggle('terbuka', akanTerbuka);
  panel.setAttribute('aria-hidden', String(!akanTerbuka));
}
 
function buatItemFaq(item, index) {
  const idTombol = `faq-tombol-${index}`;
  const idPanel = `faq-panel-${index}`;
 
  const wadah = document.createElement('div');
  wadah.className = 'faq-item';
 
  const tombol = document.createElement('button');
  tombol.type = 'button';
  tombol.className = 'faq-tombol';
  tombol.id = idTombol;
  tombol.setAttribute('aria-expanded', 'false');
  tombol.setAttribute('aria-controls', idPanel);
 
  const teksTombol = document.createElement('span');
  teksTombol.textContent = item.pertanyaan;
 
  const ikon = document.createElement('i');
  ikon.className = 'fa-solid fa-chevron-down faq-ikon';
  ikon.setAttribute('aria-hidden', 'true');
 
  tombol.append(teksTombol, ikon);
 
  const panel = document.createElement('div');
  panel.className = 'faq-panel';
  panel.id = idPanel;
  panel.setAttribute('role', 'region');
  panel.setAttribute('aria-labelledby', idTombol);
  panel.setAttribute('aria-hidden', 'true');
 
  const jawaban = document.createElement('p');
  jawaban.textContent = item.jawaban;
  panel.append(jawaban);
 
  tombol.addEventListener('click', () => toggleFaq(tombol, panel));
 
  wadah.append(tombol, panel);
  return wadah;
}
 
function renderFaq(data) {
  if (!daftarFaq) return;
 
  const fragmen = document.createDocumentFragment();
  data.forEach((item, index) => fragmen.append(buatItemFaq(item, index)));
  daftarFaq.replaceChildren(fragmen);
}
 
async function muatMateri() {
  try {
    const data = await ambilJson('materi.json');
    renderMateri(data);
  } catch (error) {
    console.error('Gagal memuat materi.json, memakai konten statis di HTML:', error);
  }
}
 
async function muatFaq() {
  try {
    const data = await ambilJson('faq.json');
    renderFaq(data);
  } catch (error) {
    console.error('Gagal memuat faq.json:', error);
  }
}
 
function validasiNama(nilai) {
  return nilai.trim().length >= 3;
}

function validasiEmail(nilai) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(nilai.trim());
}

function validasiPesan(nilai) {
  return nilai.trim().length >= 10;
}

function tampilkanError(idInput, idError, adaError, pesan) {
  const input = document.querySelector(`#${idInput}`);
  const error = document.querySelector(`#${idError}`);
  if (!input || !error) return;

  input.closest('.grup-form')?.classList.toggle('error', adaError);
  error.hidden = !adaError;
  if (adaError) error.textContent = pesan;
}

function tampilkanStatus(elemen, tipe, pesan) {
  if (!elemen) return;
  elemen.hidden = false;
  elemen.textContent = pesan;
  elemen.classList.remove('sukses', 'gagal');
  elemen.classList.add(tipe);
}

function pasangValidasiKontak() {
  const form = document.querySelector('#form-kontak');
  if (!form) return;

  const inputNama = document.querySelector('#input-nama');
  const inputEmail = document.querySelector('#input-email');
  const inputPesan = document.querySelector('#input-pesan');
  const statusEl = document.querySelector('#status-kontak');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const namaValid = validasiNama(inputNama.value);
    const emailValid = validasiEmail(inputEmail.value);
    const pesanValid = validasiPesan(inputPesan.value);

    tampilkanError('input-nama', 'error-nama', !namaValid, 'Nama minimal 3 karakter.');
    tampilkanError('input-email', 'error-email', !emailValid, 'Masukkan alamat email yang valid.');
    tampilkanError('input-pesan', 'error-pesan', !pesanValid, 'Pesan minimal 10 karakter.');

    if (!namaValid || !emailValid || !pesanValid) {
      tampilkanStatus(statusEl, 'gagal', 'Mohon periksa kembali data yang diisi.');
      return;
    }

    tampilkanStatus(statusEl, 'sukses', 'Pesan berhasil dikirim. Terima kasih!');
    form.reset();
  });
}

muatMateri();
muatFaq();
pasangValidasiKontak();