@extends('layouts.auth')
@section('body-class', 'login-page')


@section('content')
     <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="../index2.html"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Admin</b>LTE</h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="{{ route('password.email') }}" method="post">
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
            
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                 <div class="d-grid gap-2 mt-3">
            </div>
              </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Send me the link</button>
                </div>
            </div>
            <!--end::Row-->
          </form>
          <!-- /.social-auth-links -->
          <div>

              <p class="mb-1 text-center"><a href="forgot-password.html">Back to login</a></p>
            </div>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection