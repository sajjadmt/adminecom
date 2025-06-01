<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::with('children')->get();
        return $categories;
    }

    public function Categories()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.category.all-category',compact('categories'));
    }

    public function CreateCategory()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.category.create-category',compact('categories'));
    }

    public function StoreCategory(CreateCategoryRequest $request)
    {
        $parentId = $request->category_type == 'sub' ? $request->parent_id : null;
        if ($request->hasFile('category_image')){
            $file = $request->file('category_image');
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Category::create([
                'parent_id' => $parentId,
                'category_name' => $request->category_name,
                'category_slug' => Str::slug($request->category_name),
                'category_image' => 'http://127.0.0.1:8000/upload/images/categories/' . $fileName,
            ]);
            Image::make($file)->resize(400,400)->save('upload/images/categories/' . $fileName);
            $notification = array(
                'message' => 'Category Created Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
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


    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        $categoryPath = $this->getCategoryPath($category);
        $categories = Category::where('parent_id',null)->get();
        return view('admin.category.edit-category',compact('category','categories' , 'categoryPath'));
    }

    public function UpdateCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $request->validate([
            'category_name' => ['required','string','max:255',Rule::unique('categories', 'category_name')->ignore($request->id)],
        ]);
        if ($request->category_name !== $category->category_name) {
            $category->category_name = $request->category_name;
        }
        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $oldImageName = basename($category->category_image);
            if ($category->category_image !== 'none.jpg') {
                @unlink('upload/images/categories/' . $oldImageName);
            }
            $fileName = md5(uniqid(microtime(true), true)) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(400,400)->save('upload/images/categories/' . $fileName);
            $category->category_image = 'http://127.0.0.1:8000/upload/images/categories/' . $fileName;
        }
        if ($category->parent_id !== null && $request->has('enable_category_transfer')){
            $request->validate([
                'new_category_id' => 'required|exists:categories,id|not_in:' . $category->id,
            ]);
            $newCategory = Category::find($request->new_category_id);
            if ($newCategory) {
                $category->parent_id = $newCategory->id;
            }
        }
        $category->save();
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('panel.categories')->with($notification);
    }

    public function CategorySearch(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::with('children')
            ->where('category_name', 'like', "%{$query}%")
            ->get();
        return view('admin.category.category-table-body', compact('categories'));
    }

    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if ($category->children->isEmpty()){
        $category->delete();
        $categoryImageName = basename($category->category_image);
        @unlink('upload/images/categories/' . $categoryImageName);
        $notification = array(
            'message' => 'Category Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'This category has sub categories and can not be deleted.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
