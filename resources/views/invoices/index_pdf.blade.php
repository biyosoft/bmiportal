@extends('layouts.main1')
@section('content')
<?php
  // print_r($invoices);die;
?>
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />


<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="card card-body p-2">
    @if(session('success'))
        <div class="alert alert-success text-white" style="max-width: 250px;">
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-white" style="max-width: 250px;">
            {{session('error')}}
        </div>
    @endif
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
          <button name="searchFilter" class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
          <a href="{{route('invoices.excel')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse filter-border" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form id="form1" action="{{route('invoices.index')}}" method="GET">
          <div class="accordion-body row">

              <div class="col-3">
                <select  style="width: 100%;" name="user_id" class="multi-select form-select">
                <option value="" disabled selected>Select User</option>
                  <?php
                    $users = get_all_users();
                  ?>
                  @foreach($users as $user)
                    <option value={{$user->id}}>{{$user->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-3">
                <input type="text" name="invoiceId" class="form-control" placeholder="invoice no">
              </div>
              <div class="col-3">
                <input class="form-control" name="date" type="date" placeholder="Date">
              </div>
              @csrf

              <div class="button-row d-flex">
                <button style="margin-right: 8%" class="btn bg-gradient-info ms-auto mb-0 mt-4 js-btn-next" type="submit">Apply</button>
            </div>
            
        </div>

          </form>
        </div>
      </div>
    </div>
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th style="display: none;" class="text-uppercase  text-dark text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer Name</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{__('labels.invoice_no')}}</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{__('labels.do_no')}}</th>
                  <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Due Date</th>
                  <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Amount</th>
                  <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Created at</th>
                  <th class="text-dark opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td style="display: none;">
                    <p class="text-xs font-weight-bold mb-0 ">{{$invoice->id}}</p>
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
                        <p class="text-xs text-secondary mb-0">{{$invoice->deliveryOrder ? $invoice->deliveryOrder->do_no : 'N/A'}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->date->format("m/d/Y")}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">RM {{ convert_currency($invoice->amount)}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle ">
                    <span class="text-secondary text-xs font-weight-bold">{{$invoice->created_at ?  $invoice->created_at : 'N/A'}}</span>
                  </td>
                  <td class="align-middle">
                  <div class="dropdown" >
                      <button class="btn bg-gradient-info btn-sm mt-3 " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <svg style="fill: white;" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{route('invoices.show',$invoice->id)}}">View</a></li>
                        <li><a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}">Edit</a></li>
                        <li>
                          <form action="{{route('invoices.destroy',$invoice->id)}}" method="post">
                            @csrf
                            @method('delete')
                          <button type="submit" class="dropdown-item" href="">Delete</button>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <tr>
                  
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
@section('scripts')
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
<script>
  function thousandSeparator(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
</script>
@endsection