@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $faq->question }}</h1>
    <p>{{ $faq->answer }}</p>
    <p><strong>Category:</strong> {{ $faq->category->name }}</p>
    <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Back to FAQs</a>
</div>
@endsection
