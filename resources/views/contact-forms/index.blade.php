@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact Messages</h1>

    @foreach($contactForms as $contactForm)
        <div>
            <h2>{{ $contactForm->name }}</h2>
            <p>{{ $contactForm->email }}</p>
            <p>{{ $contactForm->message }}</p>
        </div>
    @endforeach
</div>
@endsection
