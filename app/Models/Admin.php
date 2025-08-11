<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'image',
        'cover_image',
        'phone',
        'address',
        'image',
        'cover_image',
        'bio',
        'positions',
        'created_by',
        'updated_by',
        'status',
        'city',
        'company_name',
        'website_link',
        'whatsapp',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'telegram',
        'github',
        'vimeo',
        'tiktok',
        'snapchat',
        'pinterest',
        'map',
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function getCoverImageAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        } else {
            $path =  asset('attachments/' . $value);

            if (Storage::exists($path)) {
                return Storage::temporaryUrl($path, now()->addMinutes(60)); // Adjust the expiry time as needed
            }
        }
    }

    public function setCoverImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $this->attributes['cover_image'] = $value->store('profile', 'attachment');
        } else {
            $this->attributes['cover_image'] = $value; // Assuming $value is already a valid path
        }
    }


    public function getImageAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        } else {
            $path =  asset('attachments/' . $value);

            if (Storage::exists($path)) {
                return Storage::temporaryUrl($path, now()->addMinutes(60)); // Adjust the expiry time as needed
            }
        }
    }




    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('profile', 'attachment');
        }
    }
}
