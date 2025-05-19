<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devicebrands extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devicebrands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
    ];
}
