<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = HomeSlider::all();
        return $sliders;
    }
}
