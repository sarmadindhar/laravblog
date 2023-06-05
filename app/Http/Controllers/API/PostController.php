<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('id','DESC')->when($request->search,function($post) use ($request){
            $post->where('title','LIKE','%'.$request->search.'%')->orWhere('content','LIKE','%'.$request->search.'%');
        })->paginate($request->limit);
        return response()->json([
            'posts' => $posts->items(),
            'totalPosts' => $posts->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $imageName = time().'.'.$request->image->extension();
            $path = Storage::disk('local')->put('images', $request->image);
            $path = Storage::disk('local')->url($path);
//            $data['image']=$path;
        }
        $post->update($data);
        return response()->json(['message'=>'success','data'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
