<?php

namespace App\Http\Controllers\User;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    public function Sizes()
    {
        $sizes = Size::all();
        return view('admin.size.all-size', compact('sizes'));
    }

    public function SizeToggleStatus(Request $request)
    {
        $size = Size::findOrFail($request->id);
        $size->status = $size->status === 'active' ? 'inactive' : 'active';
        $size->save();
        return response()->json(['status' => $size->status]);
    }

    public function SizeSearch(Request $request)
    {
        $query = $request->input('query');
        $sizes = Size::where('size', 'LIKE', "%{$query}%")->get();
        return view('admin.size.size-table-body', compact('sizes'));
    }

    public function CreateSize()
    {
        return view('admin.size.create-size');
    }

    public function StoreSize(Request $request)
    {
        $request->validate([
            'size' => 'required|string|unique:sizes,size,' . $request->id,
        ]);
        Size::create([
            'size' => $request->size,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Size Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditSize($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size.edit-size',compact('size'));
    }

    public function UpdateSize(Request $request)
    {
        $request->validate([
            'size' => 'required|string|unique:sizes,size,' . $request->id,
        ]);
        $size = Size::findOrFail($request->id);
        if ($size){
            $size->update([
                'size' => $request->size,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Size Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.sizes')->with($notification);
        }
    }

    public function DeleteSize($id)
    {
        $size = Size::findOrFail($id);
        if ($size->variants()->withTrashed()->exists()){
            $notification = array(
                'message' => 'This Size Is Being Used By Variants.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $size->delete();
        $notification = array(
            'message' => 'Size Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
