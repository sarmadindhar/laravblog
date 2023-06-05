<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $posts = Post::withCount('likes as total_likes')->when(auth()->check(),function($query){
            $query->withCount(['likes as is_liked'=>function($q){
                $q->where('user_id',auth()->user()->id);
            }]);
        })
            ->when($request->search,function($post) use ($request){
                $post->where('posts.title','LIKE','%'.$request->search.'%')->orWhere('posts.content','LIKE','%'.$request->search.'%');
            })->orderBY('id','DESC')
            ->groupBy('posts.id')
            ->paginate($request->limit);
        return response()->json([
            'posts' => $posts->items(),
            'totalPosts' => $posts->total(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->only('title','content')+['author_id'=>auth()->user()->id];
        if($request->hasFile('image')){
            $path = Storage::disk(env('DEFAULT_MEDIA_DISC'))->put('public', $request->image);
            $data['image']=$path;
        }
        $post = Post::create($data);
        return response()->json(['message'=>'success','data'=>$post->getDetailed()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->only('title','content');
        if($request->hasFile('image')){
            if (!empty($post->image)) {
                if (Storage::disk(env('DEFAULT_MEDIA_DISC'))->exists($post->image)) {
                    Storage::disk(env('DEFAULT_MEDIA_DISC'))->delete($post->image);
                }
            }
            $path = Storage::disk(env('DEFAULT_MEDIA_DISC'))->put('public', $request->image);
            $data['image']=$path;
        }
        $post->update($data);
        return response()->json(['message'=>'success','data'=>$post->getDetailed()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['message'=>'success']);
    }



    public function like($id){
        $post = Post::findOrFail($id);
        $post->likes()->toggle(auth()->user()->id);
        return response()->json(['message'=>'success','data'=>$post->getDetailed()]);
    }
}
