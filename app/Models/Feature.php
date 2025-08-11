<?php

namespace App\Models;

use App\Models\FeatureTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = [
        'featur_id',
        'locale',
        'title',
    ];

    protected $translationForeignKey = 'featur_id';

    public function trans()
    {
        return $this->hasMany(FeatureTranslation::class, 'featur_id');
    }
}