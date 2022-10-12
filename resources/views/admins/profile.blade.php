@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg  shadow-none border-radius-xl">
    <div class="container-fluid ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Complete Profile</li>
            </ol>
        </nav>
    </div>
</nav>
@endsection

<div class="container-fluid p-2 mt-2">
    <div class="row ">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder mb-0">Profile</h5>
                    <p class="mb-0 text-sm">Edit your's profile here.
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
                    <form action="{{route('admin_update',$users->id)}}" method="POST">
                        @csrf
                        <!-- company and name fields  -->
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{$users->name}}" class="form-control" name="name" required>
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{$users->email}}" class="form-control" name="email" required>
                                    <span class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                                </div>
                            </div>



                        </div>
                        <!-- email and password fields  -->
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company">Phone</label>
                                    <input type="text" class="form-control " value="{{$users->phone}}" name="phone" required>
                                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company">Address</label>
                                    <input type="text" value="{{$users->address}}" class="form-control " name="address" required>
                                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                                </div>
                            </div>

                        </div>
                        <!-- Save Button  -->
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit">Save</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection