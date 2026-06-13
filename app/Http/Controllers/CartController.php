<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $items = $cart;
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('keranjang', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|string',
            'size' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        $key = $request->id . '-' . $request->size;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty;
        } else {
            $cart[$key] = [
                'id' => $request->id,
                'name' => $request->name,
                'brand' => $request->brand,
                'price' => $request->price,
                'image' => $request->image,
                'size' => $request->size,
                'qty' => $request->qty,
            ];
        }

        session(['cart' => $cart]);

        return response()->json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang!']);
    }

    public function update(Request $request)
    {
        $key = $request->key;
        $qty = $request->qty;
        $cart = session('cart', []);

        if (isset($cart[$key])) {
            if ($qty <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $qty;
            }
            session(['cart' => $cart]);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $key = $request->key;
        $cart = session('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);
        }

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang')->with('error', 'Keranjang kosong!');
        }

        $items = $cart;
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('checkout', compact('items', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong!'], 400);
        }

        $validated = $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'no_telp' => 'required|string|max:20',
            'kurir' => 'nullable|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        // Generate no pesanan
        $noPesanan = 'ORD-' . date('Ymd') . '-' . str_pad(Pesanan::count() + 1, 4, '0', STR_PAD_LEFT);

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'nama_depan' => $validated['nama_depan'],
            'nama_belakang' => $validated['nama_belakang'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'kecamatan' => $validated['kecamatan'],
            'kelurahan' => $validated['kelurahan'],
            'kode_pos' => $validated['kode_pos'],
            'no_telp' => $validated['no_telp'],
            'kurir' => $validated['kurir'] ?? null,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'status' => 'pending',
            'total' => $total,
        ]);

        foreach ($cart as $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'barang_id' => $item['id'],
                'size' => $item['size'],
                'jumlah' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat!',
            'no_pesanan' => $noPesanan,
        ]);
    }
}
