<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branches extends Model
{
      protected $fillable = [
        'compony_id',
        'name',
        'br_location',
        'country',
        'city',
        'phone',
    ];
      public function compony()
    {
        return $this->belongsTo(company::class, 'compony_id', 'id');
    }
}
