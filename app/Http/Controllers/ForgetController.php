<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

use App\Http\Requests\ForgetRequest;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ForgetMail;

class ForgetController extends Controller
{
    public function ForgetPassword(ForgetRequest $request)  {
        $email = $request->email;

        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => "Email Invalid."
            ],401);
        }

        // generate random token

        $token = rand(10, 100000);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            // Mail sent to the user
            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message' => "Reset Password mail sent on your email"
            ], 200);



        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        } 

    }// end method
}
