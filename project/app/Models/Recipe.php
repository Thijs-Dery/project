<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title', 'description', 'ingredients', 'instructions', 'image', 'user_id'
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'recipe_id', 'user_id');
    }

}