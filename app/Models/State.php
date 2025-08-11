<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use App\Models\StateTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory, Translatable;
    protected $fillable = [
        'sort',
        'status',
        'country_id',
        'created_by',
        'updated_by',
        
    ];

    public $translatedAttributes = [
        'state_id',
        'locale',
        'title',
    ];

    protected $translationForeignKey = 'state_id';

    public function trans()
    {
        return $this->hasMany(StateTranslation::class, 'state_id');
    }
    public function trans_api()
    {
        return $this->belongsTo(StateTranslation::class, 'state_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class)->with('trans');
    }
    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
