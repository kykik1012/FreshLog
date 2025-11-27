<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Item;
use App\Models\DetailPenyimpanan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class penyimpanan extends Controller
{
    // 1. Method CREATE (Form Tambah)
    public function create()
    {
        $item = Item::where('user_id', Auth::id())
                    ->where('is_delete', 0)
                    ->get();
        $lokasi = Lokasi::all();

        // Tidak mengirim $dataEdit karena ini mode tambah
        return view('TambahMakan', compact('item','lokasi'));
    }

    // 2. Method STORE (Simpan Data Baru)
    public function store(Request $request)
    {
        $request->validate([
            'kategori_item_id' => 'required|exists:items,id',
            'lokasi_id'        => 'required|exists:lokasis,id',
            'tanggal_simpan'   => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after_or_equal:tanggal_simpan',
            'kuantitas'        => 'required|integer|min:1',
        ]);

        DetailPenyimpanan::create([
            'item_id'            => $request->kategori_item_id,
            'lokasi_id'          => $request->lokasi_id,
            'tanggal_simpan'     => $request->tanggal_simpan,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'kuantitas'          => $request->kuantitas,
            'status'             => 'Layak Makan',
            'user_id'            => Auth::id() ?? null,
        ]);

        // Redirect ke halaman List (Index) agar user langsung melihat hasilnya
        return redirect()->route('penyimpanan.index')->with('success', 'Data penyimpanan berhasil ditambahkan!');
    }

    // 3. Method INDEX (Lihat Data)
    public function index()
    {
        $penyimpanans = DetailPenyimpanan::with(['item', 'lokasi'])
            ->where('user_id', auth()->id())
            ->where('status', 'Layak Makan')
            ->orderBy('tanggal_kadaluarsa', 'asc')
            ->get();

        $penyimpanans->transform(function($data) {
            $kadaluarsa = Carbon::parse($data->tanggal_kadaluarsa);
            $hari_ini   = Carbon::now()->startOfDay();
            
            $sisa = $hari_ini->diffInDays($kadaluarsa, false); 
            $sisa = (int)$sisa;

            if($sisa <= 1) {
                $badgeColor = 'bg-red-500 text-white';
            } elseif($sisa <= 3) {
                $badgeColor = 'bg-yellow-500 text-white';
            } else {
                $badgeColor = 'bg-green-500 text-white';
            }

            $data->sisa_hari_angka = $sisa; 
            $data->badge_color = $badgeColor;

            return $data;
        });

        return view('LihatPenyimpanan', compact('penyimpanans'));
    }

    // 4. Method EDIT (Form Edit) - PERHATIKAN PERUBAHAN DISINI
    public function edit($id)
    {
        // Kita ubah nama variabel jadi $dataEdit agar View 'TambahMakan' tahu ini mode Edit
        $dataEdit = DetailPenyimpanan::findOrFail($id);
        $item =  Item::where('user_id', Auth::id())
                    ->where('is_delete', 0)
                    ->get();
        $lokasi = Lokasi::all();

        return view('TambahMakan', compact('dataEdit', 'item', 'lokasi'));
    }

    // 5. Method UPDATE (Simpan Perubahan) - INI BARU
    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'kategori_item_id' => 'required|exists:items,id',
            'lokasi_id'        => 'required|exists:lokasis,id',
            'tanggal_simpan'   => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after_or_equal:tanggal_simpan',
            'kuantitas'        => 'required|integer|min:1',
        ]);

        // Cari data lama
        $penyimpanan = DetailPenyimpanan::findOrFail($id);

        // Update data
        $penyimpanan->update([
            'item_id'            => $request->kategori_item_id,
            'lokasi_id'          => $request->lokasi_id,
            'tanggal_simpan'     => $request->tanggal_simpan,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'kuantitas'          => $request->kuantitas,
            // Status dan User ID biarkan tetap (tidak diupdate)
        ]);

        return redirect()->route('penyimpanan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
{
    // 1. Cari data berdasarkan ID
    $penyimpanan = DetailPenyimpanan::findOrFail($id);

    // 2. JANGAN gunakan delete(), tapi gunakan update()
    // $penyimpanan->delete(); <--- Hapus baris ini

    // Ubah statusnya saja
    $penyimpanan->update([
        'status' => 'Dihapus' 
    ]);

    // 3. Redirect kembali
    return redirect()->route('penyimpanan.index')->with('success', 'Item berhasil dihapus (Status diubah).');
}


}