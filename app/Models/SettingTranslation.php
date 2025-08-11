<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;
    protected $table = 'setting_translations';

    protected $fillable = [
        'setting_id',
        'locale',
        'meta_title',
        'meta_description',
        'meta_key',
    ];
}
