<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the profile for the authenticated user
    public function show()
    {
        $user = Auth::user();

        // Ensure the profile exists and is associated with the authenticated user
        if (!$user->profile) {
            $profile = Profile::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } else {
            $profile = $user->profile;
        }

        return view('profile.show', compact('profile'));
    }

    // Show the form for editing the specified profile
    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('profile.edit', compact('profile'));
    }

    // Update the specified profile in storage
    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profile->update($request->only(['name', 'email', 'birthday', 'about_me']));

        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar')->store('avatars', 'public');
            $profile->update(['avatar' => $filePath]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
