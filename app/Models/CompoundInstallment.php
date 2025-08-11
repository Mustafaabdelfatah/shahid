<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompoundInstallment extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'deposit',
        'monthly_installment',
        'years',
        'price',
    ];
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
