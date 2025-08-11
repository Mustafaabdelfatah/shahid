<?php

namespace App\Models;

use App\Models\TypesUnitTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypesUnit extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
     'project_id',
    ];
    public $translatedAttributes = [
        'types_unit_id',
        'locale',
        'title',
    ];

    protected $translationForeignKey = 'types_unit_id';
    public function trans()
    {
        return $this->hasMany(TypesUnitTranslation::class, 'types_unit_id');
    }
}
