@extends('layouts.main1')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Customers</li>
        </ol>
    </nav>
   </div>
</nav>
<div class="card">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Company</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
          <th class="text-secondary opacity-7">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
            <td>
            <p class="text-xs font-weight-bold mb-0 text-center">{{$user->id}}</p>
            </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-xs">{{$user->name}}</h6>
                <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
              </div>
            </div>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0">{{$user->company}}</p>
          </td>
          <td class="align-middle text-center text-sm">
            <span class="badge badge-sm {{$user->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$user->status == 0 ? 'Inactive' : 'Active'}}</span>
          </td>
          <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->diffForHumans()}}</span>
          </td>
          <td class="align-middle">
            <a href="{{route('customers.edit',$user->id)}}" class="text-primary text-sm" data-toggle="tooltip" data-original-title="Edit user">
              Edit /
            </a>
            <a href="javascript:;" class="text-secondary text-sm" data-toggle="tooltip" data-original-title="Edit user">
                Delete
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection