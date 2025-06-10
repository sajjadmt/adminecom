<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;

class UserController
{
    public function Users()
    {
        $users = User::where('id', '!=', auth()->id())
            ->where('role', '!=', 'admin')
            ->get();
        return view('admin.user.all-user', compact('users'));
    }

    public function UserToggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        return response()->json(['status' => $user->status]);
    }

    public function UserSearch(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        return view('admin.user.user-table-body', compact('users'));
    }

    public function CreateUser()
    {
        return view('admin.user.create-user');
    }

    public function StoreUser(UserCreateRequest $request)
    {
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(400, 400)->save('upload/images/avatars/' . $fileName);
        } else {
            $fileName = 'none.jpg';
        }
        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => 'upload/images/avatars/' . $fileName,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'User Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditUser($id)
    {
        $user = User::where('id',$id)->with('addresses')->first();
        $stateResponse = Http::get('https://iranplacesapi.liara.run/api/provinces');
        $cityResponse = Http::get('https://iranplacesapi.liara.run/api/cities');
        $states = $stateResponse->successful() ? $stateResponse->json() : [];
        $cities = $cityResponse->successful() ? $cityResponse->json() : [];
        return view('admin.user.edit-user', compact('user', 'states','cities'));
    }

    public function UpdateUser(UserUpdateRequest $request)
    {
        $user = User::findOrFail($request->id);
        if ($request->hasFile('profile_photo_path')) {
            $oldImageName = basename($user->profile_photo_path);
            if ($user->profile_photo_path !== 'none.jpg') {
                @unlink('upload/images/avatars/' . $oldImageName);
            }

            $file = $request->file('profile_photo_path');
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(400, 400)->save('upload/images/avatars/' . $fileName);
            $user->profile_photo_path = 'upload/images/avatars/' . $fileName;
        }

        $user->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $user->profile_photo_path,
            'status' => $request->status,
        ]);
        if ($request->has('addresses')) {
            foreach ($request->addresses as $addressData) {
                if (isset($addressData['id'])) {
                    $address = Address::find($addressData['id']);
                    if ($address && $address->user_id == $user->id) {
                        $address->update([
                            'address' => $addressData['address'],
                            'state_id' => $addressData['state_id'],
                            'city_id' => $addressData['city_id'],
                            'postal_code' => $addressData['postal_code'],
                            'no' => $addressData['no'],
                            'mobile' => $addressData['mobile'],
                            'recipient_name' => $addressData['recipient_name'],
                        ]);
                    }
                }
            }
        }
        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('panel.users')->with($notification);
    }

    public function DeleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            $userAvatar = basename($user->profile_photo_path);
            @unlink('upload/images/avatars/' . $userAvatar);
            $notification = array(
                'message' => 'User Deleted Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'Something Wrong.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function ChangeUserPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:6'
        ]);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = array(
            'message' => 'Password Updated Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
