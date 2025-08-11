<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsCommint extends Model
{
    use HasFactory;
    protected $fillable = [
        "stars",
        "user_id",
        "news_id",
        "commint",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function news()
    {
        return $this->belongsTo(News::class);

    }
}
