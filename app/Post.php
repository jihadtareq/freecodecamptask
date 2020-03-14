<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{ 
       protected $guarded =[];
	// protected $fillable = ['caption', 'image',];
	  public function user(){

    	return $this->belongsTo(User::class);
	  }
	  
	  public function scopePosts($query){
		  
		$users=auth()->user()->following()->pluck('profiles.user_id');
		return $query->whereIn('user_id',$users)->with('user')->latest()->paginate(2);

	  }
 }
