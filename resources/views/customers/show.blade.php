@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customer Details</li>
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
                        <h5 class="font-weight-bolder mb-0">Customer Details</h5>
                        <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    <div class="col">
                    <form action="{{route('customers.formStatus',$users->id)}}" method="post">
                        @csrf
                        @method('put')
                        @if($users->form_status == 1)
                        <button class="btn  bg-gradient-dark btn-sm align-middle mt-1" type="submit">Approve</button>
                        @endif
                    </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <b>Name</b>
                        <p>{{$users->name}}</p>
                    </div>
                    <div class="col">
                        <b>Email</b>
                        <p>{{$users->email}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Company</b>
                        <p>{{$users->company}}</p>
                    </div>
                    <div class="col">
                        <b>Phone</b>
                        <p>{{$users->phone}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection