<?php

namespace App\Models;

use App\Models\Mall;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\TypesUnit;
use App\Models\AttachmetProject;
use App\Models\ProjectTranslation;
use App\Models\CompoundInstallment;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'status',
        'delivery_date',
        'construction_status',
        'method_payment',
        'price',
        'spaces',
        'user_id',
        'address',
        'created_by',
        'finish_type',
        'cover',
        'finance',
        'map',
        'country_id',
        'state_id',
        'city_id',
        'district_id'
    ];

    public $translatedAttributes = [
        'project_id',
        'locale',
        'title',
        'slug',
        'description',
    ];


    public function getCoverAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);
            return $path;
        }
    }
    public function setCoverAttribute($value)
    {
        if ($value) {
            $this->attributes['cover'] = $value->store('projects/covers', 'attachment');
        }
    }
    protected $translationForeignKey = 'project_id';

    public function trans()
    {
        return $this->hasMany(ProjectTranslation::class, 'project_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->with(['projects']);
    }

    public function create_by()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function units()
    {
        return $this->hasMany(Product::class, 'project_id')->with('trans', 'installments', 'category');
    }
    public function attachments()
    {
        return $this->hasMany(AttachmetProject::class, 'project_id');
    }
    public function type_units()
    {
        return $this->hasMany(TypesUnit::class, 'project_id')->with('trans');
    }
    public function installments()
    {
        return $this->hasMany(CompoundInstallment::class, 'project_id');
    }
    public function property()
    {
        return $this->belongsToMany(PropertyType::class, 'project_property_types', 'project_id', 'property_id')->with('trans');
    }
    public function scopeActive($query, $arg)
    {
        return $query->where('status', $arg);
    }
    // scope
    public function scopeFilter(Builder $builder, $filters)
    {
        // Installment filtering (down payment and years)
        $builder->when($filters['deposit'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '=', $value)));
        $builder->when($filters['deposit_min'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '>=', $value)));
        $builder->when($filters['deposit_max'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '<=', $value)));
        $builder->when($filters['years'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('years', '=', $value)));
        $builder->when($filters['monthly_installment'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '=', $value)));
        $builder->when($filters['monthly_installment_min'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '>=', $value)));
        $builder->when($filters['monthly_installment_max'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '<=', $value)));

        $builder->when($filters['title'] ?? false, function ($builder, $value) {
            $builder->WhereTranslationLike('title', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('status', $value);
        });

        $builder->when($filters['start_date'] ?? false, function ($builder, $value) {
            $builder->whereDate('created_at', '>=', $value);
        });

        $builder->when($filters['end_date'] ?? false, function ($builder, $value) {
            $builder->whereDate('created_at', '<=', $value);
        });

        $builder->when($filters['price_min'] ?? false, function ($builder, $value) {
            $builder->where('price', '>=', $value);
        });

        $builder->when($filters['price_max'] ?? false, function ($builder, $value) {
            $builder->where('price', '<=', $value);
        });

        $builder->when($filters['construction_status'] ?? false, function ($builder, $value) {
            $builder->where('construction_status', $value);
        });
        $builder->when($filters['finish_type'] ?? false, function ($builder, $value) {
            $builder->where('finish_type', $value);
        });

        $builder->when($filters['method_payment'] ?? false, function ($builder, $value) {
            $builder->where('method_payment', $value);
        });

        $builder->when($filters['delivery_date'] ?? false, function ($builder, $value) {
            $builder->whereDate('delivery_date', $value);
        });
        $builder->when($filters['type_unit'] ?? false, function ($builder, $value) {
            $builder->whereHas('type_units', function ($query) use ($value) {
                $query->whereHas('trans', function ($query2) use ($value) {
                    $query2->where('title', 'LIKE', "%{$value}%");
                });
            });
        });
        $builder->when($filters['title_unit'] ?? false, function ($builder, $value) {
            $builder->whereHas('units', function ($query) use ($value) {
                $query->whereHas('trans', function ($query2) use ($value) {
                    $query2->where('title', 'LIKE', "%{$value}%");
                });
            });
        });
    }
    // Get All Deleted Records
    public static function getAllDeleted()
    {
        return self::onlyTrashed()->get();
    }

    // Restore a Deleted Record
    public static function restoreProject($id)
    {
        $projects = self::onlyTrashed()->find($id);
        if ($projects) {
            $projects->restore();
        }
        return $projects;
    }

    // Force Delete a Record
    public static function forceDeleteProject($id)
    {
        $projects = self::onlyTrashed()->find($id);
        if ($projects) {
            $projects->forceDelete();
        }
        return $projects;
    }
}
