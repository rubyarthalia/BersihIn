<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    //
    protected $table = 'cleaners';
    public $timestamps = true;

    protected $fillable = ['nama', 'alamat', 'telepon', 'status_aktif', /* tambahkan field lainnya sesuai tabel */];

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'cleaner_id');
    }
}
