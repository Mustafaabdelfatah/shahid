<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_id',
        'portfolio_id',
        'created_by',
        'updated_by',
    ];
}
