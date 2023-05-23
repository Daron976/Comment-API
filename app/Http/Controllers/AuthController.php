<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function signup(Request $request) {
        $params = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['password'])
        ]);

        $authToken = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'toeknk' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $params = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $params['email'])->first();

        if(!user || !Hash::check($params['password'], $user->password)) {
            return response([
                'message' => 'User does not exist'
            ], 404);
        }

        $authToken = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'toeknk' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'User successfully logged out'
        ];
    }
}
