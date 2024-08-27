@foreach ($recipes as $recipe)
    <div class="col-md-4 mb-3">
        <div class="card">
            @if ($recipe['image'] ?? false)
                <img src="{{ $recipe['image'] }}" class="card-img-top" alt="{{ $recipe['title'] ?? 'No Title' }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $recipe['title'] ?? 'No Title' }}</h5>
                <p class="card-text">{{ Str::limit(strip_tags($recipe['description']) ?? 'No Description Available', 100) }}</p>
                <a href="{{ route('recipes.show', $recipe['id']) }}" class="btn btn-primary">View Recipe</a>

                <!-- Favorite Button -->
                <button class="btn btn-link favorite-button" data-recipe-id="{{ $recipe['id'] }}">
                    @if (auth()->user() && auth()->user()->hasFavorited($recipe['id']))
                        <i class="fas fa-heart text-danger"></i> <!-- Filled heart -->
                    @else
                        <i class="far fa-heart"></i> <!-- Empty heart -->
                    @endif
                </button>

                @if (isset($recipe['user_id']) && $recipe['user_id'] === auth()->id())
                    <a href="{{ route('recipes.edit', $recipe['id']) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('recipes.destroy', $recipe['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endforeach
