<?php

namespace App\Http\Controllers\User;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function Colors()
    {
        $colors = Color::all();
        return view('admin.color.all-color', compact('colors'));
    }

    public function ColorToggleStatus(Request $request)
    {
        $color = Color::findOrFail($request->id);
        $color->status = $color->status === 'active' ? 'inactive' : 'active';
        $color->save();
        return response()->json(['status' => $color->status]);
    }

    public function ColorSearch(Request $request)
    {
        $query = $request->input('query');
        $colors = Color::where('color_name', 'LIKE',"%{$query}%")->get();
        return view('admin.color.color-table-body', compact('colors'));
    }

    public function CreateColor()
    {
        return view('admin.color.create-color');
    }

    public function StoreColor(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|unique:colors',
        ]);
        Color::create([
            'color_name' => $request->color_name,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Color Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditColor($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.color.edit-color',compact('color'));
    }

    public function UpdateColor(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|unique:colors,color_name,' . $request->id,
        ]);
        $color = Color::findOrFail($request->id);
        if ($color){
            $color->update([
                'color_name' => $request->color_name,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Color Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.colors')->with($notification);
        }
    }

    public function DeleteColor($id)
    {
        $color = Color::findOrFail($id);
        if ($color->variants()->exists()){
            $notification = array(
                'message' => 'This Color Is Being Used By Variants.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $color->delete();
        $notification = array(
            'message' => 'Color Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
