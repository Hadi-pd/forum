<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register New User
     * @method POST
     * @param Request $request
     **/
    public function register(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'name' => ['required'],
            'email'=> ['required', 'email', 'unique:users'],
            'password' =>['required']
        ]);

        // Insert User Into Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => "user created successfully"
        ],201);
    }

    /**
     * Login User
     * @method GET
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationExeption
     **/
    public function login(Request $request)
    {
        $request->validate([
            'email'=> ['required', 'email'],
            'password' =>['required']
        ]);
        // Check User Credentials For Login
        if(Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),200);
        }
        throw ValidationException::withMessages([
            'email' => 'incorrect credentials.'
        ]);
    }
    public function logout()
    {
        
    }
}
