<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    //
    protected $table ='services';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
    'nama',
    'harga',
    'satuan',
    'kategori_id',
    'kalimat_promosi',
    'deskripsi',
    'gambar'
];

    public function categories():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }
}
