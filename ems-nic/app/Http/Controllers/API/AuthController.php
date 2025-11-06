<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        return response()->json([
            'status_code' => 201,
            'status' => 'Successful',
            'message' => 'registered successful.',
            'data' => [
                'user' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                ],
            ]
        ], 200);
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $employee = User::where('email', $request->email)->first();

        if (! $employee || ! Hash::check($request->password, $employee->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $token = $employee->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Login successful.',
            'data' => [
                'user' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();



        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Logout successful.',
        ], 200);
    }
}
