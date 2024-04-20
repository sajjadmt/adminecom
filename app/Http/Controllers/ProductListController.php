<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductList;
use App\Models\Remark;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remarkId = Remark::where('title',$request->remark)->first()->id;
        $productList = ProductList::where('remark_id',$remarkId)->limit(6)->get();
        return $productList;
    }
    public function ProductListByCategory(Request $request)
    {
        $categoryId = Category::where('category_name',$request->category)->first()->id;
        $productList = ProductList::where('category_id',$categoryId)->get();
        return $productList;
    }
}
