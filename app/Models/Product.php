<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\Gates;
use App\Models\State;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Models\District;
use App\Models\PropertyType;
use App\Models\UnitInstallment;
use App\Models\AttachmentProduct;
use App\Models\ProductTranslation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Notifiable, SoftDeletes, Translatable;

    protected $fillable = [
        'price',
        'service_charges',
        'size',
        'status',
        'approve',
        'main_category',
        'rooms',
        'code',
        'bathroom',
        'floor',
        'expairday',
        'primum',
        'location',
        'Finishing_type',
        'Furnished',
        'type',
        'paying',
        'category_id',
        'property_id',
        'country_id',
        'state_id',
        'city_id',
        'gates_id',
        'services_id',
        'district_id',
        'admin_id',
        'user_id',
        'for_sale',
        'plan',
        'created_by',
        'updated_by',
        'project_id',
        'video_unit',
        'finance',
        'fawry',
        'delivery_date',
        'deposit_id',
        'building_number',
        'notes',

    ];

    public $translatedAttributes = [
        'product_id',
        'locale',
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_key',
    ];

    public function getVideoUnitAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);

            return $path;
        }
    }

    public function setVideoUnitAttribute($value)
    {
        if ($value) {
            $this->attributes['video_unit'] = $value->store('product', 'attachment');
        }
    }

    public function getPlanAttribute($value)
    {
        if ($value) {
            $path = asset('attachments/' . $value);

            return $path;
        }
    }

    public function setPlanAttribute($value)
    {
        if ($value) {
            $this->attributes['plan'] = $value->store('product', 'attachment');
        }
    }

    // foreign key
    protected $translationForeignKey = 'product_id';

    public function trans()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }
    public function scopeOwnedByUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In your Product model (App\Models\Product.php)
    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->with('trans');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->with('trans');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id')->with('trans');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->with('trans');
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'services_id')->with('trans');
    }
    // public function gates()
    // {
    //     return $this->belongsTo(Gates::class, 'gates_id')->with('trans');
    // }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id')->with('trans');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->with(['trans']);
    }

    public function images()
    {
        return $this->hasMany(AttachmentProduct::class, 'product_id');
    }

    public function property()
    {
        return $this->belongsToMany(PropertyType::class, 'productproperties', 'product_id', 'property_id')->with('trans');
    }

    public function propertyProduct()
    {
        return $this->hasMany(ProductProperty::class, 'product_id')->with('property');
    }
    public function gates()
    {
        return $this->belongsToMany(Gates::class, 'gate_umits_pivot', 'products_id', 'gates_id')->with('trans');
    }

    public function propertyTrans()
    {
        return $this->belongsToMany(PropertyTypeTranslation::class, 'productproperties', 'product_id', 'property_id')->with('trans');
    }

    public function propertyTrans_api()
    {
        return $this->belongsToMany(PropertyTypeTranslation::class, 'productproperties', 'product_id', 'property_id')->with('trans');
    }

    public function viewproducts()
    {
        return $this->hasMany(UserView::class, 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(WishList::class, 'product_id');
    }

    public function datePackageProduct()
    {
        return $this->hasMany(DatePackageProduct::class, 'product_id')->with('packageApi');
    }

    public function scopeActive($query, $arg)
    {
        return $query->where('status', $arg);
    }

    public function scopeApprove($query, $arg)
    {
        return $query->where('approve', $arg);
    }

    public function scopePrimum($query, $arg)
    {
        return $query->where('primum', $arg);
    }

    public function create_by()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function update_by()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    public function installments()
    {
        return $this->hasMany(UnitInstallment::class, 'product_id');
    }



    public function scopeFilter(Builder $builder, $filters)
    {
        // Price filtering & paying &primum
        $builder->when($filters['price_min'] ?? false, fn($query, $value) => $query->where('price', '>=', $value));
        $builder->when($filters['price_max'] ?? false, fn($query, $value) => $query->where('price', '<=', $value));
        $builder->when($filters['price'] ?? false, fn($query, $value) => $query->where('price', 'like', "%{$value}%"));
        $builder->when($filters['paying'] ?? false, fn($query, $value) => $query->where('paying', 'like', "%{$value}%"));
        $builder->when($filters['primum'] ?? false, fn($query, $value) => $query->where('primum', 'like', "%{$value}%"));

        // Title filtering with translation support
        $builder->when($filters['title'] ?? false, fn($query, $value) => $query->orWhereTranslationLike('title', "%{$value}%"));

        // Delivery date filtering
        $builder->when($filters['delivery_date'] ?? false, fn($query, $value) => $query->where('delivery_date', 'like', "%{$value}%"));
        $builder->when($filters['delivery_date_min'] ?? false, fn($query, $value) => $query->where('delivery_date', '>=', $value));
        $builder->when($filters['delivery_date_max'] ?? false, fn($query, $value) => $query->where('delivery_date', '<=', $value));

        // Fawry filtering
        $builder->when(isset($filters['fawry']), fn($query) => $query->where('fawry', $filters['fawry']));

        // Space and size filtering
        $builder->when($filters['space'] ?? false, fn($query, $value) => $query->where('size', 'like', "%{$value}%"));
        $builder->when($filters['size_min'] ?? false, fn($query, $value) => $query->where('size', '>=', $value));
        $builder->when($filters['size_max'] ?? false, fn($query, $value) => $query->where('size', '<=', $value));

        // Rooms and bathroom filtering
        $builder->when($filters['rooms'] ?? false, fn($query, $value) => $query->where('rooms', 'like', "%{$value}%"));
        $builder->when($filters['bathroom'] ?? false, fn($query, $value) => $query->where('bathroom', 'like', "%{$value}%"));

        // Code, location, and type filtering
        $builder->when($filters['code'] ?? false, fn($query, $value) => $query->where('code', 'like', "%{$value}%"));
        $builder->when($filters['location'] ?? false, fn($query, $value) => $query->where('location', 'like', "%{$value}%"));
        $builder->when($filters['type'] ?? false, fn($query, $value) => $query->where('type', 'like', "%{$value}%"));
        $builder->when($filters['building_number'] ?? false, fn($query, $value) => $query->where('building_number', 'like', "%{$value}%"));

        // Status, finance, and approval status filtering
        $builder->when(@$filters['status'] == '0' ? 'dis_active' : @$filters['status'], fn($query, $value) => $query->where('status', $value == 'dis_active' ? 0 : $value));
        $builder->when(@$filters['finance'] == '0' ? 'dis_active' : @$filters['finance'], fn($query, $value) => $query->where('finance', $value == 'dis_active' ? 0 : $value));
        $builder->when(@$filters['approve'] == '0' ? 'dis_active' : @$filters['approve'], fn($query, $value) => $query->where('approve', $value == 'dis_active' ? 0 : $value));

        // Installment filtering (down payment and years)
        $builder->when($filters['deposit'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '=', $value)));
        $builder->when($filters['deposit_min'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '>=', $value)));
        $builder->when($filters['deposit_max'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('deposit', '<=', $value)));
        $builder->when($filters['years'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('years', '=', $value)));
        $builder->when($filters['monthly_installment'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '=', $value)));
        $builder->when($filters['monthly_installment_min'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '>=', $value)));
        $builder->when($filters['monthly_installment_max'] ?? false, fn($query, $value) => $query->whereHas('installments', fn($q) => $q->where('monthly_installment', '<=', $value)));

        // Enum filters (main category, finishing type, furnished status)
        $builder->when($filters['main_category'] ?? false, fn($query, $value) => $query->where('main_category', (array) $value));
        $builder->when($filters['Furnished'] ?? false, fn($query, $value) => $query->where('Furnished', (array) $value));
        $builder->when($filters['Finishing_type'] ?? false, function ($query, $value) {
            // التأكد من أن القيمة هي مصفوفة، وإلا تحويلها إلى مصفوفة
            $values = is_array($value) ? $value : [$value];
            return $query->whereIn('Finishing_type', $values);
        });
        // rooms
        $builder->when($filters['rooms'] ?? false, function ($query, $value) {
            $values = is_array($value) ? $value : [$value];
            return $query->whereIn('rooms', $values);
        });
        // bathrooms
        $builder->when($filters['bathroom'] ?? false, function ($query, $value) {
            $values = is_array($value) ? $value : [$value];
            return $query->whereIn('bathroom', $values);
        });

        // Category, gates, district, and city filtering with relationships
        $builder->when($filters['category_id'] ?? false, fn($query, $value) => $query->whereHas('category', fn($q) => $q->where('id', $value)));
        $builder->when($filters['gates_id'] ?? false, fn($query, $value) => $query->whereHas('gates', fn($q) => $q->where('gates_id', $value)));
        $builder->when($filters['district_id'] ?? false, fn($query, $value) => $query->whereHas('district', fn($q) => $q->where('id', $value)));
        $builder->when($filters['city'] ?? false, fn($query, $value) => $query->whereHas('city', fn($q) => $q->orWhereTranslationLike('title', "%{$value}%")));

        // Property filtering
        $builder->when($filters['property_id'] ?? false, fn($query, $value) => $query->whereHas('property', fn($q) => $q->where('property_id', $value)));

        // General filter search
        $builder->when($filters['filter_search'] ?? false, function ($query, $value) {
            $query->where(function ($q) use ($value) {
                $q->where('price', 'like', "%{$value}%")
                    ->orWhere('size', 'like', "%{$value}%")
                    ->orWhere('rooms', 'like', "%{$value}%")
                    ->orWhere('primum', 'like', "%{$value}%")
                    ->orWhere('code', 'like', "%{$value}%")
                    ->orWhere('building_number', 'like', "%{$value}%")
                    ->orWhere('bathroom', 'like', "%{$value}%")
                    ->orWhereHas('city.trans', fn($q) => $q->where('title', 'like', "%{$value}%"))
                    ->orWhereHas('category.trans', fn($q) => $q->where('title', 'like', "%{$value}%"))
                    ->orWhereHas('trans', fn($q) => $q->where('title', 'like', "%{$value}%"));
            });
        });

        // Sort order
        $builder->when($filters['sort'] ?? false, function ($query, $value) {
            if ($value === 'low-to-high') {
                $query->orderBy('price', 'asc');
            } elseif ($value === 'high-to-low') {
                $query->orderBy('price', 'desc');
            }
        });
    }




    // Get All Deleted Records
    public static function getAllDeleted()
    {
        return self::onlyTrashed()->get();
    }

    // Restore a Deleted Record
    public static function restoreProduct($id)
    {
        $product = self::onlyTrashed()->find($id);
        if ($product) {
            $product->restore();
            // $category->subjects()->withTrashed()->restore();
        }
        return $product;
    }

    // Force Delete a Record
    public static function forceDeleteProduct($id)
    {
        $product = self::onlyTrashed()->find($id);
        if ($product) {
            $product->forceDelete();
            // $product->subjects()->withTrashed()->forceDelete();
        }
        return $product;
    }
}
