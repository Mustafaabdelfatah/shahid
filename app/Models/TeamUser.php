<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_id',
        'user_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id')->with(['teams', 'user']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeOwnedByUser($query)
    {
        return $query->where('manger_id', Auth::id());
    }



    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }
}
