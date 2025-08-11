<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatePackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'duration',
        'package_id'
    ];
}
