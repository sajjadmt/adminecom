<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function Brands()
    {
        $brands = Brand::all();
        return view('admin.brand.all-brand', compact('brands'));
    }

    public function BrandToggleStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $brand->status === 'active' ? 'inactive' : 'active';
        $brand->save();
        return response()->json(['status' => $brand->status]);
    }

    public function CreateBrand()
    {
        return view('admin.brand.create-brand');
    }

    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|unique:brands',
        ]);
        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_slug' => Str::slug($request->brand_name),
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Brand Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit-brand',compact('brand'));
    }

    public function UpdateBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|unique:brands,brand_name,' . $request->id,
        ]);
        $brand = Brand::findOrFail($request->id);
        if ($brand){
            $brand->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => Str::slug($request->brand_name),
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.brands')->with($notification);
        }
    }

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->products()->exists()){
            $notification = array(
                'message' => 'This Brand Is Being Used By Products.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $brand->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
