<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\KategoriItem;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::where('is_delete', 0)->get();

        return view('LihatSemuaItem', compact('items'));

    }

    public function riwayat_index()
    {
        $items = Item::where('is_delete', 1)->get();

        return view('RiwayatItem', compact('items'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'kategori_item_id' => 'required|exists:kategori_items,id', // Pastikan ID kategori ada di tabel kategori
        ]);

        Item::create([
            'nama_item' => $request->nama_item,
            'satuan' => $request->satuan,
            'kategori_item_id' => $request->kategori_item_id,
        ]);

        return redirect()->route('item.tambah')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $itemEdit = Item::findOrFail($id);

        $kategori = KategoriItem::all(); 

        return view('TambahItem', compact('itemEdit', 'kategori'));
    }

    // 2. Method UPDATE (Menyimpan Perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'kategori_item_id' => 'required|exists:kategori_items,id',
        ]);

        $item = Item::findOrFail($id);

        $item->update([
            'nama_item' => $request->nama_item,
            'satuan' => $request->satuan,
            'kategori_item_id' => $request->kategori_item_id,
        ]);

        return redirect()->route('item.index')->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->update([
            'is_delete' => 1
        ]);

        return redirect()->route('item.index')->with('success', 'Item berhasil direstore.');
    }
    
    public function Restore($id)
    {
        $item = Item::findOrFail($id);

        $item->update([
            'is_delete' => 0
        ]);

        return redirect()->route('item.riwayat_index')->with('success', 'Item berhasil di restore.');
    }
}
