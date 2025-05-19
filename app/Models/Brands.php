<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Brands extends Model
// {
//     use HasFactory;
//       protected $fillable = ['serial_number', 'brand', 'model'];

//       public function devicebrand()
// {
//     return $this->belongsTo(Devicebrands::class);
// }
// }
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['serial_number', 'model', 'devicebrand_id'];

    /**
     * One Brand belongs to one DeviceBrand
     */
    public function deviceBrand()
    {
        return $this->belongsTo(Devicebrands::class, 'devicebrand_id');
    }
}
