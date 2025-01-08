<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Проверяем, есть ли авторизованный пользователь
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Получаем роли текущего пользователя
        $userRoles = auth()->user()->roles->pluck('name')->toArray();

        // Проверяем, есть ли у пользователя необходимая роль
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        // Если пользователь не имеет необходимой роли, перенаправляем на ошибку или другую страницу
        return redirect('/admin')->with('error', 'Сізде бұл ресурсқа құқық жоқ.');
    }
}
