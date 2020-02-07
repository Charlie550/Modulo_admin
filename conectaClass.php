<?php

	require "configDB.php";

	function crear_sesion($nombre,$clave,$nivel){

		$_SESSION['usr']=$nombre;
		$_SESSION['clave']=$clave;
		$_SESSION['nivel']=$nivel;
	}





	class BaseDatos
	{
	    public $conexion;
	    public $db;


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
					$query="SELECT usr_nivel_ID FROM `usuarios` WHERE usr_ID='".$id."'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result['usr_nivel_ID'];
			}

			public function getUsuarios(){

				$this->conectar();
				$query="SELECT * FROM `usuarios` WHERE 1";
				$result=mysqli_query($this->conexion,$query);

				while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$row[]=$rows;
				}

				$this->desconectar();

				return $row;
			}

			public function getUsuarioName($usuarioID){
				$this->conectar();
				$query="SELECT usr_nombre FROM `usuarios` WHERE usr_ID='".$usuarioID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result['usr_nombre'];
			}

			public function registrarUsuario($usr_nombre,$usr_clave,$usrIDcreo,$nivelID){
				$this->conectar();
				$query="INSERT INTO `usuarios` (`usr_ID`, `usr_nombre`, `usr_clave`,
					 `usr_usuarioIdCreo`, `usr_fechaCreo`, `usr_nivel_ID`, `usr_status`)
					  VALUES (NULL, '".$usr_nombre."', SHA1('".$usr_clave."'), '".$usrIDcreo."', CURRENT_DATE(),'".$nivelID."', '1');";

				$result=mysqli_query($this->conexion,$query);
				$this->desconectar();
			}
			//-----------------------------------------------------------------------


			//------------------------ CONSULTAS NIVELES ----------------------------

			public function getNivelesLista($usuarioID){//todos los menus y submenus a los que tiene acceso el usuario

					$this->conectar();
					$query="SELECT niveles_lista FROM `tbl_niveles` WHERE nivelesID='".$usuarioID."'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result['niveles_lista'];
			}

			public function getNiveles(){//todo el contenido de la tabla niveles
				$this->conectar();
				$query="SELECT * FROM `tbl_niveles` WHERE 1";
				$result=mysqli_query($this->conexion,$query);

				while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$row[]=$rows;
				}

				$this->desconectar();

				return $row;
			}


			public function getNivelDescripcion($nivelID){//la descripcion del nivel determinado

				$this->conectar();
				$query="SELECT niveles_descripcion FROM `tbl_niveles` WHERE nivelesID='".$nivelID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result['niveles_descripcion'];
			}

			public function getNivelesNivel($nivelID){//el identificador de un nivel determinado

				$this->conectar();
				$query="SELECT niveles_nivel FROM `tbl_niveles` WHERE nivelesID='".$nivelID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result['niveles_nivel'];
			}

			public function registrarNivel($nivel,$lista,$descripcion,$usrIDcreo){
				$this->conectar();
				$query="INSERT INTO `tbl_niveles` (`nivelesID`, `niveles_nivel`, `niveles_lista`,
					`niveles_descripcion`, `niveles_usrIdCreo`) VALUES (NULL, '".$nivel."', '".$lista."',
						'".$descripcion."', '".$usrIDcreo."');";

				$result=mysqli_query($this->conexion,$query);
				$this->desconectar();
			}


			//-----------------------------------------------------------------------

			//------------------------ CONSULTAS MENUS ----------------------------
			public function getMenus($menuID){//todo un registro que sea menu padre al que tenga acceso un usuario

					$this->conectar();
					$query="SELECT * FROM `tbl_menus` WHERE menuID='".$menuID."' AND menu_padre='menu'";
					$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
					$this->desconectar();

					return $result;
			}

			public function getAllMenusPadre(){//todos los menu padre que hay en la tabla

				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE menu_padre='menu'";
				$result=mysqli_query($this->conexion,$query);

				while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$row[]=$rows;
				}

				$this->desconectar();

				return $row;
			}

			public function getFilaMenu($menuID){//todo lo de un menu determinado
				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE menuID='".$menuID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result;
			}

			public function verificarSubMenus($menuID){//cuenta los submenus asociados a un menu determinado
				$this->conectar();
	    	$query="SELECT COUNT(menuID) AS men FROM `tbl_menus` WHERE menu_padre='".$menuID."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

	    	return $result['men'];
			}

			public function getSubMenus($menuID,$menuPadre){//todo del registro de los menus asociados a otro menu (submenus) a los que tenga acceso un usuario

				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE menuID='".$menuID."' AND menu_padre='".$menuPadre."'";
				$result=mysqli_fetch_assoc(mysqli_query($this->conexion,$query));
				$this->desconectar();

				return $result;
			}

			public function getAllSubmenusFromMenu($menuPadre){//todos los submenus de un determinado menu
				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE menu_padre='".$menuPadre."'";
				$result=mysqli_query($this->conexion,$query);

				while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$row[]=$rows;
				}

				$this->desconectar();

				return $row;
			}


			public function getAllFromMenu(){//todo el contenido de la tabla menu

				$this->conectar();
				$query="SELECT * FROM `tbl_menus` WHERE 1";
				$result=mysqli_query($this->conexion,$query);

				while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$row[]=$rows;
				}

				$this->desconectar();

				return $row;
			}


			//-----------------------------------------------------------------------

	}
?>
