<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of managed users.
     */
    public function index()
    {
        $roles = [
            UserRole::COMMUNITY_CHAIR->value,
            UserRole::COMMUNITY_MEMBER->value,
            UserRole::PRESIDENT->value,
            UserRole::VICE_PRESIDENT->value,
        ];

        $users = User::whereIn('role', $roles)->orderBy('name')->get();

        return view('admin.manage-users', compact('users'));
    }

    /**
     * Switch to another user account.
     */
    public function impersonate(User $user)
    {
        // Don't allow impersonating yourself
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot impersonate yourself.');
        }

        // Store the original admin ID in the session
        session(['original_admin_id' => Auth::id()]);

        // Log in as the target user
        Auth::login($user);

        // Redirect based on role
        if ($user->role === UserRole::STUDENT) {
            return redirect()->route('profile')->with('success', "You are now impersonating {$user->name}.");
        } elseif (in_array($user->role, [UserRole::COMMUNITY_CHAIR, UserRole::COMMUNITY_MEMBER, UserRole::PRESIDENT, UserRole::VICE_PRESIDENT])) {
            return redirect()->route('committee.dashboard')->with('success', "You are now impersonating {$user->name}.");
        }

        return redirect()->route('home')->with('success', "You are now impersonating {$user->name}.");
    }

    /**
     * Stop impersonating and return to admin account.
     */
    public function stopImpersonating()
    {
        $adminId = session('original_admin_id');

        if (!$adminId) {
            return redirect()->route('home');
        }

        $admin = User::find($adminId);

        if ($admin) {
            Auth::login($admin);
            session()->forget('original_admin_id');
            return redirect()->route('admin.manage-users')->with('success', 'Returned to Admin account.');
        }

        return redirect()->route('home');
    }
}
