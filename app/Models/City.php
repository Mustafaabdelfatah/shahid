<?php

namespace App\Models;

use App\Models\State;
use App\Models\Country;
use App\Models\CityTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class City extends Model
{
    use HasFactory,Translatable;
    protected $fillable = [
        'image',
        'sort',
        'country_id',
        'state_id',
        'status',
        'created_by',
        'updated_by',
    ];
    public $translatedAttributes = [
        'city_id',
        'locale',
        'title',
    ];
    protected $translationForeignKey = 'city_id';

    public function trans()
    {
        return $this->hasMany(CityTranslation::class, 'city_id');
    }



    public function country()
    {
        return $this->belongsTo(Country::class)->with('trans');
    }

    public function state()
    {
        return $this->belongsTo(State::class)->with('trans');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('city', 'attachment');
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
