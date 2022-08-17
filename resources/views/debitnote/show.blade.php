@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Debit Note</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">DN Details</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="row">
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
                        <h5 class="font-weight-bolder mb-0">DN Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer Name</b>
                        <p>{{$debitnotes->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>{{__('labels.do_no')}}</b>
                        <p>{{$debitnotes->deliveryorder->do_no}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>DN Number</b>
                        <p>{{$debitnotes->dn_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DN Date</b>
                        <p>{{$debitnotes->dn_date->format('d/m/y')}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Payment Term</b>
                        <p>{{$debitnotes->payment_term->format('d/m/y')}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DN Document</b>
                        <p><a class="text-info">
                        {{$debitnotes->dn_doc}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection