<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Chuyển danh sách các vai trò từ chuỗi thành mảng
        $rolesArray = array_map('intval', $roles);

        if ($user && in_array($user->role, $rolesArray)) {
            return $next($request);
        }

        return redirect('home'); // Hoặc trả về một lỗi hoặc trang khác phù hợp
    }
}


