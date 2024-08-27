@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>FAQs</h1>
        <a href="{{ route('faqs.create') }}" class="btn btn-primary">Add FAQ</a>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



