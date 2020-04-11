<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Nujeks cargo management application.">
    <meta name="keywords" content="cargo, package, delivery, truck">
    <meta name="author" content="ArfianAgus">
    @if (trim($__env->yieldContent('pagetitle')))
    <h1>@yield('pagetitle')</h1>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/') }}app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/') }}app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/') }}app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/') }}app-assets/img/ico/apple-icon-152.png">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/app.css">
    <!-- END APEX CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">
    <!-- END Custom CSS-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('pagecss')
</head>
<body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">

      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <div data-active-color="white" data-background-color="man-of-steel" data-image="{{ asset('/') }}app-assets/img/sidebar-bg/05.jpg" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="{{ url('/admin/') }}" class="logo-text float-left">
              <div class="logo-img"><img src="{{ asset('images/vislog-logo.png') }}" width="32px" /></div><span class="text align-middle"> VISLOG</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true" class="navigation navigation-main">
              <li class=" home-nav nav-item"><a href="{{ url('/admin/highlight') }}"><i class="ft-award"></i><span data-i18n="" class="menu-title">Highlight</span></a></li>
              <li class=" home-nav nav-item"><a href="{{ url('/admin/dashboard') }}"><i class="ft-bar-chart-2"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>
              <li class=" nav-item"><a href="{{ url('/admin/adsperformance') }}"><i class="ft-activity"></i><span data-i18n="" class="menu-title">Ads Performance</span></a>
              </li>
              <li class="has-sub nav-item" id="cliplibrary"><a href="#"><i class="ft-film"></i><span data-i18n="" class="menu-title">Clip Library</span></a>
                <ul class="menu-content">
                  <li><a href="{{ url('/admin/tvads') }}" class="menu-item"><i class="ft-monitor"></i>TV Ads</a></li>
                  <li><a href="{{ url('/admin/tvprogramme') }}" class="menu-item"><i class="ft-play-circle"></i>TV Programme</a></li>
                </ul>
              </li>
              <li class="has-sub nav-item" id="marketingtools"><a href="#"><i class="ft-phone-call"></i><span data-i18n="" class="menu-title">Marketing Tools</span></a>
                <ul class="menu-content">
                  <li><a href="{{ url('/admin/mktsummary') }}" class="menu-item"><i class="ft-aperture"></i>Summary</a></li>
                  <li><a href="{{ url('/admin/adexnett') }}" class="menu-item"><i class="ft-target"></i>Adex Nett</a></li>
                  <li><a href="{{ url('/admin/spotmatching') }}" class="menu-item"><i class="ft-check-circle"></i>Spot Matching</a></li>
                </ul>
              </li>
              <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Administrator</span></a>
                <ul class="menu-content">
                  <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-upload-cloud"></i><span data-i18n="" class="menu-title">Upload Data</span></a>
                    <ul class="menu-content">
                      <li><a href="{{ url('/admin/uploaddata/commercial') }}" class="menu-item"><i class="ft-upload-cloud"></i>Commercial</a></li>
                      <li><a href="{{ url('/admin/uploaddata/commercialgrouped') }}" class="menu-item"><i class="ft-upload-cloud"></i>Commercial Grouped</a></li>
                      <li><a href="{{ url('/admin/uploaddata/tvprogramme') }}" class="menu-item"><i class="ft-upload-cloud"></i>TV Programme</a></li>
                      <li><a href="{{ url('/admin/uploaddata/adexnett') }}" class="menu-item"><i class="ft-upload-cloud"></i>Adex Nett</a></li>
                      <li><a href="{{ url('/admin/uploaddata/spotmatching') }}" class="menu-item"><i class="ft-upload-cloud"></i>Spot Matching</a></li>
                      <li><a href="{{ url('/admin/uploaddata/spotunpaired') }}" class="menu-item"><i class="ft-upload-cloud"></i>Spot Unpaired</a></li>
                    </ul>
                  </li>
                  <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-zoom-in"></i><span data-i18n="" class="menu-title">Upload Search Data</span></a>
                    <ul class="menu-content">
                      <li><a href="{{ url('/admin/uploadsearch/commercial') }}" class="menu-item"><i class="ft-zoom-in"></i>Commercial</a></li>
                      <li><a href="{{ url('/admin/uploadsearch/tvprogramme') }}" class="menu-item"><i class="ft-zoom-in"></i>TV Programme</a></li>
                      <li><a href="{{ url('/admin/uploadsearch/adstype') }}" class="menu-item"><i class="ft-zoom-in"></i>Ads Type</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('/admin/spotpairing') }}" class="menu-item"><i class="ft-voicemail"></i>Spot Pairing</a></li>
                  <li><a href="{{ url('/admin/videodataupdate') }}" class="menu-item"><i class="ft-video"></i>Video Data Update</a></li>
                  <li><a href="{{ url('/admin/targetaudience') }}" class="menu-item"><i class="ft-star"></i>Target Audiece</a></li>
                </ul>
              </li>
              <li class="has-sub nav-item" id="usermgt"><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">User Management</span></a>
                <ul class="menu-content">
                  <li><a href="{{ url('/admin/user') }}" class="menu-item"><i class="ft-user"></i>User</a>
                  </li>
                  <li><a href="{{ url('/admin/role') }}" class="menu-item"><i class="ft-users"></i>Role</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>
      <!-- / main menu-->


      <!-- Navbar (Header) Starts-->
      <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a></li>
                <li class="dropdown nav-item"><a id="dropdownBasic2" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-bell font-medium-3 blue-grey darken-4"></i><span class="notification badge badge-pill badge-danger">4</span>
                    <p class="d-none">Notifications</p></a>
                  <div class="notification-dropdown dropdown-menu dropdown-menu-right">
                    <div class="noti-list"><a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4"><i class="ft-bell info float-left d-block font-large-1 mt-1 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 info">New Order Received</span><span class="noti-text">Lorem ipsum dolor sit ametitaque in, et!</span></span></a><a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4"><i class="ft-bell warning float-left d-block font-large-1 mt-1 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 warning">New User Registered</span><span class="noti-text">Lorem ipsum dolor sit ametitaque in </span></span></a><a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4"><i class="ft-bell danger float-left d-block font-large-1 mt-1 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 danger">New Order Received</span><span class="noti-text">Lorem ipsum dolor sit ametest?</span></span></a><a class="dropdown-item noti-container py-3"><i class="ft-bell success float-left d-block font-large-1 mt-1 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 success">New User Registered</span><span class="noti-text">Lorem ipsum dolor sit ametnatus aut.</span></span></a></div><a class="noti-footer primary text-center d-block border-top border-top-blue-grey border-top-lighten-4 text-bold-400 py-1">Read All Notifications</a>
                  </div>
                </li>
                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                  @if (Auth::check()) 
                  <a href="#" class="dropdown-item py-1">Hi, <span>{{ Auth::user()->name }}</span></a>
                  @endif
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="ft-power mr-2"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        @yield('content')
        <!-- END : End Main Content-->

        <!-- BEGIN : Footer-->
        <footer class="footer footer-static footer-light">
          <p class="pull-left clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2019 Vislog, All rights reserved. </span></p>
        </footer>
        <!-- End : Footer-->

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('/') }}app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ asset('/') }}app-assets/js/app-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/js/customizer.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script>
      $(document).ready(function(){
          var current = location.pathname;
          if(current!=='/'){
            $('#main-menu-navigation li a').each(function(){
                var $this = $(this);
                if($this.attr('href') !== '{{ url('/admin/') }}'){
                  if(current.indexOf($this.attr('href').replace('{{ url('/admin/') }}','')) !== -1){
                    $this.parent('li').parent('ul').parent('li.has-sub').addClass('open');
                    $this.parent('li').addClass('active');
                  }
                }
            })
          }else{
            $('.home-nav').addClass('active');
          }
      })
    </script>
    <script>
      $(document).ready(function(){
        if(!$("#masterdata>ul").children().length){
          $("#masterdata").hide();
        }
        if(!$("#usermgt>ul").children().length){
          $("#usermgt").hide();
        }
      });
    </script>
    @yield('pagejs')
    <!-- END PAGE LEVEL JS-->
    @yield('modal')
  </body>
</html>
