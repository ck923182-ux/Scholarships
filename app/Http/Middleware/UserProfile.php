<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Enums\UserRole; // Import the enum


class UserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
      // Check if user is authenticated and has the STUDENT role
        if (Auth::check() && Auth::user()->role === UserRole::STUDENT) {
            return $next($request);
        }

        // If it's an admin or impersonating admin, allow access to view profiles
        if (Auth::check() && (Auth::user()->role === UserRole::ADMIN || session()->has('original_admin_id'))) {
            return $next($request);
        }

        // Redirect based on role if they shouldn't be here
        if (Auth::check()) {
            $role = Auth::user()->role;
            if (in_array($role, [UserRole::COMMUNITY_CHAIR, UserRole::COMMUNITY_MEMBER, UserRole::PRESIDENT, UserRole::VICE_PRESIDENT])) {
                return redirect()->route('committee.dashboard')->with('error', 'Only students can access profile management.');
            }
        }

        // Default fallback
        abort(403, 'Sorry only Student Can update their profile.');
    }

}
