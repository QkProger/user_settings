<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    protected $guard = 'web';
    public function adminLoginForm(AdminLoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::query()->where('email', $email)->firstOr(function () {
            throw ValidationException::withMessages([
                'email' => [__('Email адрес табылмады')]
            ]);
        });
        if (Hash('sha1', $password) !== $user->password) {
            throw ValidationException::withMessages([
                'password' => [__('Email немеме құпия сөз қате')]
            ]);
        }
        Auth::guard($this->guard)->login($user);
        return redirect()->route('admin.index');
    }

    public function logout()
    {
        $user_id = auth()->guard('web')->id();
        Auth::guard($this->guard)->logout();
        return redirect()->route('adminLoginShow');
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ]);
    }
}
