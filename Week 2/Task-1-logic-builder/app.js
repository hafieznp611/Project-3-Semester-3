'use strict';

function validasiNilai(nilai) {
  return Number.isFinite(nilai) && nilai >= 0 && nilai <= 100;
}

function tentukanKategori(nilai) {
  if (!validasiNilai(nilai)) {
    return 'Data tidak valid';
  }

  if (nilai >= 85) {
    return 'A';
  } else if (nilai >= 70) {
    return 'B';
  } else if (nilai >= 60) {
    return 'C';
  } else {
    return 'D';
  }
}

function tentukanStatus(nilai) {
  if (!validasiNilai(nilai)) {
    return 'Data tidak valid';
  }

  return nilai >= 60 ? 'Lulus' : 'Tidak lulus';
}

function buatRingkasan(nama, nilai) {
  return {
    nama,
    nilai,
    kategori: tentukanKategori(nilai),
    status: tentukanStatus(nilai),
  };
}

const kasusUji = [
  { nama: 'Alya', nilai: 0 },
  { nama: 'Bima', nilai: 59 },
  { nama: 'Citra', nilai: 60 },
  { nama: 'Danu', nilai: 69 },
  { nama: 'Eka', nilai: 70 },
  { nama: 'Gilang', nilai:84 },
  { nama: 'Fani', nilai: 85 },
  { nama: 'Gilang', nilai: 101 },
  { nama: 'Gilang', nilai: '80' }
];

const hasilUji = kasusUji.map(({ nama, nilai }) =>
  buatRingkasan(nama, nilai)
);

console.table(hasilUji);