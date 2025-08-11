<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryJobTranslation extends Model
{
    use HasFactory;
    protected $table = 'category_job_translations';
    protected $fillable = [
        'category_job_id',
        'locale',
        'title',
     ];
     public function categoryJob()
     {
         return $this->belongsTo(CategoryJob::class, 'category_job_id');
     }
}
