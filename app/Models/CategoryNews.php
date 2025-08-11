<?php

namespace App\Models;

use App\Models\CategoryNewsTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryNews extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'sort',
        'status',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = [
        'category_news_id',
        'locale',
        'title'
    ];

    protected $translationForeignKey = 'category_news_id';

    public function trans()
    {
        return $this->hasMany(CategoryNewsTranslation::class, 'category_news_id');
    }

    public function trans_api()
    {
        return $this->belongsTo(CategoryNewsTranslation::class, 'category_news_id');
    }
    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news_pivot',  'category_id', 'news_id');
    }
    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
}
