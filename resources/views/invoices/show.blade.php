@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
    <div class="container-fluid ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice</li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice Details</li>
            </ol>
        </nav>
    </div>
</nav>
@endsection
<div class="row p-2">
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
                        <p>{{$invoice->date->format('d/m/y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>{{__('labels.invoice_no')}}</b>
                        <p>{{$invoice->invoiceId}}</p>
                    </div>
                    <div class="col">
                        <b>{{__('labels.do_no')}}</b>
                        <p><a class="text-info" href="{{route('deliveryOrders.show',$invoice->deliveryOrder ? $invoice->deliveryOrder->id : 1)}}">
                                {{$invoice->deliveryOrder ? $invoice->deliveryOrder->do_no : 'N/A' }}
                            </a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Invoice Doc</b>
                        <p><a href="{{route('invoices.download',$invoice->id)}}" class="text-info" type="submit">{{$invoice->invoice_doc}}</a></p>
                    </div>
                    <div class="col">
                        <b>Amount</b>
                        <p>RM {{convert_currency($invoice->amount)}}</p>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
    @endsection