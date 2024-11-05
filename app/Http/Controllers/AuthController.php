<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

use App\Http\Requests\RegisterRequest;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request) {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
    
                return response([
                    'message' => "Successfully Login!",
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }
        } catch (QueryException $exception) {
            return response([
                'message' => 'Database error occurred'
            ], 500);
        } catch (AuthenticationException $exception) {
            return response([
                'message' => 'Authentication failed'
            ], 401);
        }
    
        return response([
            'message' => "Invalid email or password",
        ], 401);
    }//end method

    public function Register(RegisterRequest $request){
        try {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('app')->accessToken;

            return response([
                'message' => "Registration Successful.",
                'token' => $token,
                'user' => $user,
            ],200);
            
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        } 
        
    } //end method

}
