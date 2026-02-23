<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow logged-in users
    }

    public function rules(): array
    {
        return [
            // User table
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),

            // Profile fields
            'street_address' => 'required|string|max:255',
            'street_address_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',

            'high_school' => 'required|string|max:255',
            'other_high_school' => 'nullable|string|max:255',
            'degree_field' => 'required|string|max:255',

            // Files (PDF only, max 2MB)
            'transcript' => 'required|file|mimes:pdf|max:2048',
            'sar' => 'required|file|mimes:pdf|max:2048',
            'acceptance_letter' => 'required|file|mimes:pdf|max:2048',

            // Nested Arrays for School Activity
            'school_activity.year.*' => 'nullable|string|max:50',
            'school_activity.name.*' => 'nullable|string|max:255',
            'school_activity.description.*' => 'nullable|string',

            // Nested Arrays for Community Activity
            'community_activity.year.*' => 'nullable|string|max:50',
            'community_activity.name.*' => 'nullable|string|max:255',
            'community_activity.description.*' => 'nullable|string',
        ];
    }
}
