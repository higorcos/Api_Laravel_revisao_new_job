@extends('layouts.default')
@section('page-title', 'Usuários')
@section('page-actions')
       <a href="" class="btn btn-primary btn-sm">Adicionar</a>
@endsection

@section('content')
<div>
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
            <a href="" class="btn btn-primary btn-sm">Editar</a>
            <a href="" class="btn btn-danger btn-sm">Excluir</a>
        </td>
        @endforeach
     
    </tr>
   
  </tbody>
</table>
    
</div>
@endsection