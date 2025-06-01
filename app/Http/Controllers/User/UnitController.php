<?php

namespace App\Http\Controllers\User;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpseclib3\System\SSH\Agent\Identity;

class UnitController extends Controller
{
    public function Units()
    {
        $units = Unit::all();
        return view('admin.unit.all-unit', compact('units'));
    }

    public function UnitToggleStatus(Request $request)
    {
        $unit = Unit::findOrFail($request->id);
        $unit->status = $unit->status === 'active' ? 'inactive' : 'active';
        $unit->save();
        return response()->json(['status' => $unit->status]);
    }

    public function UnitSearch(Request $request)
    {
        $query = $request->input('query');
        $units = Unit::where('title', 'LIKE', "%{$query}%")->get();
        return view('admin.unit.unit-table-body', compact('units'));
    }

    public function CreateUnit()
    {
        return view('admin.unit.create-unit');
    }

    public function StoreUnit(Request $request)
    {
        Unit::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Unit Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function EditUnit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.unit.edit-unit',compact('unit'));
    }

    public function UpdateUnit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:units,title,' . $request->id,
        ]);
        $unit = Unit::findOrFail($request->id);
        if ($unit){
            $unit->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Unit Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.units')->with($notification);
        }
    }

    public function DeleteUnit($id)
    {
        $unit = Unit::findOrFail($id);
        if ($unit->values()->withTrashed()->exists()){
            $notification = array(
                'message' => 'This Unit Is Being Used By Values.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $unit->delete();
        $notification = array(
            'message' => 'Unit Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
