@extends('layouts.default')
@section('page-title', 'Editar usuário')


@section('content')
   @include('users.parts.basic-details')
   <br>
   @include('users.parts.profile')
@endsection