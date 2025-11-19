@extends('layouts.app')

@section('content')
     <h1 class="prototype">Index todos, </h1>
     
     
     @foreach($users as $user)
     <div>{{$user->name}}</div>
     @endforeach
     
     <div>
         <img width='400px' src="{{ Vite::asset('resources/images/image.png') }}">
     </div>
    
   
@endsection
