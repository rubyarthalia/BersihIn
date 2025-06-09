<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeService extends Model
{
    protected $table = 'like_services';

    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customer_id',
        'service_id',
        'status_del',
    ];
    protected function setKeysForSaveQuery($query)
    {
        $query->where('customer_id', '=', $this->getAttribute('customer_id'))
              ->where('service_id', '=', $this->getAttribute('service_id'));

        return $query;
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
