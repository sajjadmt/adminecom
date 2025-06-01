<?php

namespace App\Http\Controllers\User;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function Materials()
    {
        $materials = Material::all();
        return view('admin.material.all-material', compact('materials'));
    }

    public function MaterialToggleStatus(Request $request)
    {
        $material = Material::findOrFail($request->id);
        $material->status = $material->status === 'active' ? 'inactive' : 'active';
        $material->save();
        return response()->json(['status' => $material->status]);
    }

    public function MaterialSearch(Request $request)
    {
        $query = $request->input('query');
        $materials = Material::where('title', 'LIKE', "%{$query}%")->get();
        return view('admin.material.material-table-body', compact('materials'));
    }

    public function CreateMaterial()
    {
        return view('admin.material.create-material');
    }

    public function StoreMaterial(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:materials,title,' . $request->id,
        ]);
        Material::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Material Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditMaterial($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.material.edit-material',compact('material'));
    }

    public function UpdateMaterial(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:materials,title,' . $request->id,
        ]);
        $material = Material::findOrFail($request->id);
        if ($material){
            $material->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Material Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.materials')->with($notification);
        }
    }

    public function DeleteMaterial($id)
    {
        $material = Material::findOrFail($id);
        if ($material->variants()->withTrashed()->exists()){
            $notification = array(
                'message' => 'This Material Is Being Used By Variants.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $material->delete();
        $notification = array(
            'message' => 'Material Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
