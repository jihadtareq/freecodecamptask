<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //everything is here authication 
         $this->middleware('auth');
   
       }

    public function index()
    {
        $users=auth()->user()->following()->pluck('profiles.user_id');
        $posts=Post::whereIn('user_id',$users)->with('user')->latest()->paginate(2);//->get();
        return PostResource::collection(Post::with('user')->paginate(2));
   
       // return view ('posts.index',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= request()->validate([
    		'caption' => 'required',
    		'image' => ['required','image'],
    	]);
        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save(); 
    
       $post=auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image' =>$imagePath,
            ]);

            return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
     return PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
