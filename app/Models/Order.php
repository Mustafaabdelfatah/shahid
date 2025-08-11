<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $fillable = [
        'date_package_id',
        'package_id',
        'product_id',
        'price',
        'user_id',
        'status'
    ];
}
