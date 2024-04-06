<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::all();
        return view('admin.categories.all-categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create-category');
    }
    public function storeCategory(Request $request)
    {
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->save();
        session()->flash('statuscode', 'success');
        return redirect('all-categories')->with('status', 'Data saved');
    }
    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit-category')->with('category', $category);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->categoryName = $request->categoryName;
        $category->update();
        Session()->flash('statusCode', 'success');
        return redirect('all-categories')->with('status', 'Data updated');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['status'=> 'Category deleted successfully']);
    }
}
