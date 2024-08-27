<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    public function index(Request $request)
{
    $filter = $request->input('filter', 'all');
    $search = $request->input('search');

    $query = Recipe::query();

    if ($filter === 'user') {
        $query->whereNotNull('user_id');
    } else {
        $query->whereNull('user_id');
    }

    if ($search) {
        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
    }

    $recipes = $query->latest()->paginate(12);

    return view('recipes.index', compact('recipes'));
}


    public function fetchAndStoreApiRecipes($number = 100)
    {
        $response = Http::get('https://api.spoonacular.com/recipes/random', [
            'apiKey' => env('SPOONACULAR_API_KEY'),
            'number' => $number,
        ]);

        if ($response->successful()) {
            $recipes = $response->json()['recipes'];

            foreach ($recipes as $apiRecipe) {
                Recipe::create([
                    'title' => $apiRecipe['title'],
                    'description' => strip_tags($apiRecipe['summary']),
                    'ingredients' => json_encode($apiRecipe['extendedIngredients']),
                    'instructions' => $apiRecipe['instructions'],
                    'image' => $apiRecipe['image'] ?? null,
                    'user_id' => null, // These are API recipes, so no user_id
                ]);
            }

            return "Recipes successfully added to the database!";
        } else {
            Log::error('API request failed: ' . $response->body());
            return "Failed to fetch recipes from the API.";
        }
    }

    public function show($id)
    {
        // Find the recipe by its ID
        $recipe = Recipe::findOrFail($id);

        // Return the view to display the recipe details
        return view('recipes.show', compact('recipe'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // If ingredients is expected to be a JSON array, convert it
        $ingredients = json_encode(explode(',', $validatedData['ingredients']));

        // Create a new Recipe instance and assign the validated data
        $recipe = new Recipe();
        $recipe->title = $validatedData['title'];
        $recipe->description = $validatedData['description'];
        $recipe->ingredients = $ingredients; // Store as JSON
        $recipe->instructions = $validatedData['instructions'];
        $recipe->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }

        // Save the recipe to the database
        $recipe->save();

        // Redirect back to the recipes index with a success message
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }


    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    public function toggleFavorite(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $recipe = Recipe::find($id);
        
            if (!$recipe) {
                return response()->json(['error' => 'Recipe not found'], 404);
            }

            if ($user->favorites()->where('recipe_id', $id)->exists()) {
                $user->favorites()->detach($id);
                $isFavorited = false;
            } else {
                $user->favorites()->attach($id);
                $isFavorited = true;
            }
        
            return response()->json(['isFavorited' => $isFavorited]);
        } catch (\Exception $e) {
            Log::error('Error toggling favorite: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function favorites()
    {
        $favorites = auth()->user()->favorites()->get();
        return view('recipes.favorites', compact('favorites'));
    }
}
