<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPesanan = Pesanan::count();
        $totalBarang = Barang::count();
        $pesananPending = Pesanan::where('status', 'pending')->count();
        $totalRevenue = Pesanan::where('status', '!=', 'cancelled')->sum('total');

        return view('admin.dashboard', compact(
            'totalPesanan', 'totalBarang', 'pesananPending', 'totalRevenue'
        ));
    }

    // ===================== BARANG =====================
    public function barangIndex()
    {
        $barang = Barang::all();
        return view('admin.barang.index', compact('barang'));
    }

    public function barangCreate()
    {
        return view('admin.barang.create');
    }

    public function barangStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'brand' => 'required|string|max:100',
            'badge' => 'nullable|string|max:50',
            'type' => 'required|string|max:50',
            'gender' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        Barang::create($validated);

        return redirect()->route('admin.barang.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function barangEdit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function barangUpdate(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'brand' => 'required|string|max:100',
            'badge' => 'nullable|string|max:50',
            'type' => 'required|string|max:50',
            'gender' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $barang->update($validated);

        return redirect()->route('admin.barang.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function barangDestroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('admin.barang.index')->with('success', 'Produk berhasil dihapus.');
    }

    // ===================== ARTIKEL =====================
    public function artikelIndex()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->get();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    public function artikelStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:20',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = now();

        Artikel::create($validated);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function artikelEdit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function artikelUpdate(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:20',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function artikelDestroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dipindahkan ke arsip.');
    }

    // ===================== ARSIP ARTIKEL =====================
    public function arsipIndex()
    {
        $arsip = Artikel::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.artikel.arsip', compact('arsip'));
    }

    public function arsipRestore($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->restore();
        return redirect()->route('admin.artikel.arsip')->with('success', 'Artikel berhasil dikembalikan.');
    }

    public function arsipDestroy($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->forceDelete();
        return redirect()->route('admin.artikel.arsip')->with('success', 'Artikel berhasil dihapus permanen.');
    }

    // ===================== PESANAN =====================
    public function pesananIndex()
    {
        $pesanan = Pesanan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function pesananShow($id)
    {
        $pesanan = Pesanan::with(['user', 'details.barang'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function pesananUpdateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,completed,cancelled',
        ]);

        $pesanan->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diupdate.');
    }

    // ===================== PENGGUNA =====================
    public function penggunaIndex()
    {
        $pengguna = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function penggunaCreate()
    {
        return view('admin.pengguna.create');
    }

    public function penggunaStore(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,pelanggan',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function penggunaEdit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function penggunaUpdate(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $rules = [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,pelanggan',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pengguna->update($validated);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diupdate.');
    }

    public function penggunaDestroy($id)
    {
        $currentUser = auth()->user();
        if ($currentUser && $currentUser->id == $id) {
            return redirect()->route('admin.pengguna.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        User::destroy($id);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
