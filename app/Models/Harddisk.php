<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Harddisk extends Model
{
      use HasFactory;

   protected $fillable = [
        'brands_id',
        'health',
        'interface',
        'capacity_gb',
        'serial_number',
        'pdf',
      ];

 public function brand()
{
    return $this->belongsTo(Brands::class, 'brands_id');
}


}
