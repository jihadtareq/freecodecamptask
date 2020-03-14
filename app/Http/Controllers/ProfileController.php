<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
     public function index(User $user)
    {     
         //if this user follows this profile
         $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false ;
         
    	/* $user=User::findOrfail($user); //find by id

        return view('profiles.index',[ //array .. user without $ this would use in html blade 
        	'user'=>$user,
        ]); */
        $postCount=Cache::remember('count.posts.' . $user->id, 
        now()->addSeconds(30),
        function() use($user){
        return $user->posts->count();
        });

        $followersCount=Cache::remember('count.followers.'.$user->id,
        now()->addSeconds(30),
        function() use($user){
        return $user->profile->followers->count();
         });

        $followingCount=Cache::remember('count.following.'.$user->id,
        now()->addSeconds(30),
        function() use($user){
        return $user->following->count();
         });
         
        return view('profiles.index',compact('user','follows','postCount','followersCount','followingCount'));
    }

     public function edit(User $user)
    {   
        $this->authorize('update',$user->profile); //we authorized the update in user profile
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {   
        $this->authorize('update',$user->profile);

        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',

        ]);

        if(request('image')){
        $imagePath = request('image')->store('profile','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
        $image->save(); 
        //we need array to put set images
        $imageArr=['image'=>$imagePath];
        }
       //array_merge two array together
      auth()->user()->profile->update(array_merge(
        $data,
        $imageArr ?? [] // i told it in case the image is not set put an empty array
         ));

        return redirect("/profile/{$user->id}");
       // dd($data);
     }
}
