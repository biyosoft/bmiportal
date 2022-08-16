@extends('layouts.main')
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
    <div class="col m-2">
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
                        <p>{{$invoice[0]->user->name}}</p>
                    </div>
                    <div class="col">
                        <b>Due Date</b>
                        <p>{{$invoice[0]->date}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Invoice Document</b>
                        <p><a style="color:#009fe3;" href="{{route('invoices.download',$invoice[0]->id)}}">
                            {{$invoice[0]->invoice_doc}}
                        </a></p>
                    </div>
                    <div class="col">
                        <b>Amount</b>
                        <p>{{convert_currency($invoice[0]->amount)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                @if($invoice[0]->payment)
                <div class="row">
                    <div class="col">
                        <b>Payment ID</b>
                        <p><a style="color:#009fe3;" href="{{route('payment.show',$invoice[0]->payment->id)}}" >{{$invoice[0]->payment->id}}</a></p>
                    </div>
                    <div class="col">
                        <b>Status</b>
                        <p><span class="badge badge-sm {{$invoice[0]->payment->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$invoice[0]->payment->status == 0 ? 'Pending For Approval' : 'Approved'}}</span></p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <b>Proof Document</b>
                        <p><a style="color:#009fe3;" href="{{route('payments.download',$invoice[0]->payment->id)}}">
                            {{$invoice[0]->payment->proof}}</a></p>
                    </div>
                    <div class="col">
                        <b>Paid At</b>
                        <p>{{$invoice[0]->payment->due_Date}}</p>
                    </div>
                </div>
                @else
                <a href="{{route('payments.create1',$invoice[0]->id)}}"
                class="btn text-white shadow  mt-1"
                style=" background-image: linear-gradient(310deg, #009fe3 0%, #009fe3 100%) !important;"
                >Add Payment</a>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection