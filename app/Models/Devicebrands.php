<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Devicebrands extends Model
// {
//     /**
//      * The table associated with the model.
//      *
//      * @var string
//      */
//     protected $table = 'devicebrands';

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array
//      */
//     protected $fillable = [
//         'name',
//         'image',
//     ];

//     public function brand()
// {
//     return $this->hasMany(Brands::class);
// }
// }
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceBrands extends Model
{
    use HasFactory;

    protected $table = 'devicebrands';
    protected $fillable = ['name', 'image'];

    /**
     * One DeviceBrand has many Brand records
     */
    public function brands()
    {
        return $this->hasMany(Brands::class, 'devicebrand_id');
    }
}
