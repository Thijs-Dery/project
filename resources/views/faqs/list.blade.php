@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQs</h1>
    <a href="{{ route('faqs.create') }}" class="btn btn-primary mb-3">Add FAQ</a>
    <a href="{{ route('faq-categories.index') }}" class="btn btn-secondary mb-3">FAQ Categories</a>
    
    @if($faqs->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>{{ $faq->category->name }}</td>
                        <td>
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                                @csrf           
                                @method('DELETE')
                                   <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                               </form>
                           </td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
       @else
           <p>No FAQs found.</p>
       @endif
   </div>
   @endsection
