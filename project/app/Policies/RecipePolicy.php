<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    // Allow admins to do everything
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    // Determine if the given recipe can be updated by the user
    public function update(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }

    // Determine if the given recipe can be deleted by the user
    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }
}

