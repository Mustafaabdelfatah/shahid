<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class HomeSettingPage extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'title_section',
        'image',
        'status',
        'url_video',
        'created_by',
        'updated_by',
    ];
    public $translatedAttributes = ['home_setting_id', 'locale', 'title', 'description'];
    // foreign key
    protected $translationForeignKey = 'home_setting_id';

    public function trans()
    {
        return $this->hasMany(HomeSettingPageTranslation::class, 'home_setting_id');
    }



    // Attribute ----------------------------s
    public function getImageAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('page_setting', 'attachment');
        }
    }
    // Scopes ----------------------------
    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
}
