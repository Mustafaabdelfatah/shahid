<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagNews extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
     'sort',
     'status',
     'created_by',
     'updated_by',
    ];
    public $translatedAttributes = [
        'tag_news_id',
        'locale',
        'title',
    ];

    protected $translationForeignKey = 'tag_news_id';

    public function trans()
    {
        return $this->hasMany(TagNewsTranslation::class, 'tag_news_id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'tag_news_pivot', 'tag_news_id','news_id',);
    }

    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
}
