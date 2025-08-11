<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\LandTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Land extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'status',
        'address',
        'image',
        'created_by',
        'updated_by',
        'price',
    ];

    public $translatedAttributes = [
        'land_id',
        'locale',
        'title',
        'description',
    ];

    protected $translationForeignKey = 'land_id';

    public function trans()
    {
        return $this->hasMany(LandTranslation::class, 'land_id');
    }

    public function create_by()
    {
        return   $this->belongsTo(Admin::class, 'created_by');
    }
    public function update_by()
    {
        return   $this->belongsTo(Admin::class, 'updated_by');
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
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            // إذا كان القيمة ملف مرفوع
            $this->attributes['image'] = $value->store('land', 'attachment');
        } else {
            // إذا كان القيمة نص (مثل مسار أو اسم ملف)
            $this->attributes['image'] = $value;
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
