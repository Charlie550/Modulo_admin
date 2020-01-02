<?php
//cadena registrar usuario: INSERT INTO `usuarios` (`usr_ID`, `usr_nombre`, `usr_clave`, `usr_usuarioCreo`, `usr_fechaCreo`, `usr_nivel`) VALUES (NULL, 'admin', SHA1('admin'), 'admin', CURRENT_DATE(), '1');

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
      echo "

      <!DOCTYPE html>
      <html lang='es' dir='ltr'>
        <head>
          <title></title>
          <meta charset='utf-8'>
          <script src='js/sweetalert2.all.min.js'></script>
          <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>

          <link rel='stylesheet' href='css/inicio.css'>

          <script>
            function salir(){
              Swal.fire({
                icon: 'warning',
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

              <div id='filtro'>
                <div id='barraTitulo'><i class='ion-funnel'></i>&nbsp;&nbsp;Busqueda por filtros</div>
                <div id='filtroCont'>

                <table id='tableFiltros'>
                  <tr>
                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                    <td id='separador'></td>

                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                    <td id='separador'></td>

                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                  </tr>

                  <tr>
                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                    <td id='separador'></td>

                    <td>Nombre:</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>

                    <td id='separador'></td>

                    <td>Apellido <br>paterno  :</td>
                    <td>
                      <div class='col-3 input-effect'>
                        <input class='effect-20' type='text' placeholder='Nombre'>  <span class='focus-border'><i></i></span>
                      </div>
                    </td>
                  </tr>
                </table>

                <div class='container' style='margin:60px 0px 0px 92%;'><button class='skewBtn blue'>Buscar</button></div>

                </div>
              </div>



              <div id='contenido'>

              <div class='container' style='float:right;'><button class='skewBtn blue' style='width:50px; font-weight: bold; font-size:30px'>+</button></div><br><br><br>

              <table>
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th>Estatus</th>
                    <th colspan='2'>Modificar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tent</td>
                    <td>1</td>
                    <td>ACTIVO</td>
                    <td id='edit'><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-edit'> Editar</a></i></td>
                    <td id='edit'><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-trash-a'> Eliminar</a></i></td>
                  </tr>

                  <tr>
                    <td>Tent</td>
                    <td>1</td>
                    <td>ACTIVO</td>
                    <td><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-edit'> Editar</a></i></td>
                    <td><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-trash-a'> Eliminar</a></i></td>
                  </tr>

                  <tr>
                    <td>Tent</td>
                    <td>1</td>
                    <td>ACTIVO</td>
                    <td><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-edit'> Editar</a></i></td>
                    <td><a style='cursor:pointer; width:50px; height:50px;'><i class='ion-trash-a'> Eliminar</a></i></td>
                  </tr>

                </tbody>
                </table>
              </div>

            </div>
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
