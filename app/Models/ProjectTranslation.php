<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    use HasFactory;

    protected $table = 'project_translations';

    protected $fillable = [
        'project_id',
        'locale',
        'title',
        'address',
        'description',
    ];
}
