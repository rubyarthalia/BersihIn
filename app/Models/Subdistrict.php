<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    //
    protected $table = 'subdistricts';
    public function addresses() {
        return $this->hasMany(Address::class,'subdistrict_id');
    }


}
