@extends('layouts.default')
@section('page-title', 'Adicionar usuário')


@section('content')
<div>
   <form action="{{route('users.store')}}" method="POST">
    @csrf
   <div class="mb-3">
   <label for="name" class="form-label">Nome</label>
   <input 
      type="text" 
      name="name" 
      value="{{old('name')}}"
      class="form-control @error('name') is-invalid @enderror" >
   @error('name')
       <div class="invalid-feedback">{{$message }}</div>
   @enderror
   </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input 
    id="email" 
    name="email" 
    type="email" 
    value="{{old('email')}}"
    class="form-control @error('email') is-invalid @enderror">
    @error('email')
       <div class="invalid-feedback">{{$message }}</div>
   @enderror
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input 
    id="password" 
    name="password" 
    type="password" 
    value="{{old('password')}}"
    class="form-control @error('password') is-invalid @enderror">
    @error('password')
       <div class="invalid-feedback">{{$message }}</div>
   @enderror
  </div>

  <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
    
</div>
@endsection