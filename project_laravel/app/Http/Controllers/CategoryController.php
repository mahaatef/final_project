<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:category.view')->only('index');
        $this->middleware('can:category.create')->only('create');
        $this->middleware('can:category.update')->only('edit');
        $this->middleware('can:category.delete')->only('destroy');
    }

    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate('10');
        return view('admin.category.index', compact('categories'));
    }

    public function categoryPosts(Request $request){
        $posts = Post::where('category_id', '=', $request->category)->get();
        return view('admin.comment.posts', compact('posts'));
    }

    public function create()
    {
        return view('admin.category.create');
    }


    public function store(CategoryRequest $request)
    {
        Category::create([
            'name'=> $request->name
        ]);

        return redirect(route('category.index'));
    }


    public function show(Category $category)
    {
        return redirect(route('category.index'));
    }


    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name'=> $request->name
        ]);

        return redirect(route('category.index'));
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
