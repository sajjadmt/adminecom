<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ChangeAddressRequest;
use App\Http\Requests\ChangeNameRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function Login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->plainTextToken;
                return response([
                    'message' => 'Successfully Login',
                    'user' => $user,
                    'token' => $token
                ],200);
            }
        } catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],400);
        }
        return response([
            'message' => 'Invalid Email Or Password'
        ],401);
    }

    public function Register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo_path' => 'http://127.0.0.1:8000/upload/images/avatars/none.jpg',
            ]);
            $token = $user->createToken('app')->plainTextToken;
            return response([
                'message' => 'User Registered Successfully',
                'user' => $user,
                'token' => $token,
            ],200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ]);
        }
        return response([
            'message' => 'Something Wrong'
        ],401);
    }

    public function ForgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->email;
        if (User::where('email',$email)->doesntExist()){
            return response([
                'message' => 'Email Not Found'
            ],401);
        }
        $token = rand(100000,999999);
        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token
            ]);
            Mail::to($email)->send(new ResetPasswordMail($token));
            return response([
                'message' => 'Reset Link Send Successfully To Your Email'
            ],200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],401);
        }
    }

    public function ResetPassword(ResetPasswordRequest $request)
    {
        $mailCheck = DB::table('password_reset_tokens')->where('email',$request->email)->first();
        $tokenCheck = DB::table('password_reset_tokens')->where('token',$request->pinCode)->first();
        if (!$mailCheck){
            return response([
                'message' => 'Email Not Found'
            ],401);
        }
        if (!$tokenCheck){
            return response([
                'message' => 'Invalid Pin Code'
            ],401);
        }
        User::where('email',$request->email)->update([
            'password' => Hash::make($request->password),
        ]);
        DB::table('password_reset_tokens')->where('email',$request->email)->delete();
        return response([
            'message' => 'Password Reset Successfully'
        ],200);
    }

    public function GetUser()
    {
        $user = Auth::user()->load('addresses');
        return $user;
    }

    public function ChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        try {
            if (Hash::check($request->old_password,$user->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return response([
                    'message' => 'Password Successfully Updated'
                ],200);
            } else {
                return response([
                    'message' => 'Invalid Old Password'
                ],401);
            }
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],401);
        }
        return response([
            'message' => 'Something Wrong'
        ],401);
    }

    public function ChangeName(ChangeNameRequest $request)
    {
        $user = Auth::user();
        try {
            $user->update([
                'name' => $request->name
            ]);
            return response([
                'message' => 'Your Name Successfully Updated',
                'name' => $request->name,
            ],200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],401);
        }
    }

    public function ChangeAddress(ChangeAddressRequest $request)
    {
        $user = Auth::user();
        try {
            $address = $user->addresses()->where('id',$request->address_id)->first();
            if (!$address) {
                return response([
                    'message' => 'Address Not Found'
                ], 404);
            }
            $address->update([
                'address' => $request->address
            ]);
            return response([
                'message' => 'Address Successfully Updated',
            ], 200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],401);
        }
    }

}
