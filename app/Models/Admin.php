<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'id';    
    public $incrementing = false;      
    protected $keyType = 'string';     

    protected $fillable = [
        'id', 'nama', 'nomor_telepon', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false; 
}


