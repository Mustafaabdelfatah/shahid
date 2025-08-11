<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictTranslation extends Model
{
    use HasFactory;
    
    protected $table = 'district_translations';
    protected $fillable = [
        'district_id',
        'locale',
        'title',
     ];

}
