<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;

use App\Models\User;
use App\Models\UserProfile;
use App\Enums\State;
use App\Enums\HighSchool;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
    public function edit()
    {
        $user = Auth::user();
        $states = State::asArray(); 
        $high_school = HighSchool::asArray(); 
        return view('profile.edit', compact('user' ,'states','high_school'));
    }
    // Add an update method to handle the PUT request
    public function update(UpdateProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validated();

        // Update user table
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Prepare profile data
        $profileData = collect($validated)
            ->except(['name', 'email', 'transcript', 'sar', 'acceptance_letter'])
            ->toArray();

        // Handle file uploads
        if ($request->hasFile('transcript')) {
            $profileData['transcript'] = $request->file('transcript')->store('documents', 'public');
        }

        if ($request->hasFile('sar')) {
            $profileData['sar'] = $request->file('sar')->store('documents', 'public');
        }

        if ($request->hasFile('acceptance_letter')) {
            $profileData['acceptance_letter'] = $request->file('acceptance_letter')->store('documents', 'public');
        }

        // Handle school_activity array
        if ($request->has('school_activity')) {
            $years = $request->input('school_activity.year', []);
            $names = $request->input('school_activity.name', []);
            $descriptions = $request->input('school_activity.description', []);

            $activities = [];
            foreach ($years as $index => $year) {
                if ($year || ($names[$index] ?? null) || ($descriptions[$index] ?? null)) {
                    $activities[] = [
                        'year' => $year,
                        'name' => $names[$index] ?? null,
                        'description' => $descriptions[$index] ?? null,
                    ];
                }
            }
            $profileData['school_activity'] = $activities;
        }

        // Handle community_activity array
        if ($request->has('community_activity')) {
            $years = $request->input('community_activity.year', []);
            $names = $request->input('community_activity.name', []);
            $descriptions = $request->input('community_activity.description', []);

            $activities = [];
            foreach ($years as $index => $year) {
                if ($year || ($names[$index] ?? null) || ($descriptions[$index] ?? null)) {
                    $activities[] = [
                        'year' => $year,
                        'name' => $names[$index] ?? null,
                        'description' => $descriptions[$index] ?? null,
                    ];
                }
            }
            $profileData['community_activity'] = $activities;
        }

        // Update or create profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully!');
    }
}
