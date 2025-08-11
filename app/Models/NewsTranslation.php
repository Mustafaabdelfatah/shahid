<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;
    protected $table = 'news_translations';
    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'sub_title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_key',
     ];
}
