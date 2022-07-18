@extends('layouts.main')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Payment</li>
        </ol>
    </nav>
   </div>
</nav>

<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">{{__('labels.add_payment')}}</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            &nbsp;
            <span class="text-success">
            @if(session('success'))
            {{session('success')}}
            @endif
            </span>

            </p>
            <hr class="horizontal dark mt-2">
            <!-- Customer add form started here  -->
            <form action="{{route('pays.store',$invoices->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
            <!-- company and name fields  -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice">{{__('labels.invoice_no')}}</label>
                            <input value="{{$invoices->invoiceId}}" type="text" class="form-control " name="invoice" required disabled>
                            <span class="text-danger">@error('invoice') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Amount</label>
                            <input value="{{$invoices->amount}}" type="text" class="form-control" name="amount" required disabled>
                            <span class="text-danger">@error('amount') {{$message}} @enderror</span>

                        </div>
                    </div>
                </div>
            <!-- email and password fields  -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="due_date">Due Date</label>
                            <input value="{{$invoices->date}}" type="date" class="form-control" name="due_date" required disabled>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Payment Date</label>
                            <input type="date" 
                            class="form-control" 
                            name="payment_date" required>
                            <span   class="text-danger text-sm ">@error('payment_date') {{$message}} @enderror</span>
                            
                        </div>
                    </div>
                </div>
            <!-- password repeat and status fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="proof">{{__('labels.proof')}}</label>
                            <input type="file" name="file" class="form-control" >
                            <span  class="text-danger text-sm ">@error('proof  ') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">{{__('labels.add_payment')}}</</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection