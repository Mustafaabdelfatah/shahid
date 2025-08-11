<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['status', 'image', 'sort', 'section_name'];

    public $translatedAttributes = [
        'category_id',
        'locale',
        'title',
        'sub_title',
        'created_by',
        'updated_by',
    ];

    // foreign key
    protected $translationForeignKey = 'category_id';

    public function trans()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/'.$value);

            return $path;
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('catgoreis', 'attachment');
        }
    }

    public function units()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeActive($query, $arg)
    {

        return $query->where('status', $arg);
    }
    public static function boot()
    {
        parent::boot();

        // Handle soft deleting of related products
        static::deleting(function ($category) {
            if ($category->isForceDeleting()) {
                $category->units()->forceDelete();
            } else {
                $category->units()->delete();
            }
        });

        // Handle restoring of related products
        static::restoring(function ($category) {
            $category->units()->restore();
        });
    }

    public static function getAllDeleted()
    {
        return self::onlyTrashed()->get();
    }

    // Restore a Deleted Record
    public static function restoreCategory($id)
    {
        $category = self::onlyTrashed()->find($id);
        if ($category) {
            $category->restore();
        }
        return $category;
    }

    // Force Delete a Record
    public static function forceDeleteCategory($id)
    {
        $category = self::onlyTrashed()->find($id);
        if ($category) {
            $category->forceDelete();
        }
        return $category;
    }
}
