<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ["title", "content", "attachment", "category_id", "user_id"];
    protected $appends = ['attachment_url'];
    public $timestamps = true;

    public function getAttachmentUrlAttribute()
    {
        return asset('attachments/' . $this->attachment);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
