@extends('layouts.main')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row ">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder mb-0">Chnage Your Password</h5>
                    <p class="mb-0 text-sm">Change your's password here.
                        &nbsp;
                        @if(session('success'))
                        <span class="text-success">
                            {{session('success')}}
                        </span>
                        @endif
                        @if(session('error'))
                        <span class="text-danger">
                            {{session('error')}}
                        </span>
                        @endif

                    </p>
                    <hr class="horizontal dark mt-2">
                    <!-- Customer add form started here  -->
                    <form action="{{route('change_password_api')}}" method="POST">
                        @csrf
                        <!-- company and name fields  -->
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Existing Password</label>
                                    <input type="text" value="" class="form-control" name="existing_pass" required>
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">New Password</label>
                                    <input type="password" value="" class="form-control" name="new_pass" required>
                                    <span class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Repeat New Password</label>
                                    <input type="password" value="" class="form-control" name="repeat_new_pass" required>
                                    <span class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Button  -->
                        <div class="button-row d-flex ">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection