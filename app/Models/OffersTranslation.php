<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersTranslation extends Model
{
    use HasFactory;
    protected $table = 'offer_translations';
    protected $fillable = [
        'locale',
        'title',
        'description',
        'offers_id',
    ];
}
