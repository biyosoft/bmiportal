<!-- Navbar -->
<?php
use Illuminate\Support\Facades\Auth;
$customerName = Auth::user()->name;
?>

<div class="row mt-1">
  <div class="col-md-6">
    <!-- <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Client</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </nav> -->
  </div>
  <div class="col-md-6 ">
    <div class="mx-5 mt-3" style="float:right !important;">
      <ul class="d-flex">

        <li class="nav-item dropdown  d-flex align-items-center ">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer"></i>
          </a>
          @if(Auth()->check())
          @php
          $user = Auth()->user();
          $users = $user->unreadnotifications;
          @endphp
          <span style="background-color: #009fe3 ;" class="badge  text-white badge-sm m-1"><span id="msg">{{$users->count()}}</span></span>
          @endif

          <ul style="min-width: 270px;" class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            @if(Auth()->check())
            @php
            $user = Auth()->user();
            @endphp
            @foreach($user->unreadnotifications->take(4) as $notification)

            <li class="mb-2 bg-light rounded">
              <div style="min-width: 300px; padding:10px;">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-0">
                    <span class="font-weight-bold active ">Invoice<b> <a href="{{route('show_user_invoice',$notification->data['invoice_id'])}}">{{$notification->data['invoice_invoiceId']}}</a>
                      </b>Has Been Added By <br>
                      <b>{{$notification->data['admin_name']}}</b>

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
            @if(isset($user->unreadnotifications))
            <div id="unread-notifications" class="row justify-content-center mt-2">
              <div class="col" style="margin-left: 75px;">
                <a href="{{route('user.redall')}}" class="btn bg-light btn-sm text-xs px-3  ">Read All</a>
                <a href="{{route('user.paymentNotifications')}}" class="btn bg-dark btn-sm text-xs px-3 mx-2 text-white">View All</a>
              </div>
            </div>
            @else
            <div id="read-notifications">
              <p>No New Notifications !</p>
              <div class="p-2">
                <a href="{{route('user.paymentNotifications')}}" class="btn bg-dark btn-sm text-xs px-3 mx-2 text-white">View All</a>
              </div>
            </div>
            @endif
            @endif
          </ul>
        </li>
        <li class="nav-item px-1 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<hr class="horizontal dark mb-0 mt-0">
<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg blur">
    <div class="card-header pb-0 pt-3  bg-transparent ">
      <div class="float-start">
        <h5 class="mt-3 mb-0">{{$customerName}}</h5>
        <p>These are user profile settings</p>
      </div>
      <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0">
      <!-- Sidebar Backgrounds -->
      <!-- Sidenav Type -->
      <div class="mt-3">
        <a class="nav-link" href="{{route('profile')}}" class="nav-link " aria-controls="applicationsExamples" role="button" aria-expanded="false">
          <!-- <span class="nav-link-text ms-1">Change Password</span> -->
          <h6 class="mb-0">Profile</h6>
        </a>
      </div>
      <div class="mt-3">
        <a class="nav-link {{(request()->segment(1)=='change_password') ? 'active' : '' }}" href="{{route('change_password')}}" class="nav-link " aria-controls="applicationsExamples" role="button" aria-expanded="false">
          <!-- <span class="nav-link-text ms-1">Change Password</span> -->
          <h6 class="mb-0">Change Password</h6>
        </a>
      </div>
      <div class="mt-3">
        <form action="{{route('logout')}}" method="POST" id="logout-form">
          @csrf
        </form>
        <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link " aria-controls="applicationsExamples" role="button" aria-expanded="false">
          <!-- <span class="nav-link-text ms-1">Change Password</span> -->
          <h6 class="mb-0">Logout</h6>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- End Navbar -->

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const unreadnotificationscount = '<?php echo count($user->unreadnotifications) ?>';
    if (unreadnotificationscount == 0) {
      $('#unread-notifications').hide();
    } else {
      $('#read-notifications').hide();
    }

    $('.clickenvelope').on('click', function(e) {
      const par = $(e.target).closest('p');
      const id = par.find('.notification_id').val();
      const li = par.closest('li');

      //  const ul = li.parent();
      $.ajax({
        type: 'GET',
        url: 'user/markasred/' + id,
        data: '_token = <?php echo csrf_token() ?>',
        success: function(data) {
          li.remove();
          const ul = par.closest('ul');
          if (ul.length == 0) {
            $('#read-notifications').show();
            $('#unread-notifications').hide();
          } else {
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