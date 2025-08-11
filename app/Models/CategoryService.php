<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\CategoryServiceTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryService extends Model
{
    use HasFactory,Translatable,SoftDeletes;
    protected $fillable = [
        'image',
    ];
    public $translatedAttributes = [
        'category_service_id',
        'locale',
        'title',
    ];
    protected $translationForeignKey = 'category_service_id';

    public function trans()
    {
        return $this->hasMany(CategoryServiceTranslation::class, 'category_service_id');
    }

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
            $this->attributes['image'] = $value->store('category_service', 'attachment');
        }
    }
    
    public function services()
    {
        return $this->hasMany(Service::class, 'category_service_id')->with('trans');
    }
}