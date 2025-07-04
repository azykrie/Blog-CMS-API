<?php

namespace App\Models;

use App\Models\posts;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = ['name', 'slug'];
    
    /**
     * Get the posts associated with the category.
     */
    public function posts()
    {
        return $this->hasMany(posts::class);
    }

    
}
