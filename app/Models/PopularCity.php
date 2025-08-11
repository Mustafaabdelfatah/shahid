<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'city_id',
        'created_by',
        'updated_by',
    ];

    public function popular_city_unit()
    {
        return $this->hasMany(PopularCityUnit::class)->with('unit.trans');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->with('trans');
    }

    public function scopeActive($query, $arg)
    {
        return $query->where('status', $arg);
    }
}
