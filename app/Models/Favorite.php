<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Recipe;

class User extends Authenticatable
{
    use Notifiable;

    // Other model methods and properties...

    public function favorites()
    {
        return $this->belongsToMany(Recipe::class, 'user_favorite_recipes', 'user_id', 'recipe_id');
    }
}
