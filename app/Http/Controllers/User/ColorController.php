<?php

namespace App\Http\Controllers\User;

use App\Models\Color;
use App\Repositories\ColorRepository;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    private ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function Colors()
    {
        $colors = $this->colorRepository->colors();
        return view('admin.color.all-color', compact('colors'));
    }

    public function ColorToggleStatus(Request $request)
    {
        $colorStatus = $this->colorRepository->ColorToggleStatus($request->id);
        return response()->json(['status' => $colorStatus]);
    }

    public function ColorSearch(Request $request)
    {
        $query = $request->input('query');
        $colors = $this->colorRepository->ColorSearch($query);
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
        $this->colorRepository->storeColor($request->only(['color_name', 'status']));
        $notification = array(
            'message' => 'Color Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditColor($id)
    {
        $color = $this->colorRepository->editColor($id);
        return view('admin.color.edit-color',compact('color'));
    }

    public function UpdateColor(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|unique:colors,color_name,' . $request->id,
        ]);
        $this->colorRepository->UpdateColor($request->id,$request->only(['color_name', 'status']));
        $notification = array(
            'message' => 'Color Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('panel.colors')->with($notification);
    }

    public function DeleteColor($id)
    {
        $result = $this->colorRepository->DeleteColor($id);
        $notification = array(
            'message' => $result['message'],
            'alert-type' => $result['status'] ? 'success' : 'error',
        );
        return redirect()->back()->with($notification);
    }

}
