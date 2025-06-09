<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = 'customers';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'email', 'password', 'nama', 'nomor_telepon' ];
    protected $hidden = ['password'];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id', 'id');
    }


}

