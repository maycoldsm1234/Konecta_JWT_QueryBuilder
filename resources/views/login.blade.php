<!DOCTYPE html>
<html lang="en">
	
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ asset('src/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('src/vendors/animate.css/animate.min.css') }}">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ asset('src/css/app.min.css') }}">
    </head>

    <body data-ma-theme="green">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Bienvenido, Inicie sesion.

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">olvidaste la contraseña?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" id="usuario" name="usuario" autocomplete="off" class="form-control">
                        <label>Usuario</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="password" name="pasword" id="pasword" autocomplete="off" class="form-control">
                        <label>Contraseña</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <button id="btn-login" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
                </div>
            </div>


            <!-- Forgot Password -->
            <div class="login__block" id="l-forget-password">
                <div class="login__block__header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Olvidaste la contraseña?

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Tiene cuenta?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <p class="mt-4">Se le enviara un email para recuperar la cuanta.</p>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control">
                        <label>Email</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <button href="index-2.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
                </div>
            </div>
        </div>
		
        <!-- Vendors -->
        <script src="{{ asset('src/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('src/vendors/popper.js/popper.min.js') }}"></script>
        <script src="{{ asset('src/vendors/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- App functions and actions -->
        <script src="{{ asset('src/js/app.min.js') }}"></script>
		<script>
			$(function(){
			  	$('body').on('click', '#btn-login', function(){
					$.ajax({
						url: "{{ route('login') }}",
						method: 'post',
						data: {
							username : $('#usuario').val(),
							password : $('#pasword').val(),
							"_token" : "{{ csrf_token() }}",
						},
						dataType: 'json',
						success: function(respuesta) {
						  if(respuesta.type == 'success'){
							  localStorage.setItem("token", respuesta.token.original.access_token);
							  localStorage.setItem("token_type", respuesta.token.original.token_type);
							  location.href = "{{ route('home') }}";
						  }else{
							  
						  }
						},
						error: function() {
						  console.log("No se ha podido obtener la información");
						}
					});
				});
			});
			
		</script>
    </body>

</html>