<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\KategoriItem;
use Illuminate\Support\Facades\Auth; // <--- WAJIB DITAMBAHKAN

class ItemController extends Controller
{
    public function index()
    {
        // UBAH INI: Tambahkan where('user_id', Auth::id())
        // Agar user hanya melihat item miliknya sendiri
        $items = Item::where('user_id', Auth::id())
                     ->where('is_delete', 0)
                     ->get();

        return view('LihatSemuaItem', compact('items'));
    }

    public function riwayat_index()
    {
        // UBAH INI JUGA: Filter berdasarkan user login
        $items = Item::where('user_id', Auth::id())
                     ->where('is_delete', 1)
                     ->get();

        return view('RiwayatItem', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'kategori_item_id' => 'required|exists:kategori_items,id',
        ]);

        Item::create([
            'nama_item' => $request->nama_item,
            'satuan' => $request->satuan,
            'kategori_item_id' => $request->kategori_item_id,
            'user_id' => Auth::id(), // <--- TAMBAHKAN INI (Simpan ID User yang login)
        ]);

        return redirect()->route('item.tambah')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        // UBAH findOrFail biasa MENJADI filter user dulu (Keamanan)
        // Agar user A tidak bisa edit item milik User B lewat URL
        $itemEdit = Item::where('user_id', Auth::id())
                    ->where('is_delete', 0)
                    ->get();

        $kategori = KategoriItem::all(); 

        return view('TambahItem', compact('itemEdit', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'kategori_item_id' => 'required|exists:kategori_items,id',
        ]);

        // Gunakan filter user_id untuk keamanan
        $item = Item::where('user_id', Auth::id())->findOrFail($id);

        $item->update([
            'nama_item' => $request->nama_item,
            'satuan' => $request->satuan,
            'kategori_item_id' => $request->kategori_item_id,
            // user_id tidak perlu di-update karena pemiliknya tetap sama
        ]);

        return redirect()->route('item.index')->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Gunakan filter user_id
        $item = Item::where('user_id', Auth::id())->findOrFail($id);

        $item->update([
            'is_delete' => 1
        ]);

        return redirect()->route('item.index')->with('success', 'Item berhasil dihapus.');
    }
    
    public function Restore($id)
    {
        // Gunakan filter user_id
        $item = Item::where('user_id', Auth::id())->findOrFail($id);

        $item->update([
            'is_delete' => 0
        ]);

        return redirect()->route('item.riwayat_index')->with('success', 'Item berhasil di restore.');
    }
}