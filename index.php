<?php

	session_start();
	$_SESSION = array();
	require "conectaClass.php";
	$db = new BaseDatos();

	if(@$_POST['username']==NULL){

		printHtml();

	}else{

		if($db->validar_usr($_POST['username'],$_POST['pass'])){

			crear_sesion($_POST['username'],$_POST['pass']);
			header("Location: inicio.php");
		}else

			printHtml();

	}


	function printHtml(){

		echo "
		<!DOCTYPE html>
		<html lang='es'>
		<head>

			<title>Sistema Administracion</title>
			<meta charset='UTF-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
		<!--===============================================================================================-->
			<link rel='icon' type='image/png' href='images/icons/favicon.ico'/>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/bootstrap/css/bootstrap.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='fonts/Linearicons-Free-v1.0.0/icon-font.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/animate/animate.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/css-hamburgers/hamburgers.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/animsition/css/animsition.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/select2/select2.min.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='vendor/daterangepicker/daterangepicker.css'>
		<!--===============================================================================================-->
			<link rel='stylesheet' type='text/css' href='css/loginUtil.css'>
			<link rel='stylesheet' type='text/css' href='css/loginMain.css'>
		<!--===============================================================================================-->


		<script src='js/sweetalert2.all.min.js'></script>
		<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>

		<script>
		function showError(){
			Swal.fire({
				icon: 'error',
				title: 'Usuario incorrecto',
				text: 'Favor de intentar de nuevo',
			})
		}
		</script>

		</head>
		";

			if(@$_POST['username']==NULL)
				echo "<body>";
			else
				echo "<body onload=showError();>";

		echo"


			<div class='limiter'>
				<div class='container-login100'>
					<div class='wrap-login100'>
						<div class='login100-form-title' style='background-image: url(img/login.jpg);'>
							<span class='login100-form-title-1'>
								Sistema de administracion
							</span>
						</div>

						<form class='login100-form validate-form' method='post'>
							<div class='wrap-input100 validate-input m-b-26' data-validate='El usuario es requerido'>
								<span class='label-input100'>Usuario</span>
								<input class='input100' type='text' name='username' placeholder='Ingresa tu usuario'>
								<span class='focus-input100'></span>
							</div>

							<div class='wrap-input100 validate-input m-b-18' data-validate = 'La clave es requerida'>
								<span class='label-input100'>Contraseña</span>
								<input class='input100' type='password' name='pass' placeholder='Ingresa tu contraseña'>
								<span class='focus-input100'></span>
							</div>

							<div class='flex-sb-m w-full p-b-30'>
								<div class='contact100-form-checkbox'>
									<input class='input-checkbox100' id='ckb1' type='checkbox' name='Recordarme'>
									<label class='label-checkbox100' for='ckb1'>
										Recordarme
									</label>
								</div>

								<div>
									<a href='#' class='txt1'>
										Olvidaste tu clave?
									</a>
								</div>
							</div>

							<div class='container-login100-form-btn'>
								<button class='login100-form-btn'>
									Iniciar
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		<!--===============================================================================================-->
			<script src='vendor/jquery/jquery-3.2.1.min.js'></script>
		<!--===============================================================================================-->
			<script src='vendor/animsition/js/animsition.min.js'></script>
		<!--===============================================================================================-->
			<script src='vendor/bootstrap/js/popper.js'></script>
			<script src='vendor/bootstrap/js/bootstrap.min.js'></script>
		<!--===============================================================================================-->
			<script src='vendor/select2/select2.min.js'></script>
		<!--===============================================================================================-->
			<script src='vendor/daterangepicker/moment.min.js'></script>
			<script src='vendor/daterangepicker/daterangepicker.js'></script>
		<!--===============================================================================================-->
			<script src='vendor/countdowntime/countdowntime.js'></script>
		<!--===============================================================================================-->
			<script src='js/loginMain.js'></script>

		</body>
		</html>
		";
	}



?>
