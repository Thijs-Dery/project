@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Favorite Recipes</h1>

    @if ($favorites->isEmpty())
        <div class="alert alert-info">
            You have no favorite recipes yet. Start adding some!
        </div>
    @else
        <div class="row">
            @foreach ($favorites as $recipe)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if ($recipe->image)
                            <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($recipe->description), 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">View Recipe</a>

                            <!-- Unfavorite Button -->
                            <button class="btn btn-link unfavorite-button" data-recipe-id="{{ $recipe->id }}">
                                <i class="fas fa-heart text-danger"></i> <!-- Filled heart -->
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script type="text/javascript">
    document.querySelectorAll('.unfavorite-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var recipeId = this.dataset.recipeId;
            var button = this;

            fetch(`/recipes/${recipeId}/favorite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!data.isFavorited) {
                    button.closest('.col-md-4').remove(); // Remove the card from the UI
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
@endsection
