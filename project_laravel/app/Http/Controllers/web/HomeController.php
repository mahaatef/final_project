<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $popular_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->limit(5)->get();
        $latest_posts = Post::withCount('comments')->orderByDesc('created_at')->limit(5)->get();
        $random_posts = Post::withCount('comments')->inRandomOrder()->limit(3)->get();
        $categories = Category::all();

        $users_count = User::count();
        $categories_count = Category::count();
        $posts_count = Post::count();
        $comments_count = Comment::count();
        return view('welcome',
            compact('popular_posts', 'latest_posts', 'random_posts', 'categories',
            'users_count','categories_count','posts_count','comments_count'));
    }

    public function postsByCategory(Category $category){
        return view('postsByCategory', compact('category'));
    }

    public function singlePost(Post $post){
        return view('singlePost', compact('post'));
    }

    public function addPostComment(Post $post, Request $request){
        $request->validate([
            'content' => 'required|string',
        ]);
        Comment::create([
            'content'=> $request->content,
            'post_id'=> $post->id,
            'user_id'=> auth()->user()->id
        ]);

        return redirect()->back();
    }
}
