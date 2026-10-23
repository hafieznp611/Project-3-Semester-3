<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['BRG001', 'Buku Tulis',      'Buku tulis 38 lembar',          5000,  50, 'buku-tulis.jpg'],
            ['BRG002', 'Pulpen',          'Pulpen tinta hitam 0.5 mm',     3000, 100, 'pulpen.jpg'],
            ['BRG003', 'Penggaris',       'Penggaris plastik 30 cm',       4000,  30, 'penggaris.jpg'],
            ['BRG004', 'Pensil 2B',       'Pensil 2B untuk ujian',         2500,  80, 'pensil.jpg'],
            ['BRG005', 'Penghapus',       'Penghapus karet putih',         1500,  60, 'penghapus.jpg'],
            ['BRG006', 'Spidol',          'Spidol papan tulis hitam',      7000,  40, 'spidol.jpg'],
            ['BRG007', 'Stabilo',         'Stabilo warna kuning',          6000,  25, 'stabilo.jpg'],
            ['BRG008', 'Tipe-X',          'Correction tape 5 mm',          8000,   0, 'tipex.jpg'],
            ['BRG009', 'Map Plastik',     'Map plastik ukuran folio',      3500,  70, 'map.jpg'],
            ['BRG010', 'Buku Gambar A4',  'Buku gambar 20 lembar',        10000,  20, 'buku-gambar.jpg'],
        ];

        foreach ($data as [$id, $nama, $deskripsi, $harga, $stok, $gambar]) {
            Product::create([
                'id_barang'   => $id,
                'nama_barang' => $nama,
                'deskripsi'   => $deskripsi,
                'harga'       => $harga,
                'stok'        => $stok,
                'gambar'      => $gambar,
            ]);
        }
    }
}