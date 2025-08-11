<?php

namespace App\Models;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttachmentProduct extends Model
{
    use HasFactory;
      protected $fillable = [
        'product_id',
        'image',
        'plan',
        'created_by',
        'updated_by',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('product', 'attachment');
        }
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }


}
