@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Recipe</h1>
    <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control" id="instructions" name="instructions" rows="3" required>{{ old('instructions', $recipe->instructions) }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Recipe Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="img-thumbnail mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Recipe</button>
    </form>
</div>
@endsection

