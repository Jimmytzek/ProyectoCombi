<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./../css/util.css">
	<link rel="stylesheet" type="text/css" href="./../css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="./../images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="Correo" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="Contrasena" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" onclick="login()">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							se olvidó
						</span>
						<a class="txt2" href="usuario_recuve.php">
							la Contraseña ?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="usuario_registro.php">
							Crear Usuario
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script src="../js/main.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		function login(){
			var datos = {
				Correo: $('#Correo').val(),
				Contrasena: $('#Contrasena').val()
			};
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					window.location="usuario_index.php";
				}
			};
			xhttp.open("POST", "http://192.168.1.67/api.combis.com/v1/usuarios/login", true);
			xhttp.send(JSON.stringify(datos));
			// $.post("http://192.168.1.67/api.combis.com/v1/usuarios/login/", 
			// { json_string:JSON.stringify(json) }, (d) => {
			// 	console.log(d);
			// });
			// $.ajax({
			// 	method: "POST",
			// 	url: "http://localhost/api.combis.com/v1/usuarios/login/",
			// 	data: json,
    		// 	contentType: 'application/json',
			// 	success: function(data){
			// 		console.log("device control succeeded");
			// 	},
			// 	error: function(data){
			// 		console.log("Device control failed");
			// 	}
			// })
			// .done(function( msg ) {
			// 	alert( "Data Saved: " + msg );
			// }).fail(function( jqXHR, textStatus, x ) {
			// 	alert( "Request failed: " + textStatus );
			// });
		}
	</script>
<!--===============================================================================================-->

	<?php
	
	?>

</body>
</html>