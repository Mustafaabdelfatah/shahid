<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'image',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);
            return $path;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('service', 'attachment');
        }
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}