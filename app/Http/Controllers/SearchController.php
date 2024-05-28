<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function SearchByProduct(Request $request)
    {
        $key = $request->key;
        return ProductList::where('title', 'LIKE', "%{$key}%")->get();
    }
}
