

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
  input[type='text']{
    text-transform: uppercase;
  }  
  .invalidform{
    border: 1px solid red !important;
  }
  </style>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    O7services 
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
</head>
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic/dist/semantic.min.css') }}">

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.o7services.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ asset('assets/img/logo-small.png') }}">
          </div>
        </a>
        <a class="simple-text logo-normal">
          {{ Auth::user()->name }}
         
        </a>
      </div>
       <?php $current_route = Route::currentRouteName(); ?>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ Str::is('admin.dashboard',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.dashboard') }}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
         
         
          <li class="{{ Str::is('admin.enquiry.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.enquiry.index') }}">
              <i class="nc-icon nc-bell-55"></i> 
              <p>Enquiry</p>
            </a>
          </li>
          <li class="{{ Str::is('admin.registration.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.registration.index') }}">
              <i class="nc-icon nc-single-02"></i>
              <p>Registration</p>
            </a>
          </li>
          <li class="{{ Str::is('admin.calling.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.calling.index') }}">
              <i class="nc-icon nc-tile-56"></i>
              <p>Enquiry Calling List</p>
            </a>
          </li>
         <li class="{{ Str::is('admin.fee.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.fee.index') }}">
              <i class="nc-icon nc-caps-small"></i>
              <p>Fees Section</p>
            </a>
        </li>
        <li class="{{ Str::is('admin.degree.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.degree.index') }}">
              <i class="fa fa-graduation-cap"></i>
              <p>Degree Section</p>
            </a>
          </li>
        <li class="{{ Str::is('admin.college.*',$current_route) ? 'active':''}}">
            <a href="{{ route('admin.college.index') }}">
              <i class="nc-icon nc-laptop"></i>
              <p>College Section</p>
            </a>
          </li>
          
         
            <li class="{{ Str::is('admin.course.*',$current_route) ? 'active':''}}">
              <a href="{{ route('admin.course.index') }}">
                <i class="nc-icon nc-pin-3"></i>
                <p>Courses</p>
              </a>
            </li>
            <li class="{{ Str::is('admin.duration.*',$current_route) ? 'active':''}}">
                <a href="{{ route('admin.duration.index') }}">
                  <i class="fa fa-clock-o"></i>
                  <p>Course Duration</p>
                </a>
              </li>
            <li class="{{ Str::is('admin.context.*',$current_route) ? 'active':''}}">
                <a href="{{ route('admin.context.index') }}">
                  <i class="nc-icon nc-diamond"></i>
                  <p>Context</p>
                </a>
              </li>
    
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#">O7services Fees</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search..." id="searchbox">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">                      
           
              <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                
                <button class="nav-link btn-rotate" type="submit">
                  <i class="fa fa-sign-out"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
 <!--   Core JS Files   -->
 <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.0') }}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
  <!-- SWEET ALERT -->
  <script src="{{ asset('assets/sweetalert.min.js') }}"></script>
 
      <div class="content">
        @yield('context')
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <!-- <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav> -->
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i><b> by Karan Talwar</b>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.0') }}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
</body>
<script>
    $("#searchbox").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
</html>
