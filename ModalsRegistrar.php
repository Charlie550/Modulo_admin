<?php

//MODAL REGISTRAR USUARIO
echo"
<div id='registrarUsuario' class='modal'>

      <form method='post'>

      <div id='filtro' style='width:60%; height:280px; margin:10% auto;'>
        <div id='barraTitulo' style='height:50px;'><i class='ion-person-add'></i>&nbsp;&nbsp;Agregar usuario<a class='closeModal' href='#'>X</a></div>
        <div id='filtroCont'>

        <table id='tableFiltros' style='width:95%;'>
          <tr>
            <td style='text-align:right;'>Nombre:</td>
            <td><input type='text' name='nombreUsuario' required></td>

            <td style='text-align:right;'>Contraseña:</td>
            <td><input type='password' name='claveUsuario' required></td>
          </tr>
          <tr>
          <td style='text-align:right;'>Nivel:</td>
          <td><select name='nivelUsuario'>";

          $rowsNiveles=$db->getNiveles();
          foreach($rowsNiveles as $rowN){
            echo"
              <option value='".$rowN['nivelesID']."'>".$rowN['niveles_nivel']."</option>
            ";
          }


          echo"</select>
          </td>

          <td><a class='botonModal' href='#registrarNivel' style='float:left; margin-left:10px;width:30px;height:30px;font-size:20px;'>+</a></td>
          </tr>

        </table>

        <div class='container'><button class='skewBtn blue'>Registrar</button></div>

        </div>
      </div>
      </form>
</div>
";




//MODAL REGISTRAR NIVEL DESDE REGISTRAR USUARIO
echo"
<div id='registrarNivel' class='modal'>

      <form method='post'>

      <div id='filtro' style='width:60%; height:550px; margin:3% auto;'>
        <div id='barraTitulo' style='height:50px;'><i class='ion-android-add-circle'></i>&nbsp;&nbsp;Agregar Nivel
        ";
        if($rutaDiv[0]!="privilegios"){
          echo"<a class='closeModal' href='#registrarUsuario'>X</a>";
        }else {
          echo"<a class='closeModal' href='#'>X</a>";
        }
        echo"

        </div>
        <div id='filtroCont'>

        <table id='tableFiltros' style='width:95%;'>
          <tr>
            <td style='text-align:right;'>Identificador:</td>
            <td><input type='text' name='nombreNivel' required></td>

            <td style='text-align:right;'>Descripción:</td>
            <td><input type='text' name='descripcionNivel' required></td>
          </tr>
          <tr>
          <td colspan='4' style='text-align:center;'>----------------- Acceso a: -----------------</td>
          </tr>
        </table>

        <div id='contentNiveles'
        style='
        height:300px;width:100%;
        margin-top:100px;
        box-sizing: border-box;
        padding:10px 20px;
        overflow-y: scroll;
        overflow-x: hidden;'>

        <table id='tableNiveles' style='color:black;margin-left:15%;width:70%;'>
        <thead>
          <tr>
            <th>Descripcion</th>
            <th>Dar acceso</th>
          </tr>
        </thead>
        <tbody>
        ";

        $rowsMenus=$db->getAllFromMenu();
        foreach($rowsMenus as $rowM){
          echo"
          <tr>
          ";
            if($rowM['menu_padre']!="menu"){
              echo"<td style='width:60%;text-align:left;'>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ".$rowM['menu_descripcion']."</td>";
            }else{

              echo"
              <td style='width:60%;text-align:left;'>".$rowM['menu_descripcion']."</td>";}

              if($rowM['menu_ruta']!="submenu"){
                echo"
                <td>
                  <input type='checkbox' name='".$rowM['menu_descripcion']."' value='".$rowM['menuID']."'>
                </td>
                </tr>
                ";
              }else{echo "<td></td></tr>";}
        }

        echo"
        </tbody>
        </table>
        </div>

        <div class='container' style='margin-top:-20px;;'><button class='skewBtn blue'>Registrar</button></div>

        </div>
      </div>
      </form>
</div>
";

 ?>
