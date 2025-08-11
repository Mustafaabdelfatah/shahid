<?php

namespace App\Models;

use App\Models\Deposit;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitInstallment extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "deposit",
        "monthly_installment",
        "years",
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
