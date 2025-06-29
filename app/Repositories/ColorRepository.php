<?php

namespace App\Repositories;

use App\Interfaces\ColorInterface;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorRepository implements ColorInterface
{

    public function colors()
    {
        return Color::all();
    }

    public function ColorToggleStatus($id)
    {
        $color = Color::findOrFail($id);
        $color->status = $color->status === 'active' ? 'inactive' : 'active';
        $color->save();
        return $color->status;
    }

    public function ColorSearch($query)
    {
        return Color::where('color_name', 'LIKE', "%{$query}%")->get();
    }

    public function StoreColor(array $data)
    {
        return Color::create([
            'color_name' => $data['color_name'],
            'status' => $data['status'],
        ]);
    }

    public function EditColor($id)
    {
        return Color::findOrFail($id);
    }

    public function UpdateColor(int $id, array $data)
    {
        $color = Color::findOrFail($id);
        $color->update([
            'color_name' => $data['color_name'],
            'status' => $data['status'],
        ]);
    }

    public function DeleteColor($id)
    {
        $color = Color::findOrFail($id);
        if ($color->variants()->exists()){
            return [
                'status' => false,
                'message' => 'This Color Is Being Used By Variants.',
            ];
        }
        $color->delete();
        return [
            'status' => true,
            'message' => 'Color Deleted Successfully.',
        ];
    }
}
