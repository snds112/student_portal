<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EitherAdminOrStudent
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || Auth::guard('student')->check()) {
            return $next($request);
        }

        return redirect()->back()->with('failure', 'Must be logged in to perform this action.');
    }
}
