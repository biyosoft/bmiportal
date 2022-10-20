@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Payment</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection

<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">{{__('labels.add_payment')}}</h5>
            <p class="mb-0 text-sm">Please complete payment by submitting proof of payment. </p>

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
                            <input type="hidden" id="dueDate" value="{{$invoices->date}}">
                            <input id="date" value="" type="date" class="form-control" name="due_date" required disabled>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Payment Date <span class="text-danger">*</span></label>
                            <input type="date" 
                            class="form-control" 
                            name="payment_date" required>
                            <span   class="text-danger text-sm ">@error('payment_date') {{$message}} @enderror</span>
                            
                        </div>
                    </div>
                </div>
                <!-- hidden field for forign invoice id  -->
                <input type="hidden" value="{{$invoices->id}}" name="invoice_id">
            <!-- password repeat and status fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="proof">Upload Proof of Payment <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" required>
                            <span  class="text-danger text-sm ">@error('proof  ') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">{{__('labels.add_payment')}}</</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){ 
        invoiceDate = new Date($('#dueDate').val());
        output_f=new Date(invoiceDate.setDate(invoiceDate.getDate())).toISOString().split('.');
        output_s = output_f[0].split('T');
        $('#date').val(output_s[0]);
    });
</script>