<?php

namespace App\Models;

use App\Models\categories;
use App\Models\comments;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'status', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(comments::class);
    }
}
