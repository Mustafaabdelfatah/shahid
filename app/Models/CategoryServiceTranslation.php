<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryServiceTranslation extends Model
{
    use HasFactory;
    protected $table = 'category_service_translations';
    protected $fillable = [
        'category_service_id',
        'locale',
        'title',
    
     ];
}
