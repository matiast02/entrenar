<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Templum - Entrenamiento</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/colors.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ URL::asset('js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/plugins/forms/selects/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('js/plugins/loaders/pace.min.js')}}"></script>
    @yield('scripts_header')
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ URL::asset('js/core/app.js')}}"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/home')}}"><b>Templum</b></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						@yield('usuario-imagen')
						<img src="{{ URL::asset('images/image.png')}}" alt="">
						<span>@yield('usuario-nombre')</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="{{ URL::asset('images/image.png')}}" class="img-circle img-sm" alt="">@yield('usuario-imagen')</a>
								<div class="media-body">
									<span class="media-heading text-semibold">@yield('usuario-nombre')</span>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<!-- Main -->
								@yield('menu')
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

								<li><a href="../../../../limit%20less%20Package%201.4/layout_1/LTR/default/index.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

								<li>
									<a href="#"><i class="fa fa-group"></i> <span>Clientes</span></a>
									<ul>
										<li><a href="{{URL::route('listar.clientes')}}">Gestionar Clientes</a></li>
										<li><a href="{{URL::route('crear.clientes')}}">Nuevo Cliente</a></li>
										<li><a href="{{URL::route('ver.asistencias')}}">Asistencias</a></li>
                                        <li><a href="{{URL::route('eliminados.clientes')}}">Clientes Eliminados</a></li>
										<li><a href="{{URL::route('buscar.clientes')}}">Test Incremental</a></li>
										<li><a href="{{URL::route('listar.evaluaciones')}}">Resultados</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-hand-rock-o"></i> <span>Ejercicios</span></a>
									<ul>
										<li><a href="{{URL::route('listar.categoria_ejercicios')}}">Gestionar Categorias de Ejercicios</a></li>
										<li><a href="{{URL::route('crear.categoria_ejercicios')}}">Nuevo Categoria de Ejercicio</a></li>
										<li><a href="{{URL::route('listar.ejercicios')}}">Gestionar Ejercicios</a></li>
										<li><a href="{{URL::route('crear.ejercicios')}}">Nuevo Ejercicio</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-sun-o"></i> <span>Antropometrias</span></a>
									<ul>
										<li><a href="{{URL::route('listar.antropometrias')}}">Gestionar Antropometrias</a></li>
										<li><a href="{{URL::route('crear.antropometrias')}}">Nueva Antropometria</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-futbol-o"></i> <span>Deportes</span></a>
									<ul>
										<li><a href="{{URL::route('listar.deportes')}}">Gestionar Deportes</a></li>
										<li><a href="{{URL::route('crear.deportes')}}">Nuevo Deporte</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-th-list"></i> <span>Categorias</span></a>
									<ul>
										<li><a href="{{URL::route('listar.categorias')}}">Gestionar Categoria</a></li>
										<li><a href="{{URL::route('crear.categorias')}}">Nueva Categoria</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-bookmark"></i> <span>Indicadores</span></a>
									<ul>
										<li><a href="{{URL::route('crear.indicadores')}}">Nuevo Indicador</a></li>
										<li><a href="{{URL::route('listar.indicadores')}}">Indicadores Semanales</a></li>
										<li><a href="{{URL::route('listar-mes.indicadores')}}">Indicadores Mensuales</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class=" fa fa-dollar"></i> <span>Pagos</span></a>
									<ul>
										<li><a href="{{URL::route('listar.pagos')}}">Gestionar Pagos</a></li>
										<li><a href="{{URL::route('crear.pagos')}}">Nuevo Pago</a></li>
										<li><a href="{{URL::route('clientepago.crearClientePago')}}">Pago Mensual</a></li>
										<li><a href="{{URL::route('clientepago.listaClientePago')}}">Deudores</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-bar-chart"></i> <span>Reportes</span></a>
									<ul>
										<li><a href="{{URL::route('deportista.reportes')}}">Reporte por Deportista</a></li>
										<li><a href="{{URL::route('deportista.reportes')}}">Reporte por categorias</a></li>
										<li><a href="{{URL::route('reporte-evaluaciones')}}">Reporte de Evaluaciones</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-bar-chart"></i> <span>Pdfs</span></a>
									<ul>
										<li><a href="{{URL::route('pdfs.reportes')}}">PDF</a></li>
										{{--<li class="active"><a href="javascript:void(0);" onclick="cargarlistado(3,1);" ><i class="fa fa-circle-o"></i> PDF </a></li>--}}
									</ul>
								</li>

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">@yield('titulo')</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							@yield('ruta')
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					@yield('contenido')

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2017. <a href="#">Derechos reservados</a> <a href="http://themeforest.net/user/Kopyov" target="_blank">Rivera - Terradas</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	@yield('scripts')
</body>
</html>
