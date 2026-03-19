<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class CommitteeDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard for Community Chair, Member, President, and Vice President.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ensure only allowed roles can see this
        $allowedRoles = [
            UserRole::COMMUNITY_CHAIR,
            UserRole::COMMUNITY_MEMBER,
            UserRole::PRESIDENT,
            UserRole::VICE_PRESIDENT,
            UserRole::ADMIN, // Admin can see everything
        ];

        if (!in_array($user->role, $allowedRoles) && !session()->has('original_admin_id')) {
            abort(403, 'You do not have permission to access the Committee Dashboard.');
        }

        // Fetch applications (placeholder logic for now, as you'll build the applications table later)
        $applications = []; 

        return view('committee.dashboard', compact('user', 'applications'));
    }
}
