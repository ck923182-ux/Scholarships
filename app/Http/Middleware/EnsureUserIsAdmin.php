<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole; // Import the enum


class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has the ADMIN role
        if (Auth::check() && Auth::user()->role === UserRole::ADMIN) {
            return $next($request);
        }

        // If not an admin, redirect or abort with a 403 Forbidden error
        abort(403, 'You do not have permission to access this page.');
        // or redirect:
        // return redirect('/'); 
    }
}
