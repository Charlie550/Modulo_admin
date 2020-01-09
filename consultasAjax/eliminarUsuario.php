<?php

  try {

		session_start();
		require "../conectaClass.php";
		$db = new BaseDatos();

    $usuarioID=$_POST['usuarioID'];

		 $db->eliminarUsuario($usuarioID);
		 echo "correcto";

	} catch (mysqli_sql_exception $e) {
		 echo $e->getMessage();
	}

?>
