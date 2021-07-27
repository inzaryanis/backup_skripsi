<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>CSIS Admin</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('admin/assets/img/CSIS.png')}}" type="image/x-icon"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/dist/multi.min.css')}}" />

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="{{asset('admin/assets/dist/multi.min.js')}}"></script>

	<!-- Fonts and icons -->
	<script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('admin/assets/css/fonts.min.css')}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
	
		<!-- DATATABLES -->
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
       
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo">
					<img src="{{asset('admin/assets/img/logo_db.png')}}" alt="navbar brand" class="navbar-brand" height="50px" width="100px">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="red">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
						<img src="{{asset('admin/assets/img/teks_csis.png')}}" alt="navbar brand" class="navbar-brand" height="40px" width="400px">
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										{{auth()->user()->name}} 									
									</div>
								</li>
								
								<li>
									<a class="see-all" href="/logout">Logout</a>
								</li>
							</ul>
						</li>					
			<!-- End Navbar -->
		</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="info">
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
          <li class="nav-item">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<span class="red"></span>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#report">
								<i class="fas fa-th-list"></i>
								<p>Monthly Report</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="report">
								<ul class="nav nav-collapse">
									<li>
										<a href="">
											<span class="sub-item">Visitation Report</span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">GPS Maintenance Report</span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Technician Work Times Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Terminate and Extension of OSLOG Service Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Terminate and Activation of GSM Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Terminate of GSM error Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Equipment Used Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Amount of Free Visit Report </span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Amount of Paid Visit Report </span>
										</a>
									</li>
								</ul>
							</div>
						</li>
							
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>
						<li class="nav-item">
							<a href="/gps_installation">
								<i class="fas fa-map-marker"></i>
								<p>Master Data GPS</p>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="/home">
								<i class="fas fa-layer-group"></i>
								<p>Part</p>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-th-list"></i>
								<p>Customer</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<li>
										<a href="/customer">
											<span class="sub-item">Customer</span>
										</a>
									</li>
									<li>
										<a href="customer_address">
											<span class="sub-item">Address</span>
										</a>
									</li>
									<li>
										<a href="customer_contact">
											<span class="sub-item">Contact</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<!-- <li class="nav-item">
							<a href="/rfs">
								<i class="fas fa-layer-group"></i>
								<p>Request For Service api</p>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
								</ul>
							</div>
						</li> -->
						<li class="nav-item">
							<a href="/request">
								<i class="fas fa-layer-group"></i>
								<p>Request For Service</p>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#hh">
								<i class="fas fa-pen-square"></i>
								<p>Inventory</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="hh">
								<ul class="nav nav-collapse">
									<li>
										<a href="">
											<span class="sub-item">GPS</span>
										</a>
									</li>
									<li>
										<a href="/gsm">
											<span class="sub-item">GSM</span>
										</a>
									</li>
									<li>
										<a href="/inventory">
											<span class="sub-item">Inventory</span>
										</a>
									</li>
									
									<!-- <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="sub-item">GSM</span></a>
										<ul class="dropdown-menu">
										<li><a href="#">Penerimaan</a></li>
										<li><a href="#">Pengiriman</a></li>
										<li><a href="#">Activasi</a></li>
										<li><a href="#">Terminasi</a></li>
										</ul>
									</li> -->
									<li>
										<a href="forms/forms.html">
											<span class="sub-item">Consumable</span>
										</a>
									</li>
									<li>
										<a href="forms/forms.html">
											<span class="sub-item">Tools</span>
										</a>
									</li>
									<li>
										<a href="forms/forms.html">
											<span class="sub-item">Accessories</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="fas fa-pen-square"></i>
								<p>Work Order</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
								<li>
										<a href="/workorder">
											<span class="sub-item">Index</span>
										</a>
									</li>
									<li>
										<a href="/install">
											<span class="sub-item">Instalation and Mutation of GPS</span>
										</a>
									</li>
									<li>
										<a href="/maintenance">
											<span class="sub-item">Instalation and Mutation of GPS</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						
					<div class="collapse" id="submenu">
								<ul class="nav nav-collapse">
									<li>
										<a data-toggle="collapse" href="#subnav1">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav1">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a data-toggle="collapse" href="#subnav2">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav2">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="#">
											<span class="sub-item">Level 1</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
							
							</div>
							
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">@yield('card_title')</div>
									<!-- <div class="card-category">Daily information about statistics in system</div> -->
									<!-- <div class="d-flex flex-wrap justify-content-around pb-2 pt-4"> -->
										@yield('isi')
									</div>
								</div>
							</div>
						</div>
						
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		
<!--   Core JS Files   -->
	<!-- <script src="{{asset('admin/assets/js/core/jquery.3.2.1.min.js')}}"></script> -->
	<script src="{{asset('admin/assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{asset('admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{asset('admin/assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{asset('admin/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{asset('admin/assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{asset('admin/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>


	
	@yield("skrip")
</body>
</html>
@yield('modal');