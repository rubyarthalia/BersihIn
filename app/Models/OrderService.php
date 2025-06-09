<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $table = 'order_services';

    protected $fillable = [
        'order_id', 'service_id', 'cleaner_id', 'jumlah', 'catatan', 'sub_total', 'status_del'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'cleaner_id');
    }
}
