<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNewsTranslation extends Model
{
    use HasFactory;

    protected $table = 'category_news_translations';
    protected $fillable = [
        'category_news_id',
        'locale',
        'title',
     ];
}
