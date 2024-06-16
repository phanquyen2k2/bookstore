<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
         $user = auth()->user();

        if ($user && $user->role == $role) {
            return $next($request);
        }
   }
}