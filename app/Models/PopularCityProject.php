<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularCityProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'city_id',
        'created_by',
        'updated_by',
    ];

    public function popular_city_project()
    {
        return $this->hasMany(PopularCityProjectMulity::class, 'popular_city_id')->with('project.trans');
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
