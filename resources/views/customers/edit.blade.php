@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Customer</li>
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
            <h5 class="font-weight-bolder mb-0">Edit Customer</h5>
            <p class="mb-0 text-sm">Mandatory informations
            &nbsp;

            </p>
            <hr class="horizontal dark mt-2">
            <!-- Customer add form started here  -->
            <form action="{{route('customers.update',$users->id)}}" method="POST">
                @csrf
                @method('PUT')
            <!-- company and name fields  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="company">Company</label>
                            <input value="{{$users->company}}" type="company" class="form-control " name="company" required>
                            <span class="text-danger">@error('company') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input value="{{$users->name}}" type="text" class="form-control" name="name" required>
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Customer No.</label>
                            <input value="{{$users->customer_no}}" type="text" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
               
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input value="{{$users->email}}" type="email" class="form-control" name="email" required>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="payment_term">{{__('labels.payment_term')}}</label>
                            <input value="{{$users->payment_term}}" type="text" class="form-control" name="payment_term">
                        </div>
                    </div>
            <!-- email and password fields  -->
            <!-- password repeat and status fields  -->
                
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">{{__('labels.phone')}}</label>
                            <input value="{{$users->phone}}" type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="">
                                <option {{$users->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$users->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                            <span   class="text-danger text-sm ">@error('status') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">Update Customer</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection