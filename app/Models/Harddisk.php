<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harddisk extends Model
{
    use HasFactory;

    protected $fillable = [
        'brands_id',
        'health',
        'interface',
        'capacity_gb',
        'capacity_unit',
        'serial_number',
        'pdf',
    ];

    // belongsTo Brand
    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brands_id', 'id');
    }
}
