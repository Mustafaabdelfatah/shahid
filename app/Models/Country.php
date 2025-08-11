<?php

namespace App\Models;

use App\Models\CountryTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory,Translatable;

    protected $fillable = [
        'sort',
        'status',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = [
        'country_id',
        'locale',
        'title',

    ];

    protected $translationForeignKey = 'country_id';

    public function trans()
    {
        return $this->hasMany(CountryTranslation::class, 'country_id');
    }


    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
}
