<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory ,Translatable;

    protected $fillable = [

        'country_id',
        'state_id',
        'city_id',
        'sort',
        'status',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = [
        'district_id',
        'locale',
        'title',
    ];

    protected $translationForeignKey = 'district_id';

    public function trans()
    {
        return $this->hasMany(DistrictTranslation::class, 'district_id');
    }

    public function trans_api()
    {
        return $this->belongsTo(DistrictTranslation::class, 'district_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->with('trans');
    }

    public function state()
    {
        return $this->belongsTo(State::class)->with('trans');
    }

    public function city()
    {
        return $this->belongsTo(City::class)->with('trans');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function create_by()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
