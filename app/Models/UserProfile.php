<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    // Add the fields to the fillable array to allow mass assignment
    protected $fillable = [
        'phone',
        'street_address',
        'street_address_2',
        'city',
        'state',
        'zip_code',
        'high_school',
        'other_high_school',
        'degree_field',
        'transcript',
        'sar',
        'acceptance_letter',
        'school_activity',
        'community_activity',
    ];
    protected $casts = [
        'school_activity' => 'array',
        'community_activity' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
