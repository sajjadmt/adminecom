<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Models\Value;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function ProductByRemark($remark)
    {
        $products = Product::with('images')->where('remark', $remark)->limit(6)->get();
        return $products;
    }

    public function ProductByBrand(Brand $brand)
    {
        $products = Product::with('images')->where('brand_id', $brand->id)->get();
        return $products;
    }

    public function ProductByCategory($categorySlug)
    {
        $category = Category::with('children')->where('category_slug', $categorySlug)->first();
        if ($category) {
            $childrenIds = $category->children->pluck('id')->toArray();
            $products = Product::with('images')->whereIn('category_id', $childrenIds)->get();
            return $products;
        } else {
            return response('Not Found', 404);
        }
    }

    public function ProductBySubCategory($categorySlug, $subCategorySlug)
    {
        $category = Category::where('category_slug', $categorySlug)->first();
        $subCategory = Category::where('parent_id', $category->id)->where('category_slug', $subCategorySlug)->first();
        if ($category && $subCategory) {
            $products = Product::with('images')->where('category_id', $subCategory->id)->get();
            return $products;
        } else {
            return response('Not Found', 404);
        }
    }

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $result = Product::with(['variants.color', 'images'])
            ->where(function ($query) use ($key) {
                $query->where('title', 'LIKE', "%{$key}%")
                    ->orWhere('short_description', 'LIKE', "%{$key}%")
                    ->orWhere('long_description', 'LIKE', "%{$key}%")
                    ->orWhereHas('variants', function ($query) use ($key) {
                        $query->where('price', 'LIKE', "%{$key}%");
                    })
                    ->orWhereHas('variants.color', function ($query) use ($key) {
                        $query->where('color_name', 'LIKE', "%{$key}%");
                    });
            })->get();
        return $result;
    }

    public function ProductDetails($productSlug)
    {
        $product = Product::with(['category', 'images', 'variants.color', 'variants.size', 'specifications.attributes.values.unit'])->where('slug', $productSlug)->first();
        return $product;
    }

    public function getCategoryPath($category)
    {
        $path = [];
        while ($category) {
            array_unshift($path, $category->category_name);
            $category = $category->parent;
        }
        return implode(' > ', $path);
    }

    public function Products()
    {
        $products = Product::with(['category', 'images'])->latest('id')->get();
        return view('admin.product.all-product', compact('products'));
    }

    public function ProductSearch(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with(['category', 'images'])
            ->where('title', 'like', "%{$query}%")
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.product.product-table-body', compact('products'));
    }


    public function ProductDetail($id)
    {
        $detail = Product::with(['images', 'brand', 'category'])->findOrFail($id);
        $category = $detail->category;
        $categoryPath = $this->getCategoryPath($category);
        return response()->json([
            'detail' => $detail,
            'categoryPath' => $categoryPath
        ]);
    }

    public function CreateProduct()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $brands = Brand::all();
        $specifications = Specification::where('status','active')->with('attributes')->get();
        $units = Unit::where('status','active')->get();
        return view('admin.product.create-product',compact('categories','brands','specifications','units'));
    }

    public function StoreProduct(Request $request)
    {
        if ($request->hasFile('images')){
            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'remark' => $request->remark,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ]);
            $file = $request->file('images');
            foreach ($file as $image){
                $imageName = md5(uniqid(microtime(true), true)) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('upload/images/products/' . $imageName);
                $product->images()->create([
                    'url' => 'http://127.0.0.1:8000/upload/images/products/' . $imageName,
                ]);
            }
            $specs = $request->input('specifications');
            foreach ($specs as $specId => $specData) {
                if (!isset($specData['selected']) || $specData['selected'] != 1) {
                    continue;
                }

                $product->specifications()->attach($specId);

                if (isset($specData['attributes'])) {
                    foreach ($specData['attributes'] as $attributeId => $attrData) {
                        if (!isset($attrData['value']) || !isset($attrData['unit_id'])) {
                            continue;
                        }

                        Value::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attributeId,
                            'unit_id' => $attrData['unit_id'],
                            'value' => $attrData['value'],
                            'type' => 'checkbox',
                            'status' => 'active',
                        ]);
                    }
                }
            }
            $notification = array(
                'message' => 'Product Created Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function EditProduct($id)
    {
        $product = Product::where('id',$id)->with(['images','specifications.attributes.values'])->first();
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $brands = Brand::all();
        $specifications = Specification::where('status','active')->with('attributes')->get();
        $units = Unit::where('status','active')->get();
        return view('admin.product.edit-product',compact(['product','categories','brands','specifications','units']));
    }

    public function UpdateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'remark' => $request->remark,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
        ]);
        $product->specifications()->detach();
        Value::where('product_id', $product->id)->delete();
        $specs = $request->input('specifications');
        foreach ($specs as $specId => $specData) {
            if (!isset($specData['selected']) || $specData['selected'] != 1) {
                continue;
            }

            $product->specifications()->attach($specId);

            if (isset($specData['attributes'])) {
                foreach ($specData['attributes'] as $attributeId => $attrData) {
                    if (!isset($attrData['value']) || !isset($attrData['unit_id'])) {
                        continue;
                    }

                    Value::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'unit_id' => $attrData['unit_id'],
                        'value' => $attrData['value'],
                        'type' => 'checkbox',
                        'status' => 'active',
                    ]);
                }
            }
        }
        $remainingImages = json_decode($request->input('remaining_images'), true);
        $existingImages = $product->images;
        foreach ($existingImages as $image){
            $imageFileName = basename($image->url);
            if (!in_array($imageFileName, $remainingImages)){
                $imagePath = public_path('upload/images/products/' . $imageFileName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
        }
        if ($request->hasFile('images')){
            $file = $request->file('images');
            foreach ($file as $image){
                $imageName = md5(uniqid(microtime(true), true)) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('upload/images/products/' . $imageName);
                $product->images()->create([
                    'url' => 'http://127.0.0.1:8000/upload/images/products/' . $imageName,
                ]);
            }
        }
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function ProductVariants($id)
    {
        $variants = Variant::where('product_id', $id)->with(['color', 'size', 'material','product.images'])->get();
        return $variants;
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            foreach ($product->images as $image) {
                $productImageName = basename($image->url);
                @unlink('upload/images/products/' . $productImageName);
            }
            $product->delete();
            $product->images()->delete();
            $notification = array(
                'message' => 'Product Deleted Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }

}
