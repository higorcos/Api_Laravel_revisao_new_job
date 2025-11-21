@extends('layouts.app')

@section('title')
    cadastro de usuários
@endsection

@section('content')
    <h1>Cadastros de usuário</h1>
    <form action="{{route('users.store')}}" 
    enctype="multipart/form-data"
    method="POST">
        @csrf

        @if($errors->any())
            @foreach($errors->all() as $error)
            <div>{{$error}}</div>
            @endforeach
        @endif

        <div>
        <label for="name">Nome</label>
        <input id='name' type="text" name="name" value="{{old('name')}}">
        </div>
        <div>
        <label for="email">Email</label>
        <input id='email' type="text" name="email" value="{{old('email')}}">
        </div>
        <div>
        <label for="password">Senha</label>
        <input id='password'type="text" name="password" value="{{old('password')}}">
        </div>
        <label for="avatar">Avatar</label>
        <input id='avatar'type="file" name="avatar" value="{{old('avatar')}}">
        </div>
     
        <div>
            <button type="submit">cadastrar</button>
        </div>
    </form>
    

@endsection