<?php

namespace App\Models;

use App\Models\DatePackage;
use App\Models\PackageTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'type',
        'status',
    ];
    public $translatedAttributes = [
        'package_id',
        'title',
        'description',
        'locale'
    ];
    // foreign key
    protected $translationForeignKey = 'package_id';

    public function trans()
    {
        return $this->hasMany(PackageTranslation::class, 'package_id');
    }



    public function package_data()
    {
        return $this->hasMany(DatePackage::class, 'package_id');
    }
    public function scopeActive($query, $arg)
    {
        return $query->where('status', $arg);
    }
}
