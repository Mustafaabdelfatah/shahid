<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Feature;
use App\Models\CategoryService;
use App\Models\ServiceAttachment;
use App\Models\ServiceTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
class Service extends Model
{
    use HasFactory, Translatable;
    protected $fillable = [
    'status',
    'email',
    'phone',
    'address',
    'facebook',
    'twitter',
    'instagram',
    'category_service_id',
    'map',
    'updated_by',
    'created_by',
    'sort'
    ];

    public $translatedAttributes = [
        'service_id',
        'title',
        'description',
        'locale',
    ];

    protected $translationForeignKey = 'service_id';

    public function trans()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id');
    }
    public function category_service()
    {
        return $this->belongsTo(CategoryService::class, 'category_service_id')->with('trans');
    }
    public function scopeActive($query,$arg)
    {
        return $query->where('status', $arg);
    }
    public function create_by()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function images()
    {
        return $this->hasMany(ServiceAttachment::class, 'service_id');
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_services', 'service_id', 'feature_id')->with('trans');
    }

    public function scopeOrderedBySort(Builder $query,$arg)
    {
        return $query->orderBy('sort', $arg); // Change 'asc' to 'desc' if needed
    }
}
