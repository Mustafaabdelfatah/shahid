<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularCityUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'popular_city_id',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Product::class, 'unit_id');
    }
}
