@extends('layouts.auth')
@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="../index2.html"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Admin</b>LTE</h1>
          </a>
        </div>
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>
          <form action="{{route('password.update')}}"  method="post">
            @csrf
           <input type="text" name="token" value="{{ request()->token }}" hidden>
           
                <input id="registerEmail" name="email" type="email" hidden class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{ request()->route('email') }}" />
               
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
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder=""  />
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="registerPasswordConfirmation">Password Confirmation</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Reset</button>
            </div>
            
            
          </form>
     
        </div>
    </div>
    </div>
@endsection