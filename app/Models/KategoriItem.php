<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriItem extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    public function items()
    {
        return $this->hasMany(Item::class, 'kategori_item_id');
    }
}
