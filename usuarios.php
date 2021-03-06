<?php

  session_start();

  @$host=$_SERVER['HTTP_REFERER']; //PARA VALIDAR QUE EL USUARIO NO INTRODUJO LA URL DIRECTA SIN PASAR POR EL LOGIN
  $host=explode('?', $host);


  if($host[0]==''){

    printAccessError();

  }else{

    if(isset($_SESSION['usr'])){

      require "conectaClass.php";
      require 'menu.php';
			$db = new BaseDatos();
      printHTML();

    }else{
      printAccessError();
    }
  }




  function printHTML(){

      global $db;

      echo "

      <!DOCTYPE html>
      <html lang='es' dir='ltr'>
        <head>
          <title></title>
          <meta charset='utf-8'>
          <script src='js/sweetalert2.all.min.js'></script>
          <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>

          <script src='js/enviosAjax.js'></script>
          <link rel='stylesheet' href='css/inicio.css'>

          <script>
            function salir(){
              Swal.fire({
                icon: 'question',
                title: '¿Seguro que desea salir?',
                text: 'Confirmar cierre de sesión',
                showCancelButton: true,
              }).then((result) => {
                if (result.value) {
                  sessionStorage.clear();
                  window.location='index.php';
                }
              })
            }
          </script>
          </head>
        <body>

          ";printMENU();echo"

            <div id='banner'>
              <div id='toolBox'>

                <h2 style='float:left; margin-left:20px;'>";$rutaDiv=explode('.',basename($_SERVER['PHP_SELF'])); echo $rutaDiv[0]."</h2>

                <table style='float:right;'>
                <tr>
                  <td rowspan='2'>      <img src='img/usuario.png' width='60px' height='60px'>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td style='font-size:20px; font-weight: bold;'>      ";echo $_SESSION['usr']."     </td>
                </tr>
                <tr><td><button onclick='salir();' style='background:red; font-size:17px; font-weight: bold; color:white; border-radius: 5px; cursor:pointer;' >Salir</button><td></tr>
                </table>

              </div>
            </div>


            <div id='desktop'>

              <form id='formUsuario' method='post'>

              <div id='filtro'>
                <div id='barraTitulo'><i class='ion-funnel'></i>&nbsp;&nbsp;Busqueda por filtros</div>
                <div id='filtroCont'>

                <table id='tableFiltros'>
                  <tr>

                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' name='name' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                    <td id='separador'></td>

                    <td>Nivel:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' name='nivel' type='text' placeholder='Nivel'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                  </tr>

                  <tr>
                    <td>Descripción:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' name='descripcion' type='text' placeholder='Descripción'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>
                  </tr>

                </table>

                <div class='container'><button class='skewBtn blue'>Buscar</button></div>

                </div>
              </div>



              <div id='contenido'>

              <a class='botonModal' href='#registrarUsuario' style='float:right;'>+</a><br><br><br>

              <table>
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th>Descripcion</th>
                    <th>Creado por usuario</th>
                    <th colspan='2'>Modificar</th>
                  </tr>
                </thead>
                <tbody>

                  ";

                    $rows=$db->getUsuarios();
                    foreach($rows as $row){

                      echo"
                      <tr>
                        <td>".$row['usr_nombre']."</td>
                        <td>".$db->getNivelesNivel($row['usr_nivel_ID'])."</td>
                        <td>".$db->getNivelDescripcion($row['usr_nivel_ID'])."</td>
                        <td>".$db->getUsuarioName($row['usr_usuarioIdCreo'])."</td>
                        <td id='edit'><a style='cursor:pointer; width:50px; height:50px;' onClick='modificarUsuario(\"".$row['usr_nombre']."\",".$row['usr_nivel_ID'].",".$row['usr_ID'].")'><i class='ion-edit'> Editar</a></i></td>
                        <td id='edit'><a style='cursor:pointer; width:50px; height:50px;' onClick='eliminarUsuario(".$row['usr_ID'].")'><i class='ion-trash-a'> Eliminar</a></i></td>
                      </tr>
                      ";
                    }

                  echo"

                </tbody>
                </table>
              </div>

              </form>
            </div>

            ";require "ModalsRegistrar.php";"

        </body>
      </html>
      ";
  }





  function printAccessError(){
    echo "
    <!DOCTYPE html>
    <html lang='es' dir='ltr'>
      <head>
        <meta charset='utf-8'>
        <script src='js/sweetalert2.all.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>

        <script>
          function showError(){
            Swal.fire({
              icon: 'error',
              title: 'Acceso denegado',
              text: 'Debe acceder desde el Login',
            })
          }
        </script>

        <META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>
      </head>
      <body onload='showError();'>

      </body>
    </html>
    ";

  }

?>
