<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'category_job_id', 'address', 'description'];

    public function categoryJob()
    {
        return $this->belongsTo(CategoryJob::class, 'category_job_id');
    }

}
