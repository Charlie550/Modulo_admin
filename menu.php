<?php

  $db = new BaseDatos();

  $nivel=$_SESSION['nivel'];
  $id=$_SESSION['id'];

  $arrayMenu=array();
  $arrayMenu=explode('-',$db->getNivelesLista($id));


  function printMENU(){

      global $db,$nivel,$id,$arrayMenu;

      echo"

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <link href='css/menu.css' rel='stylesheet' type='text/css'>

          <section class='app'>
            <aside class='sidebar'>
                <header>
                  <img src='img/logo.png' width='50%' height='50%' style='background:white;border-radius:5px;'>
                </header>
              <nav class='sidebar-nav'>

                <ul>
                  ";printMenuItem(); echo"
                </ul>
              </nav>
            </aside>
          </section>

      ";
  }

  function printMenuItem(){
    global $db,$nivel,$id,$arrayMenu;

    for($i=0;$i<sizeof($arrayMenu);$i++){

        $row=$db->getMenus($arrayMenu[$i]);

        if($row!=null){

          $numSubMenus=$db->verificarSubMenus($arrayMenu[$i]);

          if($numSubMenus>=1){

            echo"
            <li>
              <a href='#'><i class='".$row['menu_icono']."'></i> <span>".$row['menu_descripcion']."</span></a>
                <ul class='nav-flyout'>
            ";

            for($x=0;$x<sizeof($arrayMenu);$x++){

              $rowSub=$db->getSubMenus($arrayMenu[$x],$arrayMenu[$i]);
              if($rowSub!=null){
                echo"
                    <li>
                      <a href='".$rowSub['menu_ruta']."'><i class='".$rowSub['menu_icono']."'></i>
                      <spam style='position:absolute;width:60%';>".$rowSub['menu_descripcion']."</spam></a>
                    </li>
                  ";
              }
            }


            echo"</ul>";

          }else{

            echo"
            <li>
              <a href='".$row['menu_ruta']."'><i class='".$row['menu_icono']."'></i> <span>".$row['menu_descripcion']."</span></a>
            ";
          }

            echo"</li>";
        }
    }
  }
?>
