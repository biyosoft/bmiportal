<!-- Navbar -->

<div class="row mt-2">
  <div class="col-md-6">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
      <div class="container-fluid py-1 px-3">
        <!-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav> -->
      </div>
    </nav>
  </div>
  <div class="col-md-6 ">
    <div class="mx-5 mt-3" style="float:right !important;">
      <ul class="">
        <li class="nav-item dropdown  d-flex align-items-center ">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer"></i>
          </a>
          @if(Auth::guard('admin')->check())
          @php
          $admin = Auth::guard('admin')->user();
          $admins = $admin->unreadnotifications;
          @endphp
          <span style="background-color: #009fe3 ;" class="badge  text-white badge-sm m-1"><span id="msg">{{$admins->count()}}</span></span>
          @endif

          <ul style="min-width: 270px;" class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            @if(Auth::guard('admin')->check())
            @php
            $admin = Auth::guard('admin')->user();
            @endphp
            @foreach($admin->unreadnotifications->take(4) as $notification)

            <li class="mb-2 bg-light rounded">
              <div style="min-width: 300px; padding:10px;">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-0">
                    <span class="font-weight-bold active "><b> <a href="{{route('customers.show',$notification->data['user_id'])}}">{{$notification->data['user_name']}}</a>
                      </b>Has Uploaded The <b>Payment Proof</b> <br> To Invoice
                      <b><a href="{{route('invoices.show',$notification->data['invoice_id'])}}">{{$notification->data['invoice']}}</a></b>

                    </span>
                  </h6>
                  <p class="text-xs text-secondary mb-0 mt-1">
                    <i class="fa fa-clock me-1"></i>
                    {{$notification->created_at}}
                    <input class="notification_id" type="hidden" name="notification_id" value="{{$notification->id}}" id="message-{{$notification->id}}">
                    <a class="clickenvelope" style="margin-left: 15px;" href="javascript:void(0);" class="text-xs text-dark mb-0" id="enevelope"><i class="far fa-envelope-open"></i></a>
                  </p>
                </div>
              </div>
              </a>
            </li>
            @endforeach
            <hr>
            <div id="unread-notifications" class="row justify-content-center mt-2">
              <div class="col" style="margin-left: 75px;">
                <a href="{{route('redall')}}" class="btn bg-light btn-sm text-xs px-3  ">Read All</a>
                <a href="{{route('paymentNotifications')}}" class="btn bg-dark btn-sm text-xs px-3 mx-2 text-white">View All</a>
              </div>
            </div>

            <div id="read-notifications">
              <p>No New Notifications !</p>
              <div class="p-2">
                <a href="{{route('paymentNotifications')}}" class="btn bg-dark btn-sm text-xs px-3 mx-2 text-white">View All</a>
              </div>
            </div>
            @endif
          </ul>
      </ul>
    </div>
  </div>
</div>
<hr class="horizontal dark mb-0 mt-0">
<!-- End Navbar -->

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const unreadnotificationscount = '<?php echo count($admin->unreadnotifications) ?>';
    if (unreadnotificationscount == 0) {
      $('#unread-notifications').hide();
    } else {
      $('#read-notifications').hide();
    }

    $('.clickenvelope').on('click',function(e){
      const par = $(e.target).closest('p');
      const id = par.find('.notification_id').val();
      const li = par.closest('li');

      //  const ul = li.parent();
      $.ajax({
        type: 'GET',
        url: '/markasred/' + id,
        data: '_token = <?php echo csrf_token() ?>',
        success: function(data) {
          li.remove();
          const ul = par.closest('ul');
          if (ul.length == 0) {
            $('#read-notifications').show();
            $('#unread-notifications').hide();
          }else{
            $('#read-notifications').hide();
            $('#unread-notifications').show();
          }
          $('#msg').html(data.msg);
          $('#enevelope').removeClass('text-primary');
          $('#enevelope').addClass('#text-dark');
        }
      });
    });
  });
</script>