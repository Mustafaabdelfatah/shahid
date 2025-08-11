<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagNewsTranslation extends Model
{
    use HasFactory;

    protected $table = 'tag_news_translations';
    protected $fillable = [
        'tag_news_id',
        'locale',
        'title',
        'created_by',
        'updated_by',
    ];
}
