<?php

namespace App\Models;

use App\Models\posts;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $fillable = ['body', 'user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(posts::class);
    }
}
