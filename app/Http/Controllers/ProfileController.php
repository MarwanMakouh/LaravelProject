<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Toon het profiel van een gebruiker (publiek toegankelijk)
     */
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);

        return view('profile.show', compact('user'));
    }

    /**
     * Toon het profiel bewerken formulier (alleen voor eigen profiel)
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Maak profiel aan als deze nog niet bestaat
        if (!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
            ]);
        }

        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update het profiel
     */
    public function update(Request $request)
    {
        $request->validate([
            'about_me' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->profile;

        // Maak profiel aan als deze nog niet bestaat
        if (!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
            ]);
        }

        // Update about_me
        $profile->about_me = $request->input('about_me');

        // Upload profiel foto als er een is
        if ($request->hasFile('profile_photo')) {
            // Verwijder oude foto als deze bestaat
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }

            // Upload nieuwe foto
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $profile->profile_photo = $path;
        }

        $profile->save();

        return redirect()->route('profile.edit')->with('success', 'Profiel succesvol bijgewerkt!');
    }

    /**
     * Verwijder de profiel foto
     */
    public function deletePhoto()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if ($profile && $profile->profile_photo) {
            Storage::disk('public')->delete($profile->profile_photo);
            $profile->profile_photo = null;
            $profile->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profiel foto verwijderd!');
    }
}
