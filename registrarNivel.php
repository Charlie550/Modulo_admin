<?php
	try {

		session_start();
		require "conectaClass.php";
		$db = new BaseDatos();

		$listaNiveles=$_POST['listaNiveles'];
		$descripcionNivel=$_POST['descripcionNivel'];
		$nombreNivel=$_POST['nombreNivel'];

		$listaNiveles='1-'.$listaNiveles;

		$arrayMenus=explode('-',$listaNiveles);
		$MenusPadres=array();

		for($i=0;$i<sizeof($arrayMenus);$i++){

			$rowN=$db->getFilaMenu($arrayMenus[$i]);

			if($rowN['menu_padre']!="menu"){

				$comprobar=0;
				for($x=0;$x<sizeof($MenusPadres);$x++){

					if($rowN['menu_padre']==$MenusPadres[$x]){
						$comprobar++;
					}
				}
				if($comprobar==0){
					array_push($MenusPadres, $rowN['menu_padre']);
					$listaNiveles.='-'.$rowN['menu_padre'];
				}
			}

		}

		$db->registrarNivel($nombreNivel,$listaNiveles,$descripcionNivel,$_SESSION['id']);
		echo "correcto";

	} catch (mysqli_sql_exception $e) {
		 echo $e->getMessage();
	}
?>
