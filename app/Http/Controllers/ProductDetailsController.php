<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductDetails;
use App\Models\ProductList;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function ProductDetails(Request $request)
    {
        $productDetails = ProductDetails::find($request->id);
        $product = ProductList::find($request->id);
        $category = Category::find($product->category_id)->only('category_name');
        $subCategory = SubCategory::find($product->sub_category_id)->only('sub_category_name');
        return [
            'Details' => $productDetails,
            'Product' => $product,
            'Category' => $category,
            'SubCategory' => $subCategory,
        ];
    }
}
