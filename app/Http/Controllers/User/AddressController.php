<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use function Sodium\add;

class AddressController extends Controller
{
    public function StoreAddress(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'mobile' => 'required|string',
            'recipient_name' => 'nullable|string',
            'no' => 'nullable|string',
        ]);

        Address::create([
            'user_id' => $request->user_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'no' => $request->no,
            'mobile' => $request->mobile,
            'recipient_name' => $request->recipient_name,
        ]);

        $notification = array(
            'message' => 'Address Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteAddress($id)
    {
        $address = Address::findOrFail($id);
        if ($address){
            $address->delete();
            $notification = array(
                'message' => 'Address Deleted Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
