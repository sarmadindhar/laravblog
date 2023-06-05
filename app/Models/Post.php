<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','content','image','author_id'
    ];



    public function likes(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }


    public function getDetailed(){
        return Post::withCount('likes as total_likes')->withCount(['likes as is_liked'=>function($q){
            $q->where('user_id',auth()->user()->id);
        }])->findOrFail($this->id);
    }
}
