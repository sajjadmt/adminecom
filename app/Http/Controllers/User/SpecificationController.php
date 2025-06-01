<?php

namespace App\Http\Controllers\User;

use App\Models\Attribute;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecificationController extends Controller
{
    public function Specifications()
    {
        $specifications = Specification::all();
        return view('admin.specification.all-specification',compact('specifications'));
    }

    public function SpecificationToggleStatus(Request $request)
    {
        $specification = Specification::findOrFail($request->id);
        $specification->status = $specification->status === 'active' ? 'inactive' : 'active';
        $specification->save();
        return response()->json(['status' => $specification->status]);
    }

    public function CreateSpecification()
    {
        return view('admin.specification.create-specification');
    }

    public function StoreSpecification(Request $request)
    {
        Specification::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Specification Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditSpecification($id)
    {
        $specification = Specification::findOrFail($id);
        return view('admin.specification.edit-specification',compact('specification'));
    }

    public function UpdateSpecification(Request $request)
    {
        $specification = Specification::findOrFail($request->id);
        if ($specification){
            $specification->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
            ]);
        }
        $notification = array(
            'message' => 'Specification Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('panel.specifications')->with($notification);
    }

    public function SpecificationSearch(Request $request)
    {
        $query = $request->input('query');
        $specifications = Specification::where('title', 'like', "%{$query}%")->get();
        return view('admin.specification.specification-table-body', compact('specifications'));
    }

    public function SpecificationAttributes($id)
    {
        $attributes = Attribute::where('specification_id',$id)->with('specification')->get();
        return $attributes;
    }

    public function DeleteSpecification($id)
    {
        $specification = Specification::findOrFail($id);
        if ($specification->products()->exists()){
            $notification = array(
                'message' => 'This Specification Is Being Used By Products.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $specification->delete();
        $notification = array(
            'message' => 'Specification Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
