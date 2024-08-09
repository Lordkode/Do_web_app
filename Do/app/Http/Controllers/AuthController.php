<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;


class AuthController extends Controller
{

    public function register(Request $request)
    {




        $startDate = now();
        $endDate = $request->birthdate;

        $diff = $startDate->diffInYears($endDate);
        $diff = abs($diff);


        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($diff >= 13 and $diff <= 35) {
            $user = User::create([
                'username' => $request->username,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'isAdmin' => false,
                'password' => Hash::make($request->string('password')),
            ]);
        } else return response()->json([
            'errors' => [
                'birthdate' => ['You are not allow to register']
            ]
        ], 422);


        $token = $user->createToken($request->username);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ], 422);
        }

        $token = $user->createToken($user->username);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.'
        ];
    }

}
