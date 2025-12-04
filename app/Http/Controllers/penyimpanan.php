<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Item;
use App\Models\DetailPenyimpanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class penyimpanan extends Controller
{

    public function create()
    {
        $item = Item::where('user_id', Auth::id())
                    ->where('is_delete', 0)
                    ->get();
        $lokasi = Lokasi::all();

        return view('TambahMakan', compact('item','lokasi'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kategori_item_id' => 'required|exists:items,id',
        'lokasi_id'        => 'required|exists:lokasis,id',
        'tanggal_simpan'   => 'required|date',
        'tanggal_kadaluarsa' => 'required|date|after_or_equal:tanggal_simpan',
        'kuantitas'        => 'required|integer|min:1',
        'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // <--- Validasi Foto
    ]);

    // Logika Upload Foto
    $pathFoto = null;
    if ($request->hasFile('foto')) {
        $pathFoto = $request->file('foto')->store('penyimpanan-img', 'public');
    }

    DetailPenyimpanan::create([
        'item_id'            => $request->kategori_item_id,
        'lokasi_id'          => $request->lokasi_id,
        'tanggal_simpan'     => $request->tanggal_simpan,
        'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        'kuantitas'          => $request->kuantitas,
        'foto'               => $pathFoto, // <--- Simpan path
        'status'             => 'Layak Makan',
        'user_id'            => Auth::id() ?? null,
    ]);

    return redirect()->route('penyimpanan.index')->with('success', 'Data penyimpanan berhasil ditambahkan!');
}

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


    public function edit($id)
    {

        $dataEdit = DetailPenyimpanan::findOrFail($id);
        $item =  Item::where('user_id', Auth::id())
                    ->where('is_delete', 0)
                    ->get();
        $lokasi = Lokasi::all();

        return view('TambahMakan', compact('dataEdit', 'item', 'lokasi'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'kategori_item_id' => 'required|exists:items,id',
        'lokasi_id'        => 'required|exists:lokasis,id',
        'tanggal_simpan'   => 'required|date',
        'tanggal_kadaluarsa' => 'required|date|after_or_equal:tanggal_simpan',
        'kuantitas'        => 'required|integer|min:1',
        'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // <--- Validasi Foto
    ]);

    $penyimpanan = DetailPenyimpanan::findOrFail($id);
    
    // Logika Update Foto
    $pathFoto = $penyimpanan->foto; // Default pakai foto lama
    
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($penyimpanan->foto && Storage::disk('public')->exists($penyimpanan->foto)) {
            Storage::disk('public')->delete($penyimpanan->foto);
        }
        // Upload foto baru
        $pathFoto = $request->file('foto')->store('penyimpanan-img', 'public');
    }

    $penyimpanan->update([
        'item_id'            => $request->kategori_item_id,
        'lokasi_id'          => $request->lokasi_id,
        'tanggal_simpan'     => $request->tanggal_simpan,
        'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        'kuantitas'          => $request->kuantitas,
        'foto'               => $pathFoto, // <--- Update path
    ]);

    return redirect()->route('penyimpanan.index')->with('success', 'Data berhasil diperbarui!');
}

    public function destroy($id)
    {

        $penyimpanan = DetailPenyimpanan::findOrFail($id);

        $penyimpanan->update([
            'status' => 'Selesai' 
        ]);


        return redirect()->route('penyimpanan.index')->with('success', 'Item berhasil dihapus (Status diubah).');
    }

    public function history()
    {
        $histories = DetailPenyimpanan::with(['item', 'lokasi'])
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'Layak Makan') 
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('RiwayatPenyimpanan', compact('histories'));
    }


}