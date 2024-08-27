@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New FAQ</h1>
    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>

        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <a href="{{ route('faq-categories.create') }}" class="btn btn-link">Add New Category</a>
        </div>

        <button type="submit" class="btn btn-primary">Create FAQ</button>
    </form>
</div>
@endsection





