@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Notifications</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card card-body">
                    <h5 class="font-weight-bolder mb-0">All Notifications</h5>
                    <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    <p></p>
                    <hr class="horizontal dark ">
                    @foreach($unread_notifications as $notification)
                        <div class="bg-light p-3 rounded mb-2">
                      <b><a href="{{route('customers.show',$notification->data['user_id'])}}">{{$notification->data['user_name']}}</a> 
                        </b>Has Uploaded The <b>Payment Proof</b> <br> To Invoice
                        <b><a href="{{route('invoices.show',$notification->data['invoice_id'])}}">{{$notification->data['invoice']}}</a></b>
                        <p>{{$notification->created_at}}
                        &nbsp;<i class="far fa-envelope-open text-primary"></i>
                        </p>
                        </div>
                    @endforeach
                    @foreach($read_notifications as $notification)
                        <div class="p-3 rounded">
                        <b><a href="{{route('customers.show',$notification->data['user_id'])}}">{{$notification->data['user_name']}}</a> 
                        </b>Has Uploaded The <b>Payment Proof</b> <br> To Invoice
                        <b><a href="{{route('invoices.show',$notification->data['invoice_id'])}}">{{$notification->data['invoice']}}</a></b>
                        <p>{{$notification->created_at}}</p>
                        </div>
                    @endforeach
                       <div class="row">
                        <div class="col">
                        <a style="float: right;" href="{{route('redall')}}"  class="btn bg-gradient-info">Read All</a>
                        </div>
                       </div>
                        
            </div>    
        </div> 
        </div>
    </div>
</div>
@endsection