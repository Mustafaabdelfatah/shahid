<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\OffersTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offers extends Model
{
    use HasFactory;
    protected $table = 'offers';
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'status',
        'address',
        'image',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = [
        'locale',
        'title',
        'description',
        'offers_id',
    ];

    protected $translationForeignKey = 'offers_id';

    public function trans()
    {
        return $this->hasMany(OffersTranslation::class, 'offers_id');
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
            $this->attributes['image'] = $value->store('offers', 'attachment');
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
