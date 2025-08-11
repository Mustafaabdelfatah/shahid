<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvided extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'phone',
        'whatsapp',
        'content',
        'service',
     ];
}
