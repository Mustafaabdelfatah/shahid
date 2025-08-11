<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JopRegister extends Model
{
    use HasFactory;
    protected $table = 'jop_registers'; // تحديد اسم الجدول هنا


    // تأكد من استخدام الحقول المعبأة
    protected $fillable = [
        'job_id',
        'first_name',
        'last_name',
        'contact_number',
        'email',
        'notice_period',
        'work_link',
        'resume',
        'current_salary',
        'expected_salary'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getResumeAttribute($value)
    {
        if ($value) {
            return asset('attachments/' . $value); // تأكد من أن المسار يطابق مكان الملف الفعلي
        }
        return null;
    }

    public function setResumeAttribute($value)
    {
        if ($value) {
            $this->attributes['resume'] = $value->store('jop_registers', 'attachment');
        }
    }
}
