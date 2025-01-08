<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use App\Services\UserServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        $user = auth()->user();

        return Inertia::render('Admin/User/Profile', [
            'user' => $user,
        ]);
    }

    public function sendVerificationCode(Request $request)
    {
        $method = $request->method;
        $user_id = $request->user_id;
        VerificationCode::where('user_id', $user_id)
            ->whereDate('expires_at', '<', Carbon::now())->delete();
        $codeExist = VerificationCode::where('user_id', $user_id)
            ->where('expires_at', '>', Carbon::now())->first();

        if (!$codeExist) {
            $code = rand(100000, 999999);

            $verificationCode = VerificationCode::create([
                'user_id' => $user_id,
                'method' => $method,
                'code' => Hash::make($code),
                'expires_at' => Carbon::now()->addMinutes(1),
            ]);
            $timer = $verificationCode->expires_at > Carbon::now()
                ? $verificationCode->expires_at->diffInSeconds(Carbon::now())
                : 0;
            return response()->json([
                'message' => 'Код отправлен',
                'code' => $code,
                'timer' => $timer,
            ]);
        } else {
            $timer = $codeExist->expires_at > Carbon::now()
                ? $codeExist->expires_at->diffInSeconds(Carbon::now())
                : 0;
            return response()->json([
                'message' => 'Код уже отправлен',
                'timer' => $timer,
            ]);
        }
    }

    public function verify(Request $request)
    {
        $code = $request->code;
        $verification = VerificationCode::where('user_id', $request->user['id'])
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if ($verification && Hash::check($code, $verification->code)) {
            $data = $request->user;
            $this->userService->updateUser($request->user['id'], $data);
            $verification->delete();
            return response()->json(['status' => 200]);
        }

        $timer = $verification->expires_at > Carbon::now()
            ? $verification->expires_at->diffInSeconds(Carbon::now())
            : 0;
        return response()->json([
            'timer' => $timer,
            'status' => 400,
        ]);
    }
}
