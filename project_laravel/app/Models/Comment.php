<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ["content", "post_id",  "user_id"];
    public $timestamps = true;

    public function post(){
        return $this->belongsTo(Post::class, 'post_id')->with('category');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
