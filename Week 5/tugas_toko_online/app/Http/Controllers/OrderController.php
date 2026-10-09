<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'alamat' => ['required', 'string'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.tampilkan')->with('error', 'Keranjang masih kosong.');
        }

        try {
            $idOrder = DB::transaction(function () use ($keranjang, $request) {

       
                $products = Product::whereIn('id_barang', array_keys($keranjang))
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id_barang');

                $total = 0;
                foreach ($keranjang as $id => $jumlah) {
                    if (!isset($products[$id])) {
                        throw new \RuntimeException('Ada barang di keranjang yang sudah tidak tersedia.');
                    }
                    if ($jumlah > $products[$id]->stok) {
                        throw new \RuntimeException('Stok ' . $products[$id]->nama_barang . ' tidak mencukupi.');
                    }
                    $total += $products[$id]->harga * $jumlah;   
                }

                $idOrder = 'ORD' . now()->format('ymdHis');      

                Order::create([
                    'id_order'          => $idOrder,
                    'id_user'           => Auth::user()->id_user,
                    'tanggal_order'     => now(),
                    'total_harga'       => $total,
                    'alamat_pengiriman' => $request->alamat,
                ]);

                foreach ($keranjang as $id => $jumlah) {
                    OrderDetail::create([
                        'id_order'     => $idOrder,
                        'id_barang'    => $id,
                        'harga_satuan' => $products[$id]->harga,  
                        'jumlah_beli'  => $jumlah,
                    ]);

                    $products[$id]->decrement('stok', $jumlah);
                }

                return $idOrder;
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('keranjang.tampilkan')->with('error', $e->getMessage());
        }

        session()->forget('keranjang');

        return redirect()
            ->route('pesanan.show', $idOrder)
            ->with('success', 'Checkout berhasil. Nomor pesanan: ' . $idOrder);
    }

    public function index()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)
            ->orderByDesc('tanggal_order')
            ->get();

        return view('pesanan.index', compact('orders'));
    }

    // Detail satu pesanan
    public function show($id)
    {
        // Filter id_user: pesanan milik orang lain tidak bisa dibuka lewat URL
        $order = Order::where('id_order', $id)
            ->where('id_user', Auth::user()->id_user)
            ->with('details.product')
            ->firstOrFail();

        return view('pesanan.show', compact('order'));
    }
}