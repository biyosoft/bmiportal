@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />

<style>
  .table-responsive{
    min-height: 300px;
  }
</style>
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
  <div class="card-body" >
    @if(session('success'))
    <div class="text-success">
      {{session('success')}}
    </div>
    @endif
    @if(session('error'))
    <div class="text-danger">
      {{session('error')}}
    </div>
    @endif
    <div class="accordion" id="accordionExample">
      <div class="accordion-item"> 
          <button name="searchFilter" class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
        <div id="collapseOne" class="accordion-collapse collapse filter-border" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form action="{{route('customers.index')}}" method="GET">
              {{-- <div class="row"></div> --}}
              <div class="accordion-body row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" name="name" type="text" id="example-text-input">
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Company</label>
                    <input class="form-control" name="company" type="text" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-email-input" class="form-control-label">Email</label>
                    <input class="form-control" name="email" type="email" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-tel-input" class="form-control-label">Phone</label>
                    <input class="form-control" name="phone" type="tel" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                      <option>Active</option>
                      <option>Inactive</option>
                    </select>
                  </div>
                </div>
                  @csrf
              </div>
                  <div class="button-row d-flex">
                    <button style="margin-right: 8%" class="btn bg-gradient-dark ms-auto mb-0 mt-4 js-btn-next" type="submit">Apply</button>
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
              <!-- <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7">ID</th> -->
              <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Name</th>
              <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Company</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Status</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Phone</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Created At</th>
              <th class="text-dark opacity-7">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
                <!-- <td>
                  <p class="text-xs font-weight-bold mb-0 ">{{$user->id}}</p>
                </td> -->
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">{{$user->name}}</h6>
                    <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{$user->company}}</p>
              </td>
              <td class="align-middle  text-sm">
                <span class="badge badge-sm {{$user->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$user->status == 0 ? 'Inactive' : 'Active'}}</span>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
              </td>
              
              <td class="align-middle ">
                <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->diffForHumans()}}</span>
              </td>
              
              <td class="align-middle" >
                <div class="dropdown" >
                  <button class="btn bg-gradient-info btn-sm mt-3 " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg style="fill: white;" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{route('customers.show',$user->id)}}">View</a></li>
                    <li><a class="dropdown-item" href="{{route('customers.edit',$user->id)}}">Edit</a></li>
                    <!-- <li>
                      <form action="{{route('customers.delete',$user->id)}}" method="post">
                        @csrf
                        @method('delete')
                      <button type="submit" class="dropdown-item" href="">Delete</button>
                      </form>
                    </li> -->
                  </ul>
                </div>
              </td>
              <td>
            <!-- <form action="{{route('customers.formStatus',$user->id)}}" method="post">
              @csrf
              @method('put')
            <button class="btn btn-primary btn-sm align-middle mt-1" type="submit">Approve</button>
            </form> -->
              </td>
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{ $users->links() }}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection