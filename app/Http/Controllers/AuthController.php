<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;

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
                return response()->json(['message' => 'User email not found please register.'], 404);
            }

            if (!Hash::check($data['password'], $user->password)) {
                return response()->json(['message' => 'Password is incorrect.'], 0);
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
        try {
            $data = $request->validate([
                "email" => ['required', 'email'],
                'password' => ['required', 'min:8'],
                'name' => ['required'],
            ]);

            $exists = User::where('email', $data['email'])->first();

            if ($exists) {
                return response()->json(["message" => "user account for " . $data['email'] . " already exists please login."], 400);
            }

            $cart = Cart::create();

            $user = User::create([...$data, 'cart_id' => $cart->id]);

            $cart->update(['user_id' => $user->id]);

            return response()->json($user);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

    }
}
