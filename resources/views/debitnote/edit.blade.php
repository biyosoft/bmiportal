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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.dn')}}</li>
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
            <h5 class="font-weight-bolder mb-0">{{__('labels.update_dn')}}</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            &nbsp;
            <span class="text-success">
            @if(session('success'))
            {{session('success')}}
            @endif
            </span>

            </p>
            <hr class="horizontal dark mt-2">
            <!-- deliveryorder add form started here  -->
            <form action="{{route('debitnotes.update',$debitnote->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select name="user_id" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}" @if($debitnote->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="deliveryorder">{{__('labels.do')}}</label>
                            <select name="deliveryorder_id" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($deliveryorders as $deliveryorder)
                                 <option value="{{$deliveryorder->id}}" @if($debitnote->deliveryorder_id == $deliveryorder->id) selected @endif>{{$deliveryorder->do_no}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('deliveryorder_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.dn_no')}}</label>
                            <input value="{{$debitnote->dn_no}}" type="text" class="form-control" name="dn_no" required>
                            <span class="text-danger">@error('dn_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="DN_doc">DN Document</label>
                            <input value="{{$debitnote->dn_doc}}" type="file" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span id="file_prepopulate"></span>
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.dn_date')}}</label>
                            <input value="{{$debitnote->dn_date}}" type="date" class="form-control" name="dn_date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Payment Term</label>
                            <input value="{{$debitnote->payment_term}}" type="date" class="form-control" name="payment_term" required>
                            <span class="text-danger">@error('payment_term') {{$message}} @enderror</span>

                        </div>
                    </div>
               
            <!-- email and deliveryorder fields  -->
              
                    
                    
                </div>
            <!-- amount and deliveryorder ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update DN</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        var a = "<?= $debitnote->dn_doc; ?>";
        if (a) {
            $('.file').attr("required", false);
        }
        $('#file_prepopulate').text(a);
    });
</script>
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
@endsection
