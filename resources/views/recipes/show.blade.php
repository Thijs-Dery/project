@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ $recipe['title'] ?? 'No Title' }}</h1>
            @if ($recipe['image'] ?? false)
                <img src="{{ $recipe['image'] }}" class="img-fluid" alt="{{ $recipe['title'] ?? 'No Title' }}">
            @endif
            <p><strong>Description:</strong> {!! $recipe['summary'] ?? 'No Description Available' !!}</p>
            <p><strong>Ingredients:</strong>
                @if(!empty($recipe['extendedIngredients']))
                    <ul>
                        @foreach($recipe['extendedIngredients'] as $ingredient)
                            <li>{{ $ingredient['original'] }}</li>
                        @endforeach
                    </ul>
                @else
                    No Ingredients Available
                @endif
            </p>
            <p><strong>Instructions:</strong> {!! $recipe['instructions'] ?? 'No Instructions Available' !!}</p>

            @if (($recipe['user_id'] ?? null) === auth()->id())
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
@endsection

