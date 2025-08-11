<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Team;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'backup_number',
        'address',
        'image',
        'cover_image',
        'bio',
        'status',
        'city',
        'company_name',
        'website_link',
        'whatsapp',
        'commercial_registration_no',
        'created_by',
        'updated_by',
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
        'role',
        'parent_id',
        'agency_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];
    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = Hash::make($password);
        }
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function teamManger()
    {
        return $this->belongsTo(Team::class, 'id')->with('teams');
    }

    public function teams()
    {
        return $this->belongsToMany(User::class, 'team_users', 'user_id', 'team_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id')->with('trans');
    }
    public function wishlist()
    {
        return $this->hasMany(WishList::class, 'user_id')->with('product');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id')->with(['trans']);
    }
    public function units()
    {
        return $this->hasMany(Product::class, 'user_id')->with('trans', 'category', 'country', 'state', 'city', 'district', 'images', 'property', 'viewproducts', 'wishlists');
    }
    // scope
    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'like', "%{$value}%");
        });
        $builder->when($filters['email'] ?? false, function ($builder, $value) {
            $builder->where('email', 'like', "%{$value}%");
        });
        $builder->when($filters['phone'] ?? false, function ($builder, $value) {
            $builder->where('phone', 'like', "%{$value}%");
        });
        $builder->when($filters['role'] ?? false, function ($builder, $value) {
            $builder->where('role', 'like', "%{$value}%");
        });

        $builder->when(@$filters['status'] == "0" ? "dis_active" : @$filters['status'], function ($builder, $value) {
            $value = $value == "dis_active" ? 0 : $value;
            $builder->where('status', $value);
        });
        $builder->when($filters['building_number'] ?? false, function ($builder, $value) {
            $builder->whereHas('products', function ($query) use ($value) {
                $query->where('building_number', 'like', "%{$value}%");
            });
        });
    }


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
            $this->attributes['image'] = $value->store('users', 'attachment');
        }
    }
    public function getCoverImageAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);
            return $path;
        }
    }
    public function setCoverImageAttribute($value)
    {
        if ($value) {
            $this->attributes['cover_image'] = $value->store('users', 'attachment');
        }
    }
    public function getAgancyImageAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);
            return $path;
        }
    }
    public function setAgancyImageAttribute($value)
    {
        if ($value) {
            $this->attributes['agency_image'] = $value->store('users', 'attachment');
        }
    }
}
