
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQs</h1>
    <ul>
        @foreach($faqs as $faq)
            <li>
                <h2>{{ $faq->question }}</h2>
                <p>{{ $faq->answer }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection

