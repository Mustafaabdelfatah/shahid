<?php

namespace App\Models;

use App\Models\Product;
use App\Models\GatesTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gates extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'image',
        'status',
    ];

    public $translatedAttributes = [
        'gates_id',
        'locale',
        'title',

    ];
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
            $this->attributes['image'] = $value->store('gates', 'attachment');
        }
    }

    public function trans()
    {
        return $this->hasMany(GatesTranslation::class, 'gates_id');
    }

    public function units()
    {
        return  $this->hasMany(Product::class, 'project_id')->with('trans');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'gate_umits_pivot', 'gates_id', 'products_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}