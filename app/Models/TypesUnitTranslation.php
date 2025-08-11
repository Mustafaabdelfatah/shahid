<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesUnitTranslation extends Model
{
    use HasFactory;

    protected $table = 'types_unit_translations';
    protected $fillable = [
        'types_unit_id',
        'locale',
        'title',
    ];
}
