<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {

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

            $user = User::create($data);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

        return response()->json($user);
    }
}
