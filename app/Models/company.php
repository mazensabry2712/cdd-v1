<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
       protected $fillable = [
        'name',
        'web',
        'email',
        'phone',
    ];
      public function branch()
    {
        return $this->hasMany(branches::class, 'compony_id', 'id');
    }
}
