<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatesTranslation extends Model
{
    use HasFactory;

    protected $table = 'gates_translations';

    protected $fillable = [
        'gates_id',
        'locale',
        'title',
    ];
}
