@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.delivery_order')}}</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">Add Delivery Order</h5>
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
            <form action="{{route('deliveryOrders.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select name="user_id" class="form-control multi-select">
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
                            <label for="invoice">Invoice</label>
                            <select name="invoice_id" class="form-control multi-select">
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
                            <label for="date">{{__('labels.do_no')}}</label>
                            <input type="text" class="form-control" name="do_no" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control" name="date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
               
            <!-- email and invoice fields  -->
              
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="do_doc">DO Document</label>
                            <input type="file" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                </div>
            <!-- amount and invoice ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Add DO</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
@endsection
