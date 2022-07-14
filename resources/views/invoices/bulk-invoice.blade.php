@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Invoices</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            @if(session('success'))
            <span class="text-success">
                {{session('success')}}
            </span>
            @endif
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=1 ; $i<=$files ; $i++)
           <div class="card mt-2">
        <div class="card-body">
           <h5 class="font-weight-bolder mb-0">Invoice #{{$i}}</h5>
           <hr class="horizontal dark mt-2">

            <!-- company and name fields  -->
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
                            <label for="date">Invoice No</label>
                            <input value="" type="text" class="form-control" name="invoiceId[]" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control" name="date[]" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
               
            <!-- email and invoice fields  -->
              
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">Invoice Document</label>
                            <input value="" type="file"   class="form-control" name="file[]" required accept=".pdf,.doc,.xlsx,.docx">
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="amount" 
                            class="form-control" 
                            name="amount[]" required>
                            <span   class="text-danger text-sm ">@error('amount') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
            <!-- amount and invoice ends  -->
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
