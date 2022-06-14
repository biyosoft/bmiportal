@extends('layouts.auth-login')
@section('content')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back Customer</h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div style="font-size: 12px;" class=" text-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                  <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <label>{{__('labels.email')}}</label>
                    <div class="mb-3">
                      <input  class="form-control" 
                               placeholder="Email" 
                               aria-label="Email" 
                               type="email" 
                               name="email" 
                               :value="old('email')" 
                               required autofocus>
                    </div>

                    <label>{{__('labels.password')}}</label>
                    <div class="mb-3">
                      <input  type="password"
                                name="password"
                                required autocomplete="current-password" 
                                 class="form-control" 
                                 placeholder="Password" 
                                 aria-label="Password" 
                                 aria-describedby="password-addon">
                    </div>

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="remember_me" checked="">
                      <label class="form-check-label" for="rememberMe">{{__('labels.remember_me')}}</label>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">{{__('login')}}</button>
                    </div>

                  </form>
                </div>
                <div class="card-footer mx-4 pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                  @if (Route::has('password.request'))
                   <a href="{{ route('password.request') }}">{{__('labels.forget_password')}}</a>
                  @endif
                  <a href="{{ route('register') }}" class="text-info text-gradient font-weight-bold">Sign Up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"  style="background-image:url('{{asset('soft-theme/assets/img/curved-images/curved6.jpg')}}')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection