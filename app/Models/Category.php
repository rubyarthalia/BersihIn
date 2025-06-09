<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $table ='categories';
    protected $keyType = 'string'; 
    public $incrementing = false; 

    public function services():HasMany {
        return $this->hasMany(Service::class, 'category_id');
    }
}
