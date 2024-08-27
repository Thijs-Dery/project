@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit FAQ Category</h1>
    <form action="{{ route('faq-categories.update', $faqCategory->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $faqCategory->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
