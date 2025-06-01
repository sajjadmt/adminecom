<?php

namespace App\Http\Controllers\User;

use App\Models\Attribute;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function Attributes()
    {
        $attributes = Attribute::with('specification')->get();
        return view('admin.attribute.all-attribute',compact('attributes'));
    }

    public function AttributeToggleStatus(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);
        $attribute->status = $attribute->status === 'active' ? 'inactive' : 'active';
        $attribute->save();
        return response()->json(['status' => $attribute->status]);
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::findOrFail($id);
        if ($attribute->specification()->exists()){
            $notification = array(
                'message' => 'This Attribute Is Being Used By Specification.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $attribute->delete();
        $notification = array(
            'message' => 'Attribute Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function CreateAttribute($id)
    {
        $specification = Specification::where('id',$id)->first();
        return view('admin.attribute.create-attribute',compact('specification'));
    }

    public function StoreAttribute(Request $request)
    {
        $attribute = Attribute::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'specification_id' => $request->id,
            'status' => $request->status,
        ]);
        if ($attribute){
            $notification = array(
                'message' => 'Attribute Created Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function AttributeSearch(Request $request)
    {
        $query = $request->input('query');
        $attributes = Attribute::where('title', 'like', "%{$query}%")->get();
        return view('admin.attribute.attribute-table-body', compact('attributes'));
    }

    public function EditAttribute($id)
    {
        $attribute = Attribute::findOrFail($id);
        $specifications = Specification::all();
        return view('admin.attribute.edit-attribute',compact('attribute','specifications'));
    }

    public function UpdateAttribute(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);
        if ($attribute){
            $attribute->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'specification_id' => $request->specification_id,
                'status' => $request->status,
            ]);
        }
        $notification = array(
            'message' => 'Attribute Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
