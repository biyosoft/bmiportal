@extends('layouts.main')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Single Payment</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="row">
    <div class="col m-2">
        <div class="card mt-2">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Payment Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <b>Payment ID</b>
                        <p>{{$payment->id}}</p>
                    </div>
                    <div class="col">
                        <b>Status</b>
                        <p><span class="badge badge-sm {{$payment->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$payment->status == 0 ? 'Pending For Approval' : 'Approved'}}</span></p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <b>Proof Document</b>
                        <p><a style="color:#009fe3;" href="{{route('payments.download',$payment->id)}}">
                            {{$payment->proof}}</a></p>
                    </div>
                    <div class="col">
                        <b>Paid At</b>
                        <p>{{$payment->due_Date}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection