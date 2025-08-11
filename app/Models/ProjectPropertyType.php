<?php

namespace App\Models;

use App\Models\Project;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectPropertyType extends Model
{
    use HasFactory;
    protected $fillable = [
        "project_id",
        "property_id",
    
    ] ;
    
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function property(){
        return $this->belongsTo(PropertyType::class);
    }
}
