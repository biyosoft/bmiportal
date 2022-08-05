@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order Details</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" style="max-width: 350px;">
                    {{session('success')}}
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">DO Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer Name</b>
                        <p>{{$deliveryOrder->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>{{__('labels.do_no')}}</b>
                        <p>{{$deliveryOrder->do_no}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>Invoice No</b>
                        <p>{{$deliveryOrder->invoice_id}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Due Date</b>
                        <p>{{$deliveryOrder->date->format('d/m/y')}}</p>
                    </div>
                </div>
                <div class="row">
                <div class="col">
                        <a href="{{route('deliveryOrder.download',$deliveryOrder->id)}}"  class="btn  bg-gradient-dark btn-sm align-middle mt-1" type="submit">{{$deliveryOrder->do_doc}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection