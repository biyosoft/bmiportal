@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Invoice</li>
        </ol>
    </nav>
   </div>
</nav>

<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">Add invoice</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            &nbsp;
            <span class="text-success">
            @if(session('success'))
            {{session('success')}}
            @endif
            </span>

            </p>
            <hr class="horizontal dark mt-2">
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
       
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select id="user_id" name="user_id" class="form-control">
                                <option value="">Select Customer</option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                 <input id="pt" type="hidden" value="{{$user->payment_term}}">
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice No</label>
                            <input type="text" class="form-control" name="invoiceId" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice Date</label>
                            <input id="invoiceDate"  type="date" class="form-control" name="invoice_date" required>
                            <span class="text-danger">@error('invoice_date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input  id="dueDate" type="date" class="form-control" name="date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
               
            <!-- email and invoice fields  -->
              
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">Invoice Document</label>
                            <input type="file" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input id="amount" type="amount" 
                            class="form-control" 
                            name="amount" required>
                            <span   class="text-danger text-sm ">@error('amount') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
            <!-- amount and invoice ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">Add invoice</button>
                </div>

                
                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
    var user = {};
    $(document).ready(function(){ 
        $('#user_id').change( function() {
            $(this).find(":selected").each(function () {
                user.userId = $('#pt').val();
            });
        });
    $('#invoiceDate').change(function() {
        invoiceDate = new Date($('#invoiceDate').val());
        output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+user.userId)).toISOString().split('.');
        output_s = output_f[0].split('T');
        $('#dueDate').val(output_s[0]);
    });
});
</script>

@endsection