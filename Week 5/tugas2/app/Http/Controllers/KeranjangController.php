<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    private const KUNCI = 'keranjang'; 

    private function ambil(): array
    {
        $k = session(self::KUNCI, []);
        return is_array($k) ? $k : [];
    }

    private function simpan(array $k): void
    {
        session([self::KUNCI => $k]);
    }

  
    public function index()
    {
        $barang = Barang::orderBy('id')->get();
        $jumlahItem = array_sum($this->ambil());
        return view('index', compact('barang', 'jumlahItem'));
    }

    public function tambah($id)
    {
        $b = Barang::findOrFail($id);
        $k = $this->ambil();
        $jml = ($k[$b->id] ?? 0) + 1;

        if ($jml > $b->stok) {
            return back()->with('error', "Stok {$b->nama} tidak mencukupi.");
        }
        $k[$b->id] = $jml;
        $this->simpan($k);
        return back()->with('sukses', "{$b->nama} dimasukkan ke keranjang.");
    }

    public function keranjang()
    {
        $k = $this->ambil();
        $barang = Barang::whereIn('id', array_keys($k))->get()->keyBy('id');

        $items = [];
        $total = 0;
        foreach ($k as $id => $jml) {
            if (!isset($barang[$id])) {      
                unset($k[$id]);
                continue;
            }
            $p = $barang[$id];
            $sub = $p->harga * $jml;
            $total += $sub;
            $items[] = ['id' => $p->id, 'nama' => $p->nama, 'harga' => $p->harga,
                        'jumlah' => $jml, 'subtotal' => $sub];
        }
        $this->simpan($k);
        $jumlahItem = array_sum($k);
        return view('keranjang', compact('items', 'total', 'jumlahItem'));
    }


    public function ubah(Request $r, $id)
    {
        $k = $this->ambil();
        if (!isset($k[$id])) {
            return back();
        }
        $b = Barang::find($id);
        if ($r->input('aksi') === 'plus') {
            if ($b && $k[$id] + 1 > $b->stok) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
            $k[$id]++;
        } else {
            $k[$id]--;
            if ($k[$id] <= 0) {     
                unset($k[$id]);
            }
        }
        $this->simpan($k);
        return back();
    }

    public function hapus($id)
    {
        $k = $this->ambil();
        unset($k[$id]);
        $this->simpan($k);
        return back()->with('sukses', 'Item dihapus.');
    }

    public function kosongkan()
    {
        session()->forget(self::KUNCI);
        return back()->with('sukses', 'Keranjang dikosongkan.');
    }
}