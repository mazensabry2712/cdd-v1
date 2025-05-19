<?php


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
