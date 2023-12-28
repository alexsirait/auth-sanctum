<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Buat token untuk user
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request) {
        // Validasi request
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil login, kembalikan token
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request) {
        // Revoke token untuk logout
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function list() {
        $data = DB::table('users')->get();
        return response()->json($data);
    }
}
