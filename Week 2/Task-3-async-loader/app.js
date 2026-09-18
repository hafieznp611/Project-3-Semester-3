'use strict';

const status = document.querySelector('#status');
const daftar = document.querySelector('#daftar-materi');
const tombolMuat = document.querySelector('#muat');
const tombolCobaLagi = document.querySelector('#coba-lagi');

function aturState(state, pesan) {
  status.dataset.state = state;
  status.textContent = pesan;
  tombolCobaLagi.hidden = state !== 'error';
}

async function ambilMateri() {
  const response = await fetch('materi.json');

  if (!response.ok) {
    throw new Error(`Gagal memuat data (status ${response.status})`);
  }

  return response.json();
}

function renderMateri(data) {
  daftar.replaceChildren();

  data.forEach((item) => {
    const kartu = document.createElement('article');
    kartu.className = 'kartu';

    const judul = document.createElement('h2');
    judul.textContent = item.judul;

    const durasi = document.createElement('p');
    durasi.textContent = `Durasi: ${item.durasi} menit`;

    kartu.append(judul, durasi);
    daftar.append(kartu);
  });
}

async function muatData() {
  aturState('loading', 'Memuat data...');
  tombolMuat.disabled = true;
  daftar.replaceChildren();

  try {
    const data = await ambilMateri();

    if (data.length === 0) {
      aturState('empty', 'Belum ada materi yang tersedia.');
    } else {
      renderMateri(data);
      aturState('success', `Berhasil memuat ${data.length} materi.`);
    }
  } catch (error) {
    console.error(error);
    aturState('error', `Terjadi kesalahan: ${error.message}`);
  } finally {
    tombolMuat.disabled = false;
  }
}

tombolMuat.addEventListener('click', muatData);
tombolCobaLagi.addEventListener('click', muatData);