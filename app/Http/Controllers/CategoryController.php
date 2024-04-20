<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategoryDetails()
    {
        $categories = Category::all();
        $categoryDetailsArray = [];
        foreach ($categories as $category) {
            $subCategory = $category->subCategories;
            $items = [
                'category_name' => $category['category_name'],
                'category_image' => $category['category_image'],
                'sub_category_name' => $subCategory,
            ];
            array_push($categoryDetailsArray,$items);
        }
        return $categoryDetailsArray;
    }
}
