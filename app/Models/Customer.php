<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    public $timestamps = false;

    protected $fillable = ['email', 'password', 'nama', 'nomor_telepon'];
    protected $hidden = ['password'];
}

