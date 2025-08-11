<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandTranslation extends Model
{
    use HasFactory;
    protected $table = 'land_translations';

    protected $fillable = [
        'land_id',
        'locale',
        'title',
        'description',
    ];
}
