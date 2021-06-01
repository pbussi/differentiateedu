<html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" contenavnt="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Xtreme lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Differentiate Education</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{asset("assets/images/favicon.png")}}>
    <!-- Custom CSS -->
    <link href={{asset("assets/libs/chartist/dist/chartist.min.css")}} rel="stylesheet">
    <!-- Custom CSS -->
    <link href={{asset("dist/css/style.css")}} rel="stylesheet">
 
    <link href={{asset("dist/css/bootstrap-switch.min.css")}} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        .ui-autocomplete-loading {
    background: white url("{{asset("assets/images/ui-anim_basic_16x16.gif")}}") right center no-repeat;}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and medAia queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" 
                      @if (Auth::user()->students->count()>0)
                            href="{{route('myactivities')}}">
                      @endif
                        @if (Auth::user()->teachers->count()>0)
                             href="{{route('mycourses')}}">

                        @endif
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src={{asset("assets/images/logo-icon.png")}} alt="homepage" class="dark-logo"/>
                            <!-- Light Logo icon -->
                            <img src={{asset("assets/images/logo-light-icon.png")}}  alt="homepage" class="light-logo"/>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src={{asset("assets/images/differenciate_logo1.png")}} alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src={{asset("assets/images/differenciate_logo1.png")}} class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                   <ul class="navbar-nav float-start me-auto">
                       
                     
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:15px">
                                <img src={{asset("assets/images/users/1.jpg")}} alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href={{url("userProfile")}}/{{Auth::User()->id}}><i class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                              
                                <a class="dropdown-item" href="{{url("logout")}}"><i class="ti-email m-r-5 m-l-5"></i>
                                    Logout</a>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>


  <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        @include('left_side_bar')



        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
<div class="page-wrapper">      
@include('flash')
</div>

       @yield('content')



    </div>
              
        

    <script src={{asset("assets/libs/jquery/dist/jquery.min.js")}}></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src={{asset("assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js")}}></script>

    <script src={{asset("dist/js/app-style-switcher.js")}}></script>
    <!--Wave Effects -->
    <script src={{asset("dist/js/waves.js")}}></script>
    <!--Menu sidebar -->
    <script src={{asset("dist/js/sidebarmenu.js")}}></script>
    <!--Custom JavaScript -->
    <script src={{asset("dist/js/custom.js")}}></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src={{asset("assets/libs/chartist/dist/chartist.min.js")}}></script>
    <script src={{asset("assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js")}}></script>
    <script src={{asset("dist/js/pages/dashboards/dashboard1.js")}}></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src={{asset("dist/js/jquery.numeric.js")}}></script>


    @yield('internal_scripts')



    </body>


</html>