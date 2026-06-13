<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('details.barang')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('pesanan'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('details.barang')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('detail-pesanan', compact('pesanan'));
    }
}
