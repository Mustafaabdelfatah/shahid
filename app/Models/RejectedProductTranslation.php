<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedProductTranslation extends Model
{
    use HasFactory;
    protected $table = 'rejected_product_translations';

    protected $fillable = [
        'local',
        'message',
        'rejected_id',
    ];
}
