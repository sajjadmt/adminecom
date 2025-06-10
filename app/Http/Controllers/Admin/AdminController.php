<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserProfileChangePasswordRequest;
use App\Http\Requests\Admin\UserProfileStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController
{
    public function UserLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function UserProfile()
    {
        return view('admin.profile.profile');
    }

    public function UserProfileStore(UserProfileStoreRequest $request)
    {
        $user = Auth::user();
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $oldImageName = basename($user->profile_photo_path);
            if ($user->profile_photo_path !== 'none.jpg'){
                @unlink('upload/images/avatars/' . $oldImageName);
            }
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/images/avatars'), $fileName);
            $user->profile_photo_path = '/upload/images/avatars/' . $fileName;
        }
        $user->name = $request->name;
        $user->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('user.profile')->with($notification);
    }

    public function UserProfileChangePassword()
    {
        return view('admin.profile.change_password');
    }

    public function UserProfileUpdatePassword(UserProfileChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('user.profile')->with($notification);
    }

}
