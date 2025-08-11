<?php

namespace App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\Product;
use App\Models\DatePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DatePackageProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'date_id',
        'product_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];
    public function scopeActive($query, $arg)
    {
        return $query->where('status', $arg);
    }
    //all relations
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id')->with('trans');
    }
    public function packageApi()
    {
        return $this->belongsTo(Package::class, 'package_id')->with(['trans','package_data']);
    }
    public function date()
    {
        return $this->belongsTo(DatePackage::class, 'date_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('trans');
    }
    public function product_pi()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
