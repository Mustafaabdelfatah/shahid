<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryJob extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    protected $fillable = [
        'image',
    ];
    public $translatedAttributes = [
        'category_job_id',
        'locale',
        'title',
    ];
    public function trans()
    {
        return $this->hasMany(CategoryJobTranslation::class, 'category_job_id');
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
            $this->attributes['image'] = $value->store('category_job', 'attachment');
        }
    }

    // العلاقة مع النموذج Job
    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_job_id');
    }
    

    public static function getAllDeleted()
    {
        return self::onlyTrashed()->get();
    }

    // Restore a Deleted Record
    public static function restoreCategory_job($id)
    {
        $category_job = self::onlyTrashed()->find($id);
        if ($category_job) {
            $category_job->restore();
        }
        return $category_job;
    }

    // Force Delete a Record
    public static function forceDeleteCategory_job($id)
    {
        $category_job = self::onlyTrashed()->find($id);
        if ($category_job) {
            $category_job->forceDelete();
        }
        return $category_job;
    }
    
}
