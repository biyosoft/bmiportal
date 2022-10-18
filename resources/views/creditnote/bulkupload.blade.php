@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">CN</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload CN</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2 mt-2">
   <div class="row ">
    <div class="col-10 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Credit Notes</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            @if(session('success'))
            <span class="text-success">
                {{session('success')}}
            </span>
            @endif
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('creditnote.upload1')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=0 ; $i<$files ; $i++)
           <div class="card mt-2">
        <div class="card-body">
           <h5 class="font-weight-bolder mb-0">CN #{{$i + 1}}</h5>
           <hr class="horizontal dark mt-2">

            <!-- company and name fields  -->
            <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select name="user_id[]" class="form-control">
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
                            <label for="customer">Delivery Order</label>
                            <select name="deliveryorder_id[]" class="form-control" required>
                                <option value="0" selected>Select DO</option>
                                @foreach($deliveryorders as $deliveryorder)
                                 <option value="{{$deliveryorder->id}}">{{$deliveryorder->do_no}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('deliveryorder_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.cn_no')}}</label>
                            <input value="{{$cn_no[$i]}}" type="text" class="form-control" name="cn_no[]" required>
                            <span class="text-danger">@error('cn_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="cn_doc">CN Document</label> <br>
                            <input type="hidden" name="cn_doc" value="{{$data[$i]}}">
                            <span class="badge badge-secondary p-3 badge-block  w-100">{{$data[$i]}}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.cn_date')}}</label>
                            <input type="date" value="{{date('Y-m-d',strtotime($cn_date[$i]))}}" class="form-control cnDate" name="cn_date[]" required>
                            <span class="text-danger">@error('cn_date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Payment Term</label>
                            <input  type="date" class="form-control dueDate" name="payment_term[]" required>
                            <span class="text-danger">@error('payment_term') {{$message}} @enderror</span>

                        </div>
                    </div>
                </div>
            <!-- amount and invoice ends  -->
            </div>
    </div>
           @endfor
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Upload CN</button>
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
        $('.cnDate').each(function(index , element){
                const invoiceDte = $(element).val();
                invoiceDate = new Date(invoiceDte);
                output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
                output_s = output_f[0].split('T');
                const dueDte = $(element).parent().parent().parent().find('.dueDate');
                dueDte.val(output_s[0]);
        }); 
    });
</script>
