<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productproperty extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "property_id",
    
    ] ;
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function property(){
        return $this->belongsTo(PropertyType::class);
    }
   
}
