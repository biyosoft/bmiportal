@extends('layouts.auth-login')
@section('content')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain p-4" style="box-shadow:1px 1px 5px black;">
              <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
        @if (session('status') == 'verification-link-sent')
            <div class="text-sm text-success">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
        <div class="mt-4  items-center justify-between">
            <div class="row">
                <div class="col-md-9">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div>
                            <button class="btn bg-gradient-info ">
                            {{ __('Resend Verification Email') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn bg-gradient-info text-sm btn-sm ">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-info h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                <img src="{{asset('images/BMI_Group_Logo.jpg')}}" alt="pattern-lines" class="position-absolute opacity-4 start-0">
                <div class="position-relative">
                  <img class="max-width-500 w-100 position-relative z-index-2" src="{{asset('soft-theme/assets/img/illustrations/chat.png')}}" alt="chat-img">
                </div>
                <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
                <p class="text-white">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

