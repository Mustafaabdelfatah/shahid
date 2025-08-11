<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_id',
        'image',
    ];

    /**
     * Get the URL of the image.
     *
     * @param string|null $value
     * @return string|null
     */
    public function getImageAttribute($value)
    {
        return $value ? asset($value) : null; // يتم استخدام القيمة مباشرة لأنك تخزن المسار الكامل.
    }

    /**
     * Set the image attribute and store the uploaded file.
     *
     * @param mixed $value
     */
    public function setImageAttribute($value)
    {
        if ($value) {
            if (is_object($value) && method_exists($value, 'move')) {
                // قم بتحريك الملف إلى المسار المحدد
                $imagePath = 'attachments/' . $value->getClientOriginalName(); // يمكنك تعديل الاسم كما تحتاج
                
                $value->move(public_path('attachments'), $imagePath); // نقل الصورة إلى المجلد
                $this->attributes['image'] = $imagePath; // تخزين المسار في قاعدة البيانات
            } else {
                $this->attributes['image'] = $value; // في حال كان القيمة مجرد مسار
            }
        }
    }

    /**
     * Define the relationship with the News model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
