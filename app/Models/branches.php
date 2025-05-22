<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branches extends Model
{
      protected $fillable = [
        'name',
        'br_location',
        'country',
        'city',
        'phone',
    ];
      public function brand()
    {
        return $this->belongsTo(Brands::class, 'brands_id', 'id');
    }
}
