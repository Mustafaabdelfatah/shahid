<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "user_id",
    ] ;

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id')->with(['trans','category','country','state','city','user','district','images','property','viewproducts']);
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
