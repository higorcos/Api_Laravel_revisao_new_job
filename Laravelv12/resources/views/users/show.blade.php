@extends('layouts.app')

@section('title')
    listagem de usuários
@endsection

@section('content')
    <h1>
        Show, 
    </h1>
    <h2>Dados de: {{$user->name}}</h2>
    

@endsection