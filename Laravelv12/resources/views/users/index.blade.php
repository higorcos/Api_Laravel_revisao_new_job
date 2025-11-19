@extends('layouts.app')

@section('content')
     <h1>
        OIIIIIIII, 
    </h1>
    @foreach($users as $user)
    
    <div>{{$user->name}}</div>
    @endforeach

    <div></div>
   
@endsection
