<?php

	require "configDB.php";

	function crear_sesion($nombre,$clave){

		$_SESSION['usr']=$nombre;
		$_SESSION['clave']=$clave;
	}





	class BaseDatos
	{
	    protected $conexion;
	    protected $db;


	    public function conectar(){

	        $this->conexion = mysqli_connect(HOST, USER, PASS,DBNAME) or die("No se ha podido establecer conexion");
	    }

	    public function desconectar()
	    {
	        @mysqli_close($this->$conexion);
	    }




	    public function validar_usr($usuario,$clave){

			$this->conectar();

	    	$query="SELECT COUNT(usr_ID) AS usr FROM `usuarios` WHERE usr_nombre='".$usuario."' AND usr_clave='".SHA1($clave)."'";

			$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));

			$this->desconectar();

	    	if($result['usr']==1)
	    		return true;
	    	else
	    		return false;

	    }



	    /*public function insert_cuponesValidos($clave){

			$this->conectar();

	    	$query="INSERT INTO `cupones_validos` (`cuponID`, `cupon_clave`, `cupon_fechaC`) VALUES (NULL, '".$clave."', CURRENT_DATE());";
	    	mysqli_query($this->conexion,$query);

	    	$this->desconectar();

	    }



	    public function canjearTicket($clave){

			$this->conectar();

	    	$query="DELETE FROM `cupones_validos` WHERE `cupones_validos`.`cupon_clave` ='".$clave."'";
	    	mysqli_query($this->conexion,$query);

	    	$query2="INSERT INTO `cupones_canjeados` (`cuponCID`, `cuponc_clave`, `cuponc_fecha`) VALUES (NULL, '".$clave."', CURRENT_DATE());";
	    	mysqli_query($this->conexion,$query2);

	    	$this->desconectar();
	    }


	    public function leerCategoria($indice){

			$this->conectar();

	    	$query="SELECT cat_descripcion FROM categorias WHERE categoriaID='".$indice."'";

			$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));

			$this->desconectar();

	    	return $result['cat_descripcion'];
	    }


	    public function validarCupon($clave){

	    	$this->conectar();

	    	$query="SELECT COUNT(cuponID) AS cupon FROM `cupones_validos` WHERE cupon_clave='".$clave."'";

			$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));

			$this->desconectar();

	    	if($result['cupon']==1)
	    		return true;
	    	else
	    		return false;
	    }


	    public function validarClave($clave){

	    	$this->conectar();

	    	$query="SELECT COUNT(cuponCID) AS clave FROM `cupones_canjeados` WHERE cuponc_clave='".$clave."'";

			$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));


			if($result['clave']==1)
			mysqli_query($this->conexion,"DELETE FROM `cupones_canjeados` WHERE `cupones_canjeados`.`cuponc_clave` ='".$clave."'");


			$this->desconectar();


	    	if($result['clave']==1)
	    		return true;
	    	else
	    		return false;
	    }


	    public function printQR(){

	    	$this->conectar();

	    	$query="SELECT * FROM cupones_validos LIMIT 1";

			$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));

			$this->desconectar();

	    	return $result['cupon_clave'];
	    }
			*/
	}
?>
