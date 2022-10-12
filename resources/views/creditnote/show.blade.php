@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Credit Note</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">CN Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row p-2 mt-2">
    <div class="col">
        <div class="card ">
            <div class="card-body ">
                @if(session('success'))
                <div class="alert alert-success" style="max-width: 350px;">
                    {{session('success')}}
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">CN Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer Name</b>
                        <p>{{$creditnotes->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>{{__('labels.do_no')}}</b>
                        <p>{{$creditnotes->deliveryorder->do_no}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>CN Number</b>
                        <p>{{$creditnotes->cn_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>CN Date</b>
                        <p>{{$creditnotes->cn_date->format('d/m/y')}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Payment Term</b>
                        <p>{{$creditnotes->payment_term->format('d/m/y')}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>CN Document</b>
                        <p><a class="text-info">
                        {{$creditnotes->cn_doc}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection