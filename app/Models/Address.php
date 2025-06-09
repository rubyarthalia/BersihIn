<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    public $timestamps = true; 

    protected $fillable = ['customer_id', 'alamat','status', 'subdistrict_id', 'status_del'];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'ID'); // FK customer ID
    }
    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id', 'id'); 
    }
}
