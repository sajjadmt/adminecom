<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface SliderInterface
{
    public function AllSlider();

    public function Sliders();

    public function StoreSlider(Request $request);

    public function EditSlider($id);

    public function UpdateSlider(Request $request);

    public function DeleteSlider($id);
}
