@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Delivery Order</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection

<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">Edit Delivery Order</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            &nbsp;
            <span class="text-success">
            @if(session('success'))
            {{session('success')}}
            @endif
            </span>

            </p>
            <hr class="horizontal dark mt-2">
            <!-- deliveryOrder add form started here  -->
            <form action="{{route('deliveryOrders.update',$deliveryOrder->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="invoice_id" value="{{$deliveryOrder->invoice_id}}">
            <!-- company and name fields  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">{{__('labels.customer')}}</label>
                            <select name="user_id" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}"  @if($deliveryOrder->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invocieId">{{__('labels.do_no')}}</label>
                            <input type="text" value="{{$deliveryOrder->do_no}}" class="form-control" name="do_no" required>
                            <span class="text-danger">@error('deliveryOrderId') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.due_date')}}</label>
                            <input type="date" value="{{$deliveryOrder->date}}" class="form-control" name="date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
            <!-- email and deliveryOrder fields  -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="deliveryOrder_doc">{{__('labels.do_doc')}}</label>
                            <input type="file" class="form-control file" value="{{$deliveryOrder->do_doc}}" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span id="file_prepopulate"></span>
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                </div>
            <!-- amount and deliveryOrder ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update DO</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var a = "<?= $deliveryOrder->do_doc; ?>";
        if (a) {
            $('.file').attr("required", false);
        }
        $('#file_prepopulate').text(a);
    });
</script>

@section('scripts')
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
@endsection
