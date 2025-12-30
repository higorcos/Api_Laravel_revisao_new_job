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
    @can('destroy', App\Models\User::class)
    
    @endcan
    <form 
        action="{{route('users.index')}}" 
        method="get"
        class="mb-3"
        style="width: 300px"
    >
        <div class="input-group input-group-sm">
            <input 
                type="text" 
                name="keyword" 
                value="{{request()->keyword}}"
                class="form-control"
                placeholder="Pesquisar por nome ou email">
            <button type="submit"
                class="btn btn-primary">Buscar</button>
        </div>
    </form>

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
                @can('edit', App\Models\User::class)
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">Editar</a>
                @endcan

                @can('destroy', App\Models\User::class)
                    <button class="btn btn-danger btn-sm" type="submit">Excluir</button >
                @endcan
            </form>
        </td>
        </tr>
        @endforeach
  </tbody>
</table>
    <div>
        {{$users->links()}}
    </div>
</div>
@endsection