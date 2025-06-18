<?php

namespace App\Repositories;

use App\Interfaces\SliderInterface;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderRepository implements SliderInterface
{


    public function AllSlider()
    {
        return Slider::all();
    }

    public function Sliders()
    {
        return Slider::latest()->get();
    }

    public function StoreSlider(Request $request)
    {
        $sliderCount = Slider::count();
        if ($sliderCount >= 8) {
            return [
                'status' => false,
                'message' => 'We can not have more than 8 sliders',
            ];
        }
        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Slider::create([
                'slider_image' => 'http://127.0.0.1:8000/upload/images/sliders/' . $fileName,
            ]);
            Image::make($file)->resize(1500, 568)->save('upload/images/sliders/' . $fileName);
            return [
                'status' => true,
                'message' => 'Slider Created Successfully',
            ];
        }
        return [
            'status' => false,
            'message' => 'No image provided',
        ];
    }

    public function EditSlider($id)
    {
        return Slider::findOrFail($id);
    }

    public function UpdateSlider(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $oldImageName = basename($slider->slider_image);
            @unlink('upload/images/sliders/' . $oldImageName);
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(1500, 568)->save('upload/images/sliders/' . $fileName);
            $slider->slider_image = 'http://127.0.0.1:8000/upload/images/sliders/' . $fileName;
            $slider->save();
            return [
                'status' => true,
                'message' => 'Slider Created Successfully',
            ];
        }
        return [
            'status' => false,
            'message' => 'Something Wrong',
        ];
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $sliderCount = Slider::count();
        if ($sliderCount < 3) {
            return [
                'status' => false,
                'message' => 'There must be at least TWO slider and can not be deleted.',
            ];
        }
        $slider->delete();
        $sliderImageName = basename($slider->slider_image);
        @unlink('upload/images/sliders/' . $sliderImageName);
        return [
            'status' => true,
            'message' => 'Slider Deleted Successfully.',
        ];
    }
}
