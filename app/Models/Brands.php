<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['serial_number', 'devicebrand_id', 'model'];

    // belongsTo DeviceBrand
    public function deviceBrand()
    {
        return $this->belongsTo(Devicebrands::class, 'devicebrand_id', 'id');
    }

    // hasMany Harddisk
    public function harddisks()
    {
        return $this->hasMany(Harddisk::class, 'brands_id', 'id');
    }
}
