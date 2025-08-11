<?php

namespace App\Models;

use App\Models\TagNews;
use App\Models\CategoryNews;
use App\Models\NewAttachment;
use App\Models\NewsTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\News\TagNewsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'status',
        'sort',
        'image',
        'created_by',
        'updated_by',
    ];
    public $translatedAttributes = [
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
    protected $translationForeignKey = 'news_id';
    public function trans()
    {
        return $this->hasMany(NewsTranslation::class, 'news_id');
    }




    public function categories()
    {
        return $this->belongsToMany(CategoryNews::class, 'category_news_pivot', 'news_id', 'category_id')->with('trans');
    }
    public function tags()
    {
        return $this->belongsToMany(TagNews::class, 'tag_news_pivot', 'news_id', 'tag_news_id')->with('trans');;
    }
    public function images()
    {
        return $this->hasMany(NewAttachment::class, 'new_id');
    }
    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
}
