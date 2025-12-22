@extends('layouts.auth')
@section('body-class', 'login-page')


@section('content')
     <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="{{ route('login') }}"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Admin</b>LTE</h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>
           @session('status')
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endsession
          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="loginEmail" type="email" name='email' class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="loginEmail">Email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="loginPassword" type="password" name='password' class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" placeholder="" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="loginPassword">Password</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                 <div class="d-grid gap-2 mt-3">
            </div>
              </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
            <!--end::Row-->
          </form>
          <!-- /.social-auth-links -->
          <div>

              <p class="mb-1 text-center"><a href="{{ route('password.request') }}">I forgot my password</a></p>
              <p class="mb-0 text-center">
                  <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
                </p>
            </div>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection