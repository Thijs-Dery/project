@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    {{ $profile->user->name }}'s Profile
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $profile->user->name }}</p>
                    <p><strong>Email:</strong> {{ $profile->user->email }}</p>
                    <p><strong>Birthday:</strong> {{ $profile->birthday ? $profile->birthday->format('Y-m-d') : 'N/A' }}</p>
                    <p><strong>About Me:</strong> {{ $profile->about_me }}</p>
                    <p><strong>Avatar:</strong></p>
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $profile->user->name }}'s avatar" class="img-fluid">
                    <a href="{{ route('profile.edit', ['profile' => $profile->id]) }}" class="btn btn-primary mt-3">Edit Profile</a>
                    <form action="{{ route('profile.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this profile?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Profile</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
