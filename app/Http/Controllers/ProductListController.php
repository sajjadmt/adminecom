<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use App\Models\Remark;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remarkId = Remark::where('title',$request->remark)->first()->id;
        $productList = ProductList::where('product_id',$remarkId)->limit(6)->get();
        return $productList;
    }
}
