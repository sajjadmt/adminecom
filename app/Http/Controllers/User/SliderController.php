<?php

namespace App\Http\Controllers\User;

use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{

    private SliderRepository $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {

        $this->sliderRepository = $sliderRepository;
    }

    public function AllSlider()
    {
        $sliders = $this->sliderRepository->AllSlider();
        return $sliders;
    }

    public function Sliders()
    {
        $sliders = $this->sliderRepository->Sliders();
        return view('admin.slider.all-slider', compact('sliders'));
    }

    public function CreateSlider()
    {
        return view('admin.slider.create-slider');
    }

    public function StoreSlider(Request $request)
    {
        $result = $this->sliderRepository->StoreSlider($request);
        $notification = array(
            'message' => $result['message'],
            'alert-type' => $result['status'] ? 'success' : 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function EditSlider($id)
    {
        $slider = $this->sliderRepository->EditSlider($id);
        return view('admin.slider.edit-slider', compact('slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $result = $this->sliderRepository->UpdateSlider($request);
        $notification = array(
            'message' => $result['message'],
            'alert-type' => $result['status'] ? 'success' : 'error',
        );
        return redirect()->route('panel.sliders')->with($notification);
    }

    public function DeleteSlider($id)
    {
        $result = $this->sliderRepository->DeleteSlider($id);
        $notification = array(
            'message' => $result['message'],
            'alert-type' => $result['status'] ? 'success' : 'error',
        );
        return redirect()->back()->with($notification);
    }

}
