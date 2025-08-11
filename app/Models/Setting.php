<?php

namespace App\Models;

use App\Models\SettingTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
class Setting extends Model
{
    use HasFactory ,Translatable;
    protected $fillable = [
        'type',
        'image_main_light_mode',
        'image_sm_light_mode',
        'image_main_dark_mode',
        'favicon_dashboard',
        'image_sm_dark_mode',
        'logo_web',
        'name',
        'email',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'whatsapp',
        'telegram',
        'github',
        'vimeo',
        'tiktok',
        'snapchat',
        'pinterest',
        'map',
        'address',
        'favicon_web',
        'created_by',
        'updated_by',
    ];
    protected $translationForeignKey = 'setting_id';
    public $translatedAttributes = [
        'setting_id',
        'locale',
        'meta_title',
        'meta_description',
        'meta_key',

    ];
    // relations ---------------------------------------------------------------------------------
    public function trans()
    {
        return $this->hasMany(SettingTranslation::class, 'setting_id', 'id');
    }
    // Attribute ----------------------------
    public function setLogoWebAttribute($value)
    {
        if ($value) {
            $this->attributes['logo_web'] = $value->store('setting', 'attachment');
        }
    }
    public function getLogoWebAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        }
    }
    public function setFaviconWebAttribute($value)
    {
        if ($value) {
            $this->attributes['favicon_web'] = $value->store('setting', 'attachment');
        }
    }
    public function getFaviconWebAttribute($value)
    {
        if ($value) {
            $path =  asset('attachments/' . $value);
            return $path;
        }
    }

    
    public function setImageMainLightModeAttribute($value)
    {
        if ($value) {
            $this->attributes['image_main_light_mode'] = $value->store('admin/images/default', 'settingFile');
        }
    }
    public function getImageMainLightModeAttribute($value)
    {
        if ($value) {
            $path =  asset('assets/' . $value);
            return $path;
        }
    }
    public function setImageSmLightModeAttribute($value)
    {
        if ($value) {
            $this->attributes['image_sm_light_mode'] = $value->store('admin/images/default', 'settingFile');
        }
    }
    public function getImageSmLightModeAttribute($value)
    {
        if ($value) {
            $path =  asset('assets/' . $value);
            return $path;
        }
    }

    public function setImageMainDarkModeAttribute($value)
    {
        if ($value) {
            $this->attributes['image_main_dark_mode'] = $value->store('admin/images/default', 'settingFile');
        }
    }
    public function getImageMainDarkModeAttribute($value)
    {
        if ($value) {
            $path =  asset('assets/' . $value);
            return $path;
        }
    }
    public function setImageSmDarkModeAttribute($value)
    {
        if ($value) {
            $this->attributes['image_sm_dark_mode'] = $value->store('admin/images/default', 'settingFile');
        }
    }
    public function getImageSmDarkModeAttribute($value)
    {
        if ($value) {
            $path =  asset('assets/' . $value);
            return $path;
        }
    }
}
