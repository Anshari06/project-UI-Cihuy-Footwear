<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $artikel = Artikel::orderBy('published_at', 'desc')->get();
        return view('artikel.index', compact('artikel'));
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $related = Artikel::where('id', '!=', $artikel->id)
            ->where('category', $artikel->category)
            ->take(3)
            ->get();

        if ($related->isEmpty()) {
            $related = Artikel::where('id', '!=', $artikel->id)->take(3)->get();
        }

        return view('artikel.show', compact('artikel', 'related'));
    }
}
