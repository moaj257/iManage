<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller {
    use ApiResponser;

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->send('Wrong Credentials!', [], 401);
        }

        $user = User::where('email', '=', $credentials['email'])->first();
        $token = $user->createToken('access-token', ['server:update'])->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $this->send('User Logged In', $data, 200);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return $this->send('User Logged Out');
    }
}