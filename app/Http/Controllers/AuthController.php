<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                "email" => ["required", "email"],
                "password" => ["required", "min:8"],
            ]);

            $user = User::where("email", $data["email"])->first();

            if (!$user) {
                return response()->json(['message' => 'User email not found. Please register.'], 404);
            }

            if (!Hash::check($data['password'], $user->password)) {
                return response()->json(['message' => 'Password is incorrect.'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User is successfully logged in',
                'token' => $token,
                'user' => $user
            ]);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function register(Request $request)
    {
        // try {
        //     $data = $request->validate([]);

        //     $exists = User::where('email', $data['email'])->first();

        //     if ($exists) {
        //         return response()->json(["message" => "User account for " . $data['email'] . " already exists. Please login."], 400);
        //     }

        //     $user = User::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => Hash::make($data['password']),
        //     ]);

        //     $user->cart()->create();

        //     return response()->json([
        //         'message' => 'User registered successfully',
        //         'user' => $user
        //     ], 201);

        // } catch (\Throwable $th) {
        //     return response()->json(['error' => $th->getMessage()], 400);
        // }

        return response()->json($request->all());
    }
}
