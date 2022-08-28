<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:comment.view')->only('index');
        $this->middleware('can:comment.create')->only('create');
        $this->middleware('can:comment.update')->only('edit');
        $this->middleware('can:comment.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::orderByDesc('id')->get();
        $categories = Category::orderByDesc('id')->get();

        $query = DB::table('comments')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.id', 'comments.content', 'categories.name as category','posts.title as post', 'users.name as user')
            ->orderByDesc('id');

        if ($request->has('user_id') && !empty($request->user_id)){
            $query->where('users.id', '=', $request->user_id);
        }
        if ($request->has('category_id') && !empty($request->category_id)){
            $query->where('categories.id', '=', $request->category_id);
        }
        if ($request->has('post_id') && !empty($request->post_id)){
            $query->where('posts.id', '=', $request->post_id);
        }
        if ($request->has('from') && !empty($request->from)){
            $query->where('comments.created_at', '>=', $request->from);
        }
        if ($request->has('to') && !empty($request->to)){
            $query->where('comments.created_at', '<=', $request->to);
        }

        $comments = $query->paginate(10);

        return view('admin.comment.index', compact('comments', 'categories', 'users'));
    }


    public function create()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.comment.create', compact('categories'));
    }

    public function store(CommentRequest $request)
    {
        Comment::create([
            'content'=> $request->content,
            'post_id'=> $request->post_id,
            'user_id'=> auth()->user()->id
        ]);

        return redirect(route('comment.index'));
    }


    public function show(Comment $comment)
    {
        $comments = Comment::orderByDesc('id')->paginate('10');
        return view('admin.comment.index', compact('comments'));
    }


    public function edit(Comment $comment)
    {
        $categories = Category::orderByDesc('id')->get();

        return view('admin.comment.edit', compact('comment','categories'));
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update([
            'content'=> $request->content,
            'post_id'=> $request->post_id,
        ]);

        return redirect(route('comment.index'));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
