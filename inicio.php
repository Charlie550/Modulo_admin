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
