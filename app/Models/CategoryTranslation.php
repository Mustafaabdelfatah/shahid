<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $table = 'category_translations';
    protected $fillable = [
        'category_id',
        'locale',
        'title',
        'sub_title',
     ];
}
