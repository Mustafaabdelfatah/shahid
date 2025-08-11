<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\RejectedProductTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RejectedProduct extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'created_by',
        'updated_by',
        'user_id',
        'product_id'
        
    ];
    public $translatedAttributes = [
        'local',
        'message',
        'rejected_id',
    ];

    protected $translationForeignKey = 'rejected_id';

    public function trans()
    {
        return $this->hasMany(RejectedProductTranslation::class, 'rejected_id');
    }
}
