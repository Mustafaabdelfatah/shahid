<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Product;
use App\Models\PropertyTranslation;
use App\Models\PropertyTypeTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;
    protected $table = 'properties';
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'status',
        'sort',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = [
        'locale',
        'title',
        'property_id',
    ];

    protected $translationForeignKey = 'property_id';

    public function trans()
    {
        return $this->hasMany(PropertyTypeTranslation::class, 'property_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'productproperties', 'property_id', 'product_id');
    }
    public function create_by()
    {
        return   $this->belongsTo(Admin::class, 'created_by');
    }
    public function update_by()
    {
        return   $this->belongsTo(Admin::class, 'updated_by');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
