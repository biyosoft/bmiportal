@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid py-4">
  <div class="row">
    <div class="">
      <div class="row">
        <div class="col-md-3">
          <div class="card overflow-hidden">
            <div class="card-header p-3 ">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Visitors</p>
              <h5 class="font-weight-bolder mb-0">
                5,927
                <span class="text-success text-sm font-weight-bolder">+55%</span>
              </h5>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card overflow-hidden">
            <div class="card-header p-3 ">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Visitors</p>
              <h5 class="font-weight-bolder mb-0">
                5,927
                <span class="text-success text-sm font-weight-bolder">+55%</span>
              </h5>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 mt-sm-0 mt-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 ">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
              <h5 class="font-weight-bolder mb-0">
                $130,832
                <span class="text-success text-sm font-weight-bolder">+90%</span>
              </h5>
            </div>
          </div>
        </div>

        <div class="col-md-3 mt-sm-0 mt-4">
          <div class="card overflow-hidden">
            <div class="card-header p-3 ">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
              <h5 class="font-weight-bolder mb-0">
                $130,832
                <span class="text-success text-sm font-weight-bolder">+90%</span>
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="row mt-4">
    <div class="col-sm-6">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Dummy Table 1</h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2"></i>
              <small>23 - 30 March 2021</small>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                    <span class="text-xs">27 March 2020, at 12:30 PM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                  - $ 2,500
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2" />
            </li>
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Apple</h6>
                    <span class="text-xs">23 March 2020, at 04:30 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                  + $ 2,000
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2" />
            </li>
            <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Partner #22213</h6>
                    <span class="text-xs">19 March 2020, at 02:50 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                  + $ 1,400
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-6 mt-sm-0 mt-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Dummy Table 2</h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2"></i>
              <small>01 - 07 June 2021</small>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">via PayPal</h6>
                    <span class="text-xs">07 June 2021, at 09:00 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                  + $ 4,999
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2" />
            </li>
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Partner #90211</h6>
                    <span class="text-xs">07 June 2021, at 05:50 AM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                  + $ 700
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2" />
            </li>
            <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Services</h6>
                    <span class="text-xs">07 June 2021, at 07:10 PM</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                  - $ 1,800
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script src="{{asset('soft-theme/assets/js/plugins/fullcalendar.min.js')}}"></script>