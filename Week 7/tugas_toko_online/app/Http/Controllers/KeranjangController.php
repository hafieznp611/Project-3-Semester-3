<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class KeranjangController extends Controller
{


    public function tambah($id){
        $product = Product::findOrFail($id);

        if($product->stok <= 0){
            return back()->with('error', $product->nama_barang . ' Tidak Tersedia');
        }

        $keranjang = session('keranjang',[]);
        $jumlahBaru = ($keranjang[$id] ?? 0) + 1;

        if($jumlahBaru > $product->stok){
            return back()->with('error','Stock ' . $product->nama_barang . 'Stock Tidak Mencukupi' );
        }

        $keranjang[$id] = $jumlahBaru;
        session(['keranjang' => $keranjang]);
    

        return back()->with('succes', $product->nama_barang . 'Produk Dimasukkan Kedalam Keranjang');
    }

    public function tampilkan () {
        $keranjang = session('keranjang', []);

        $products = Product::whereIn('id_barang', array_keys($keranjang))
            ->get()
            ->keyBy('id_barang');

        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah){
            if (!isset($products[$id])){
                unset($keranjang[$id]);
                continue;
            }

            $p = $products[$id];
            $subtotal =$p->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id' => $p->id_barang,
                'name' => $p->nama_barang,
                'harga' => $p->harga,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];
        }

        session(['keranjang' => $keranjang]);

        return view('keranjang.index',compact('items','total'));
    }

    public function ubah(Request $request, $id){
        $keranjang = session('keranjang', []);

        // Barang tidak ada di keranjang: tidak ada yang diubah
        if (!isset($keranjang[$id])) {
            return back();
        }

        if ($request->input('aksi') === 'plus') {
            $product = Product::findOrFail($id);

            // Jumlah tidak boleh melebihi stok
            if ($keranjang[$id] + 1 > $product->stok) {
                return back()->with('error', 'Stok ' . $product->nama_barang . ' tidak mencukupi.');
            }
            $keranjang[$id]++;
        } else {
            $keranjang[$id]--;

            // Jumlah 0: item dihapus otomatis
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
        }

        session(['keranjang' => $keranjang]);

        return back();
    }
}
