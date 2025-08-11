<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'manger_id',
        'status',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'manger_id')->with('units');
    }

    public function teams()
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id')->with('units');
    }
    public function scopeOwnedByUser($query)
    {
        return $query->where('manger_id', Auth::id());
    }


    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
