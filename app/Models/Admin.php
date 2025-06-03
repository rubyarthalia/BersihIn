<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    public $timestamps = false;

    protected $fillable = ['email', 'password', 'nama', 'nomor_telepon'];
    protected $hidden = ['password'];
}


