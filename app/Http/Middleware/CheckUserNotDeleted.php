<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserNotDeleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->trashed()) {
            Auth::logout();
            return redirect('/login')->withErrors(['error' => 'Tài khoản của bạn đã bị xóa.']);
        }
        return $next($request);
    }
}

