@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Filter Menu on the Left Side -->
        <div class="col-md-3">
            <h4>Filter Recipes</h4>
            <form method="GET" action="{{ route('recipes.index') }}">
                <div class="form-group">
                    <label for="recipeType">Recipe Type</label>
                    <select id="recipeType" name="type" class="form-control">
                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Recipes</option>
                        <option value="user" {{ request('type') == 'user' ? 'selected' : '' }}>User Recipes</option>
                        <option value="api" {{ request('type') == 'api' ? 'selected' : '' }}>API Recipes</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
        </div>

        <!-- Recipes Display on the Right Side -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Recipes</h1>

                <!-- Search Bar -->
                <form method="GET" action="{{ route('recipes.index') }}" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <div>
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary">Add Your Own Recipe</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($recipe->description), 100) }}</p>
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">View Recipe</a>

                                <!-- Favorite Button -->
                                <button class="btn btn-link favorite-button" data-recipe-id="{{ $recipe->id }}">
                                    @if (auth()->user() && auth()->user()->hasFavorited($recipe->id))
                                        <i class="fas fa-heart text-danger"></i> <!-- Filled heart -->
                                    @else
                                        <i class="far fa-heart"></i> <!-- Empty heart -->
                                    @endif
                                </button>

                                @if ($recipe->user_id === auth()->id())
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Display pagination links only once -->
            <div class="d-flex justify-content-center">
                {{ $recipes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.querySelectorAll('.favorite-button').forEach(function(button) {
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
                if (data.isFavorited) {
                    button.innerHTML = '<i class="fas fa-heart text-danger"></i>'; // Filled heart
                } else {
                    button.innerHTML = '<i class="far fa-heart"></i>'; // Empty heart
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
@endsection
