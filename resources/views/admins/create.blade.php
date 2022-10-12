@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Admin</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection

<div class="container-fluid p-2 mt-2">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">{{__('labels.add_admin')}}</h5>
            <p class="mb-0 text-sm">Mandatory informations
            </p>
            <hr class="horizontal dark mt-2">
            <!-- Customer add form started here  -->
            <form action="{{route('admins.store')}}" method="POST">
                @csrf
            <!-- company and name fields  -->
               
                   <div class="row">
                   <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" required>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" 
                            class="form-control" 
                            name="password" required>
                            <span   class="text-danger text-sm ">@error('password') {{$message}} @enderror</span>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Repeat Password</label>
                            <input type="password" 
                            id="password_confirmation"
                             class="form-control"
                              name="password_confirmation" required>
                            <span   class="text-danger text-sm ">@error('password_confirmation') {{$message}} @enderror</span>
                        </div>
                    </div>
                   </div>
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">Add Admin</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection