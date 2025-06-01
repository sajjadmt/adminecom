<?php

namespace App\Http\Controllers\User;

use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{

    public function CreateVariant($id)
    {
        $product = Product::where('id',$id)->with('images')->first();
        $colors = Color::all();
        $sizes = Size::all();
        $materials = Material::all();
        return view('admin.variant.create-variant',compact(['product','colors','sizes','materials']));
    }

    public function StoreVariant(Request $request)
    {
        Variant::create([
            'product_id' => $request->id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'material_id' => $request->material_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'star' => $request->star,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Variant Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function DeleteVariant($id)
    {
        $variant = Variant::findOrFail($id);
        $variant->delete();
        $notification = array(
            'message' => 'Variant Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditVariant($id)
    {
        $variant = Variant::where('id',$id)->with('product.images')->first();
        $colors = Color::all();
        $sizes = Size::all();
        $materials = Material::all();
        return view('admin.variant.edit-variant',compact(['variant','colors','sizes','materials']));
    }

    public function UpdateVariant(Request $request)
    {
        $variant = Variant::findOrFail($request->id);
        if ($variant){
            $variant->update([
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'material_id' => $request->material_id,
                'price' => $request->price,
                'discount' => $request->discount,
                'stock' => $request->stock,
                'star' => $request->star,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Variant Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.products')->with($notification);
        }
    }
}
