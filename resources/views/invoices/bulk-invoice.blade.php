@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Invoices</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            @if(session('success'))
            <span class="text-success">
                {{session('success')}}
            </span>
            @endif
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=0 ; $i<$files ; $i++)
           <div class="card mt-2">
        <div class="card-body">
           <h5 class="font-weight-bolder mb-0">Invoice #{{$i + 1}}</h5>
           <hr class="horizontal dark mt-2">

            <!-- company and name fields  -->
            <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select name="user_id[]" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice No</label>
                            <input value="{{$invoice_no[$i]}}" type="text" class="form-control" name="invoiceId[]" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice Date</label>
                            <input type="date" value="{{date('Y-m-d',strtotime($invoice_date[$i]))}}"  class="form-control invoiceDate" name="invoice_date[]" required>
                            <span class="text-danger">@error('invoiceDate') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input type="date"   class="form-control dueDate" name="date[]" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="amount" 
                            value="{{$amount[$i]}}"
                            class="form-control" 
                            name="amount[]" required>
                            <span   class="text-danger text-sm ">@error('amount') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">Invoice Document</label>
                            <input type="hidden" name="file[]" value="{{$prev_files[$i]}}">
                            <span class="badge badge-secondary p-3 badge-block  w-100">{{$prev_files[$i]}}</span>
                        </div>
                    </div>
            <!-- email and invoice fields  -->
                </div>
            <!-- amount and invoice ends  -->
            </div>
    </div>
           @endfor
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" 
                    type="submit">Upload Invoices</button>
                </div>
            </form>
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
</script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    //Add new due date on the invoice date with payment terms
    $(document).ready(function(){ 
        $('.invoiceDate').each(function(index , element){
                const invoiceDte = $(element).val();
                invoiceDate = new Date(invoiceDte);
                output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
                output_s = output_f[0].split('T');
                const dueDte = $(element).parent().parent().parent().find('.dueDate');
                dueDte.val(output_s[0]);
        }); 
    });
</script>
