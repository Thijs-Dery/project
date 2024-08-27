@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create FAQ</h1>
    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="faq_category_id">Category:</label>
            <select name="faq_category_id" id="faq_category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" name="question" id="question" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer:</label>
            <textarea name="answer" id="answer" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create FAQ</button>
    </form>
</div>
@endsection



