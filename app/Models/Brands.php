<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['serial_number', 'devicebrand_id', 'model'];

  
    public function deviceBrand()
    {
        return $this->belongsTo(DeviceBrands::class, 'devicebrand_id');
    }

     public function Harddisk()
    {
        return $this->hasMany(Harddisk::class, 'brands_id');
    }
}
