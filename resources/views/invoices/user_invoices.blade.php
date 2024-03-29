@extends('layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <a href="{{route('invoices.excel_user')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Id</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Doc</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>
              <th class="text-secondary opacity-7">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>
                <p class="text-xs font-weight-bold mb-0 text-center">{{$invoice->id}}</p>
                </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$invoice->user->name}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$invoice->invoiceId}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$invoice->date->format('m/d/y')}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">RM {{$invoice->amount}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$invoice->invoice_doc}}</p>
                  </div>
                </div>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{$invoice->created_at ?  $invoice->created_at->diffForHumans() : 'N/A'}}</span>
              </td>
              <td class="align-middle">
              <div class="dropdown" >
                  <button class="btn bg-gradient-info btn-sm mt-3 " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg style="fill: white;" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{route('show_user_invoice',$invoice->id)}}">View</a></li>
                    <li><a class="dropdown-item" href="{{route('payments.create1',$invoice->id)}}">Add Payment</a></li>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{$invoices->links()}}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection