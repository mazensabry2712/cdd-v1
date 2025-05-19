<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['serial_number', 'devicebrand_id', 'model'];

    /**
     * عكس علاقة hasMany في DeviceBrands
     */
    public function deviceBrand()
    {
        return $this->belongsTo(DeviceBrands::class, 'devicebrand_id');
    }
}
