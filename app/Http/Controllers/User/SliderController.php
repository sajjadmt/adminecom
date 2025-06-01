<?php

namespace App\Http\Controllers\User;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::all();
        return $sliders;
    }

    public function Sliders()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.all-slider', compact('sliders'));
    }

    public function CreateSlider()
    {
        return view('admin.slider.create-slider');
    }

    public function StoreSlider(Request $request)
    {
        $sliderCount = Slider::count();
        if (($sliderCount < 8) && ($request->hasFile('slider_image'))) {
            $file = $request->file('slider_image');
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Slider::create([
                'slider_image' => 'http://127.0.0.1:8000/upload/images/sliders/' . $fileName,
            ]);
            Image::make($file)->resize(1500, 568)->save('upload/images/sliders/' . $fileName);
            $notification = array(
                'message' => 'Slider Created Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'We can not have more than 8 sliders',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit-slider', compact('slider'));
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
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.sliders')->with($notification);
        }
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $sliderCount = Slider::count();
        if ($sliderCount > 2) {
            $slider->delete();
            $sliderImageName = basename($slider->slider_image);
            @unlink('upload/images/sliders/' . $sliderImageName);
            $notification = array(
                'message' => 'Slider Deleted Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'There must be at least TWO slider and can not be deleted.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

}
