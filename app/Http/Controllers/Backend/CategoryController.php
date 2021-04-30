<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:categories',
            'status' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required|unique:categories,name,'.$id,
           'status' => 'required'
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
    }

    public function destroy($id)
    {
        $category = Category::find($id)->delete();
    }

    public function active_categories()
    {
        $categories = Category::where('status', 1)->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function category_post($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)->get();
        return response()->json($posts);
    }
}
