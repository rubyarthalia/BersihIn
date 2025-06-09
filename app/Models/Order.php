<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'customer_id', 'tanggal_jadwal', 'ongkos_kirim', 'harga_total',
        'metode_pembayaran', 'status_pembayaran', 'status_layanan', 'status_del',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'order_id', 'id');
    }
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'order_id', 'id');
    }


}
