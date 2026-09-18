'use strict';

const form = document.querySelector('#form-hitung');
const hargaInput = document.querySelector('#harga');
const jumlahInput = document.querySelector('#jumlah');
const hasil = document.querySelector('#hasil');
const pesan = document.querySelector('#pesan');

function hitungTotal(harga, jumlah) {
  return harga * jumlah;
}

function tampilkanPesan(teks) {
  pesan.textContent = teks;
}

function hitungDiskon(total) {
  let Diskon;

  if (total >= 300000) {
    Diskon = 0.20;
  } else if (total >= 200000) {
    Diskon = 0.10;
  } else if (total >= 100000) {
    Diskon = 0.25;
  } else {
    Diskon = 0;
  }

  const hasil = total - (total * Diskon);
  return hasil;
}

function prosesForm(event) {
  event.preventDefault();

  const harga = Number(hargaInput.value);
  const jumlah = Number(jumlahInput.value);

  if (harga <= 0 || jumlah <= 0) {
    tampilkanPesan('Harga dan jumlah harus positif.');
    return;
  }

  let total = hitungTotal(harga, jumlah);

  total = hitungDiskon(total);

  const aksi = event.submitter ? event.submitter.value : null;

  if (aksi === 'A') {
    total = total - (total * 0.05); 
    tampilkanPesan('Perhitungan berhasil (Anggota, tambahan diskon 5%).');
  } else {
    tampilkanPesan('Perhitungan berhasil.');
  }

  hasil.textContent = total.toLocaleString('id-ID');
}

form.addEventListener('submit', prosesForm)