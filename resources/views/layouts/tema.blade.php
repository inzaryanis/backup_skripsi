<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/vendors/nprogress/nprogress.css" rel="stylesheet')}}">
    <!-- iCheck -->
    <link href="{{asset('admin/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
    
    

    <link href="{{asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/css/bootstrap-select.min.css">


    <!-- Custom Theme Style -->
    <link href="{{asset('admin/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src="{{asset('admin/img/logo_fix.png')}}" height="44px" width="150px"> <span></span></a>
            </div>
            <!-- <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src="{{asset('admin/img/logo (1).png')}}" alt="navbar brand" class="navbar-brand" height="50px" width="50px">
             <span><b>CSIS</b></span></a>
            </div> -->

            <div class="clearfix"></div>

          

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              @php
                  $menu_s = session('menu');
                  foreach($menu_s as $data){
              @endphp
              <div class="menu_section">
                <h3>{{ $data['nama'] }}</h3>
                <ul class="nav side-menu">
                  @php
                  $menu = $data['menu'];
                    foreach($menu as $value){
                      if($value['url']=="#"){
                          $submenu = $value['sub_menu'];
                  @endphp
                          <li><a><i class="fa {{ $value['icon'] }}"></i>{{ $value['nama'] }}<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            @php
                            foreach($submenu as $sm){
                            @endphp
                                <li><a href="{{ $sm['url'] }}">{{ $sm['nama'] }}</a></li>
                            @php
                            }
                            @endphp
                          </ul>
                        </li>
                      @php
                      }else{
                      @endphp
                          <li><a href="{{ $value['url'] }}"><i class="fa {{ $value['icon'] }}"></i>{{ $value['nama'] }}</a>
                    @php
                      }
                    }
                    @endphp
                </ul>
              </div>
              @php
                  }
              @endphp
              <!-- <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i>Dashboard</a>
                   
                  <li><a><i class="fa fa-edit"></i> Monthly Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/Visitation">Visitation Report</a></li>
                      <li><a href="/gps_maintenance">GPS Maintenance Report</a></li>
                      <li><a href="/technician_work">Technician Work Times Report</a></li>
                      <li><a href="/terminate_extension">Terminate and Extension of OSLOG Service Report</a></li>
                      <li><a href="/terminate_activation">Terminate and Activation of GSM Report</a></li>
                      <li><a href="/terminate_error">Terminate of GSM error Report</a></li>
                      <li><a href="/equipment">Equipment Used Report</a></li>
                      <li><a href="/Amount_free">Amount of Free Visit Report</a></li>
                      <li><a href="/Amount_paid">Amount of Paid Visit Report</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                <li><a href="/gps_installation"><i class="fa fa-map-marker"></i> GPS Installation </a>
                  <li><a href="/home"><i class="fa fa-gear"></i> Part </a>

                  <li><a><i class="fa fa-users"></i> Customer <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/customer">Customer</a></li>
                      <li><a href="/customer_address">Address</a></li>
                      <li><a href="/customer_contact">Contact</a></li>
                    </ul>
                  </li>

                  <li><a href="/request"><i class="fa fa-sitemap"></i> Request For Service </a>

                 <li><a><i class="fa fa-calendar-o"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="/inventory">Inventory</a></li>
                      <li><a href="/gps_inventory">GPS</a></li>
                      <li><a href="/gsm">GSM</a></li>
                      <li><a href="/consummable">Consummable</a></li>
                      <li><a href="/tools">Tools</a></li>
                      <li><a href="/accessories">Accessories</a></li>
                    </ul>
                  </li>

                 <li><a><i class="fa fa-list-ul"></i> Workorder <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/install">Instalation and Mutation of GPS</a></li>
                      <li><a href="/maintenance">Maintenance GPS</a></li>
                    </ul>
                  </li>
                                     
                </ul>
              </div> -->

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i>{{auth()->user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="/logout"><i class="fa fa-sign-out pull-right"></i>Log Out</a>
                    </div>
                  </li>
  
                 
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>@yield('card_title') </h4>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <!-- <div class="card-box table-responsive"> -->
                   @yield('isi')
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

           
        <!-- /page content -->

       

    <!-- jQuery -->
    <script src="{{asset('admin/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
   <script src="{{asset('admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('admin/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('admin/vendors/nprogress/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('admin/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('admin/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('admin/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- Multiple Select -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/dist/multi.min.css')}}" />
    <script src="{{asset('admin/dist/multi.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/js/bootstrap-select.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('admin/build/js/custom.min.js')}}"></script>


    @yield("skrip")
  </body>
</html>
@yield("modal")