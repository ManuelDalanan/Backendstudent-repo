<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Auth;

class AuthController extends Controller
{

    public function login(Request $request, string $subsystem) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            
            $user = Auth::user();
    
            if ($user) {
                $token = $user->createToken('token-name')->plainTextToken;
                $responseData = [
                    'token' => $token,
                    'id' => $user->id,
                    'department' => $user->department,
                    'role' => $user->role
                ];
    
                if ($user->role == 'superadmin' && $subsystem == 'maintenance') {
                    return response()->json($responseData, 200);
                } elseif (in_array($user->role, ['superadmin', 'admin']) && in_array($subsystem, ['cataloging', 'circulation'])) {
                    return response()->json($responseData, 200);
                } elseif (in_array($user->role, ['user']) && in_array($subsystem, ['student'])) {
                    return response()->json($responseData, 200);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request) {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['Status' => 'Logged out successfully'], 200);
        } catch(Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
