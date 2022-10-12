@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">DO</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload DO</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
   <div class="container-fluid p-2">
   <div class="row">
        <div class="col-10 col-lg-10">
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">{{__('labels.upload_delivery_order')}}</h5>
            <p class="mb-0 text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            &nbsp;
            <span class="text-success">
            @if(session('success'))
            {{session('success')}}
            @endif
            </span>
            </p>
            <hr class="horizontal dark mt-2">
            <form action="{{route('deliveryOrder.upload1')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                <input name="file[]" type="file" multiple />
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2">Save DO's</button>
                </div>
            </form>
            
            </div>
            
        </div>
    </div>
   </div>
@endsection
<script>
    Dropzone.autoDiscover = false;
    var drop = document.getElementById('dropzone')
    var myDropzone = new Dropzone(drop, {
      url: "/file/post",
      addRemoveLinks: true

    });
  </script>
@section('scripts')
  <script src="{{asset('soft-theme/assets/js/plugins/dropzone.min.js')}}"></script>
  
@endsection