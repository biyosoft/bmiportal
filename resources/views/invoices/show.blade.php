@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice Details</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Invoice Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <b>Customer Name</b>
                        <p>{{$invoice->user->name}}</p>
                    </div>
                    <div class="col">
                        <b>Due Date</b>
                        <p>{{$invoice->date}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Invoice Doc</b>
                        <p>{{$invoice->invoice_doc}}</p>
                    </div>
                    <div class="col">
                        <b>Amount</b>
                        <p>{{$invoice->amount}}</p>
                    </div>
                </div>
                <div class="row">
                <div class="col">
                        <a href="{{route('invoices.download',$invoice->id)}}"  class="btn  bg-gradient-dark btn-sm align-middle mt-1" type="submit">{{$invoice->invoice_doc}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection