<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmetProject extends Model
{
    use HasFactory;
    use HasFactory;
      protected $fillable = [
        'project_id',
        'image',
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
            $this->attributes['image'] = $value->store('projects', 'attachment');
        }
    }
}
