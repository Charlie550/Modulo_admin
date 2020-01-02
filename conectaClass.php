<?php

	require "configDB.php";

	function crear_sesion($nombre,$clave,$nivel){

		$_SESSION['usr']=$nombre;
		$_SESSION['clave']=$clave;
		$_SESSION['nivel']=$nivel;
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



			//------------------- CONSULTAS TBL_USUARIO --------------------------
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

			public function getID($usuario,$password){

					$this->conectar();
					$query="SELECT usr_ID FROM `usuarios` WHERE usr_nombre='".$usuario."' AND usr_clave='".SHA1($password)."'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result['usr_ID'];

			}

			public function getNivel($id){

					$this->conectar();
					$query="SELECT usr_nivel FROM `usuarios` WHERE usr_ID='".$id."'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result['usr_nivel'];
			}
			//-----------------------------------------------------------------------


			//------------------------ CONSULTAS NIVELES ----------------------------

			public function getNivelesLista($usuarioID){

					$this->conectar();
					$query="SELECT niveles_lista FROM `tbl_niveles` WHERE niveles_usuarioID='".$usuarioID."'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result['niveles_lista'];
			}

			//-----------------------------------------------------------------------

			//------------------------ CONSULTAS MENUS ----------------------------
			public function getMenus($menuID){

					$this->conectar();
					$query="SELECT * FROM `tbl_menus` WHERE menuID='".$menuID."' AND menu_padre='menu'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result;
			}

			public function verificarSubMenus($menuID){
				$this->conectar();
	    	$query="SELECT COUNT(menuID) AS men FROM `tbl_menus` WHERE menu_padre='".$menuID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

	    	return $result['men'];
			}

			public function getSubMenus($menuID,$menuPadre){

				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE menuID='".$menuID."' AND menu_padre='".$menuPadre."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result;
			}
			//-----------------------------------------------------------------------

	}
?>
