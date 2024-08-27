@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Recipe</h1>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients</label>
            <textarea name="ingredients" id="ingredients" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="instructions">Instructions</label>
            <textarea name="instructions" id="instructions" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Recipe Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Recipe</button>
    </form>
</div>
@endsection
