@extends('layouts.app')

@section('content')
<div class="container">
     @foreach($posts as $post)
     <div class="row">
       <div class="col-6 offset-3 d-flex align-items-center pb-3">
       <div>
       <a href="/profile/{{ $post->user->id}} ">
          <span>
           <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" 
           style="max-width: 40px;"></span>
         </a>
      
        </div>
       <a href="/profile/{{ $post->user->id}} ">
          <span class="text-dark pl-2">{{ $post->user->username }}</span>
         </a>
        </div>
      	<div class="col-6 offset-3">
      			<img src="/storage/{{ $post->image }}" class="w-100">
      	</div>
     </div>

        <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
      	<div>
             <p>
             <span class="font-weight-bold pr-1">
                  <a href="/profile/{{ $post->user->id}} ">
                        <span class="text-dark">{{ $post->user->username }}</span>
                  </a></span>
                  {{ $post->caption }}
             </p>

      	</div>
        </div>
      </div>  	
     @endforeach
     <div class="row d-flex justify-content-center">
     <div>
     {{$posts->links()}}
     </div>
     </div>
    </div>
@endsection
