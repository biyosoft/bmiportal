@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload DO's</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-12 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload DO's</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            @if(session('success'))
            <span class="text-success " style="max-width: 300px;">
                {{session('success')}}
            </span>
            @endif
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('deliveryOrders.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=1 ; $i<=$files ; $i++)
           <div class="card mt-2">
                <div class="card-body mt-3">
                <h5 class="font-weight-bolder mb-0">DO #{{$i}}</h5>
                <hr class="horizontal dark mt-2">
                    <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="customer">Customer</label>
                                    <select name="user_id[]" class="form-control">
                                        <option value=""></option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="do_no">DO Number</label>
                                    <input value="{{old('do_no')}}" type="text" class="form-control" name="do_no[]" required>
                                    <span class="text-danger">@error('do_no') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group mb-3">
                                    <label for="customer">Invoice</label>
                                    <select name="invoice_id[]" class="form-control">
                                        <option value=""></option>
                                        @foreach($invoices as $invoice)
                                        <option value="{{$invoice->id}}">{{$invoice->invoiceId}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="do_doc">DO Document</label>
                                    <input value="" type="file" class="form-control" name="do_doc[]" required accept=".pdf,.doc,.xlsx,.docx">
                                    <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
           @endfor
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">Upload Invoices</button>
                </div>


                
            </form>
        
    </div>
   </div>
</div>
@endsection
