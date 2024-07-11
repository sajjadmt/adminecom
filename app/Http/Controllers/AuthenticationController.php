<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;
use Mockery\Exception;

class AuthenticationController extends Controller
{
    public function Login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->plainTextToken;
                return response([
                    'message' => 'Login Successfully',
                    'user' => $user,
                    'token' => $token
                ]);
            }
        }catch (Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
        return response([
            'message' => 'Invalid Email Or Password'
        ],401);
    }

    public function Register(RegisterRequest $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $password = Hash::make($request->password);
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            $token = $user->createToken('app')->plainTextToken;
            return response([
                'message' => 'Registeration Successfully',
                'user' => $user,
                'token' => $token
            ],200);
        }catch (Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    public function ForgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->email;
        if (User::where('email',$email)->doesntExist()){
            return response([
                'message' => 'Email Does Not Exist'
            ],401);
        }
        $token = rand(100000,999999);
        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
            ]);
            Mail::to($email)->send(new ResetPasswordMail($token));
            return response([
                'message' => 'Reset Password Mail Successfully Send'
            ],200);
        }catch (\Exception $e){
            return response([
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function ResetPassword(ResetPasswordRequest $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);
        $mailCheck = DB::table('password_reset_tokens')->where('email',$email)->first();
        $tokenCheck = DB::table('password_reset_tokens')->where('token',$token)->first();
        if (!$mailCheck){
            return response([
                'message' => 'Email Not Found'
            ],401);
        }
        if (!$tokenCheck){
            return response([
                'message' => 'Wrong Pin Code'
            ],401);
        }
        User::where('email',$email)->update([
            'password' => $password
        ]);
        DB::table('password_reset_tokens')->where('email',$email)->delete();
        return response([
            'message' => 'Password Change Successfully'
        ],200);
    }

    public function GetUser()
    {
        return Auth::user();
    }
}
