<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Artikel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('collection', compact('barang'));
    }

    public function landing()
    {
        $recommended = Barang::take(4)->get();
        $artikel = Artikel::orderBy('published_at', 'desc')->take(4)->get();
        return view('landing', compact('recommended', 'artikel'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $related = Barang::where('id', '!=', $id)->inRandomOrder()->take(5)->get();
        return view('DetailProduk', compact('barang', 'related'));
    }

}
