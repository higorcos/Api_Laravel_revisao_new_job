@extends('layouts.auth')
@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="{{ route('login') }}"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Admin</b>LTE</h1>
          </a>
        </div>
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>
          <form action="{{route('register')}}"  method="post">
            @csrf
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="registerFullName" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{old('name')}}"/>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="registerFullName">Name</label>
              </div>
              <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="registerEmail" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{old('email')}}" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="registerEmail">Email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="registerPassword" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="" value="{{old('password')}}" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="registerPassword">Password</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder=""  />
                <label for="registerPasswordConfirmation">Password Confirmation</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            
            
          </form>
          <p class="mb-0 text-center">
            <a href="{{route('login')}}" class="link-primary text-center"> Back to login </a>
          </p>
        </div>
    </div>
    </div>
@endsection