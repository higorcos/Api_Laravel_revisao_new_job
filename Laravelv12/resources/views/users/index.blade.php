@extends('layouts.app')

@section('content')
     <h1 class="prototype">Index todos, </h1>
     
     
     @foreach($users as $user)
     <div>{{$user->name}}</div>
     @endforeach
     <div>

         {{ $users->links()}}
        </div>

     <div>
         <img width='200px' src="{{ Vite::asset('resources/images/image.png') }}">
     </div>

    
    
   
@endsection
