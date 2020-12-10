<!DOCTYPE html>
<html lang="en">

	<head>
        <meta charset="utf-8 ">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ asset('src/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
		<link rel="stylesheet" href="{{ asset('src/vendors/sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('src/vendors/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('src/vendors/jquery-scrollbar/jquery.scrollbar.css') }}">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ asset('src/css/app.min.css') }}">
		
    </head>

    <body data-ma-theme="green">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="#">Prueba Laravel Inicio</a></h1>
                </div>


                <ul class="top-nav">
                    <li class="dropdown hidden-xs-down">
                        <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item">Perfil</a>
                            <a class="dropdown-item btn-logout">Cerrar Session</a>
                        </div>
                    </li>
                </ul>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="{{ asset('src/demo/img/profile-pics/8.jpg') }}" alt="">
                            <div>
                                <div class="user__name">{{ Auth::user()->name }}</div>
                                <div class="user__email">{{ Auth::user()->roles()->first()->description }}</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item btn-logout">Cerrar Session</a>
                        </div>
                    </div>

                    <ul class="navigation">
						@if(Auth::user()->roles()->first()->name == 'admin')
							<!-- Solo lo muestra si es administrador -->
							<li><a href="{{ route('usuarios') }}"><i class="zmdi zmdi-account"></i> Usuarios</a></li>
						@endif
						<li><a href="{{ route('clientes') }}"><i class="zmdi zmdi-accounts-alt"></i> Clientes</a></li>                    
                    </ul>
                </div>
            </aside>

            <section class="content">
                <header class="content__title">
                    <h1>{{ $title }}</h1>
                </header>

                <div class="card">
                    <div class="card-body">
						@yield('content')
                    </div>
                </div>

                <footer class="footer hidden-xs-down">
                    <p>© Prueba Laarvel. Todos los Derechos Reservados.</p>

                    <p>Maycol Sanchez, Desarrollador.</p>
                </footer>
            </section>
        </main>

        <!-- Vendors -->
        <script src="{{ asset('src/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('src/vendors/popper.js/popper.min.js') }}"></script>
        <script src="{{ asset('src/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('src/vendors/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('src/vendors/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>

        <!-- App functions and actions -->
        <script src="{{ asset('src/js/app.min.js') }}"></script>
		<script type="application/javascript">
			$(function(){
			  	$('body').on('click', '.btn-logout', function(){
					$.ajax({
						url: "{{ route('logout') }}",
						data : {},
  						dataType : 'json',
						headers: {'Authorization': 'Bearer '+localStorage.getItem("token")},
						success: function(respuesta) {
						 	location.href = "{{ route('/') }}";
						},
						error: function() {
						  console.log("No se ha podido obtener la información");
						}
					});
				});
			});
		</script>
		@yield('script')
    </body>

</html>