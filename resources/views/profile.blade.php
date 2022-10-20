@extends('layouts.main')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Complete Profile</li>
            </ol>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row ">
        <div class="col-9 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder mb-0">Profile</h5>
                    <p class="mb-0 text-sm">Please complete your company profile.
                    </p>
                    <hr class="horizontal dark mt-2">
                    <!-- Customer add form started here  -->
                    <form action="{{route('customers.store1',$users->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- company and name fields  -->
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Business Contact Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$users->name}}" class="form-control" name="name" required>
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">Business E-mail <span class="text-danger">*</span></label>
                                    <input type="email" value="{{$users->email}}" class="form-control" name="email" required>
                                    <span class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                                </div>
                            </div>



                        </div>
                        <!-- email and password fields  -->
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company">Company/Business Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$users->company}}" class="form-control " name="company" required>
                                    <span class="text-danger">@error('company') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company">Business Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control " value="{{$users->phone}}" name="phone" required>
                                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                                </div>
                            </div>
                        {{-- address --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company">Business Registered Address <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$users->address}}" class="form-control " name="address" required>
                                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        {{-- upload files --}}

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file1">Upload Credit Application Form (CC1) <span class="text-danger">*</span></label>
                    </label>
                                    <input type="file" class="form-control" name="file1" required>
                                    <span class="text-danger">@error('file1') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file2">Upload Form 24</label>
                                    <input type="file" class="form-control" name="file2">
                                    <span class="text-danger">@error('file2') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file3">Upload Form 9</label>
                                    <input type="file" class="form-control" name="file3">
                                    <span class="text-danger">@error('file3') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file4">Upload Financial Statements</label>
                                    <input type="file" class="form-control" name="file4">
                                    <span class="text-danger">@error('file4') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file5">Upload PDPA</label>
                                    <input type="file" class="form-control" name="file5">
                                    <span class="text-danger">@error('file5') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <!-- Add Customer Button  -->
                        <div class="button-row d-flex ">
                            <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" type="submit">Submit For Approval</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
        <div class="col-3 col-lg-3">
            <div class="card card-body">
                <b class="text-dark text-center">Attachements</b>
                <hr class="text-dark">
                <span><i class="fas fa-file-pdf text-lg me-1"></i> Credit Application Form (CC1) </span>
                <!-- <span><i class="fas fa-file-pdf text-lg me-1"></i> Form 24 </span> -->
            </div>
        </div>
    </div>
</div>
@endsection