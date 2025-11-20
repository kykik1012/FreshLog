<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_item','satuan','kategori_item_id','user_id','is_delete'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriItem::class, 'kategori_item_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function detailPenyimpanans()
    {
        return $this->hasMany(DetailPenyimpanan::class, 'item_id');
    }
}
