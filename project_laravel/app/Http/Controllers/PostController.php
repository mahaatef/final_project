<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Traits\imagesTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    use imagesTrait;

    public function __construct()
    {
        $this->middleware('can:post.view')->only('index');
        $this->middleware('can:post.create')->only('create');
        $this->middleware('can:post.update')->only('edit');
        $this->middleware('can:post.delete')->only('destroy');
    }


    public function index()
    {
        $posts = Post::with('category')->orderByDesc('id')->paginate('10');
        return view('admin.post.index', compact( 'posts'));
    }

    public function create()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.post.create', compact('categories'));
    }


    public function store(PostRequest $request)
    {
        $attachment = "";
        if ($request->hasFile('attachment')){
            $attachment = $this->saveImages($request->attachment,"attachments");
        }

        Post::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'attachment'=> $attachment,
            'category_id'=> $request->category_id,
            'user_id'=> auth()->user()->id
        ]);

        return redirect(route('post.index'));
    }


    public function show(Post $post)
    {
        $posts = Post::orderByDesc('id')->paginate('10');
        return view('admin.post.index', compact( 'posts'));
    }


    public function edit(Post $post)
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.post.edit', compact('post','categories'));
    }


    public function update(PostRequest $request, Post $post)
    {
        $attachment = $post->attachment;
        if ($request->hasFile("attachment")){
            $this->deleteImages('attachments/'.$attachment);
            $attachment = $this->saveImages($request->attachment,"attachments");
        }
        $post->update([
            'title'=> $request->title,
            'content'=> $request->content,
            'attachment'=> $attachment,
            'category_id'=> $request->category_id
        ]);

        return redirect(route('post.index'));
    }

    public function destroy(Post $post)
    {
        $this->deleteImages('attachments/'.$post->attachment);
        $post->delete();
        return redirect()->back();
    }
}
