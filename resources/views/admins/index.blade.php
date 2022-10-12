@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admins</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All admins</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card p-2 mt-2">
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <!-- <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">ID</th> -->
              <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Name</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Created At</th>
              <th class="text-secondary opacity-7">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($admins as $admin)
            <tr>
                <!-- <td>
                <p class="text-xs font-weight-bold mb-0 text-center">{{$admin->id}}</p>
                </td> -->
              <td>
                <div class="d-flex px-2 py-1">
                  <!-- <div>
                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                  </div> -->
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">{{$admin->name}}</h6>
                    <p class="text-xs text-secondary mb-0">{{$admin->email}}</p>
                  </div>
                </div>
              </td>
              <td class="">
                <span class="text-secondary text-xs font-weight-bold">{{$admin->created_at ?  $admin->created_at->diffForHumans() : 'N/A'}}</span>
              </td>
              <td class="align-middle">
                <a href="javascript:;" class="text-primary text-sm" data-toggle="tooltip" data-original-title="Edit admin">
                  Edit /
                </a>
                <a href="javascript:;" class="text-secondary text-sm" data-toggle="tooltip" data-original-title="Edit admin">
                    Delete
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{$admins->links()}}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection