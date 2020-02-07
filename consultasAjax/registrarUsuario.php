<?php
	try {

		session_start();
		require "../conectaClass.php";
		$db = new BaseDatos();

		$nombreUsr=$_POST['nombreUsr'];
		$claveUsr=$_POST['claveUsr'];
		$nivelUsr=$_POST['nivelUsr'];

		 $db->registrarUsuario($nombreUsr,$claveUsr,$_SESSION['id'],$nivelUsr);
		 echo "correcto";

	} catch (mysqli_sql_exception $e) {
		 echo $e->getMessage();
	}
?>
