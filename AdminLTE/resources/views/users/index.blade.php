@extends('layouts.default')
@section('page-title', 'Usuários')
@section('page-actions')
       <a href="{{route('users.create')}}" class="btn btn-primary btn-sm">Adicionar</a>
@endsection

@section('content')
<div>
    @session('status')
        <div class="alert alert-success" role="alert">{{$value}}</div>
    @endsession
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
        @foreach ($users as $user)
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            {{-- <td>{{$user->id}}</td> --}}

        <td>
            <form action="{{route('users.destroy', $user->id)}}" method="post">
                @csrf
                @method('delete')
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">Editar</a>
                <button class="btn btn-danger btn-sm" type="submit">Excluir</a>
            </form>
        </td>
        </tr>
        @endforeach
  </tbody>
</table>
    
</div>
@endsection