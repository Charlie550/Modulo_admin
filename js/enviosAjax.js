function objetoAjax(){
  var xmlhttp = false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {

    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false; }
  }

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}




function registrarUsuario(){

    //Recogemos los valores introducimos en los campos de texto
    nombreUsr = document.registroUsuario.nombreUsuario.value;
    claveUsr = document.registroUsuario.claveUsuario.value;
    nivelUsr = document.registroUsuario.nivelUsuario.value;

    //instanciamos el objetoAjax
    ajax = objetoAjax();

    //Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
    ajax.open("POST", "consultasAjax\\registrarUsuario.php", true);

    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    ajax.onreadystatechange = function() {

      //Cuando se completa la petición, mostrará los resultados
      if (ajax.readyState == 4){

        //El método responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
        if(ajax.responseText=="correcto"){
          Swal.fire({
        		icon: 'success',
        		title: 'Registro realizado',
        		text: 'Se ha realizado correctamente el registro',
        	});

          setTimeout ("window.location='usuarios.php'", 1000);
        }else{
          Swal.fire({
        		icon: 'error',
        		title: 'Ha ocurrido un error',
        		text: ajax.responseText,
        	});
        }
      }
    }

    //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    //enviamos las variables a 'consulta.php'
    ajax.send("&nombreUsr="+nombreUsr+"&claveUsr="+claveUsr+"&nivelUsr="+nivelUsr);

}




function registrarNivel(){

    //Recogemos los valores introducimos en los campos de texto
    nombreNivel = document.registroNivel.nombreNivel.value;
    descripcionNivel = document.registroNivel.descripcionNivel.value;

    //alert(document.registroNivel.nivelID1.checked);
    var array = [];
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

    if(checkboxes.length==0){

    }

    var listaNiveles='';
    for (var i = 0; i < checkboxes.length; i++) {
      listaNiveles+=checkboxes[i].name+'-';
    }

    listaNiveles=listaNiveles.substring(0, (listaNiveles.length-1));


    //instanciamos el objetoAjax
    ajax = objetoAjax();

    //Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
    ajax.open("POST", "consultasAjax\\registrarNivel.php", true);

    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    ajax.onreadystatechange = function() {

      //Cuando se completa la petición, mostrará los resultados
      if (ajax.readyState == 4){

        //El método responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
        if(ajax.responseText=="correcto"){
          Swal.fire({
        		icon: 'success',
        		title: 'Registro realizado',
        		text: 'Se ha realizado correctamente el registro',
        	});

          var pathname = window.location.pathname.split('/');
          pathnameFile = pathname[pathname.length-1];

          if(pathnameFile=="usuarios.php"){
            setTimeout ("window.location='usuarios.php#registrarUsuario'", 1000);
          }else{
            setTimeout ("window.location='"+pathnameFile+"'", 1000);
          }

        }else{
          Swal.fire({
        		icon: 'error',
        		title: 'Ha ocurrido un error',
        		text: ajax.responseText,
        	});
        }
      }
    }

    //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    //enviamos las variables a 'consulta.php'
    ajax.send("&nombreNivel="+nombreNivel+"&descripcionNivel="+descripcionNivel+"&listaNiveles="+listaNiveles);

}







function eliminarUsuario(usuarioID){
  Swal.fire({
    icon: 'warning',
    title: '¿Seguro que desea eliminar este registro?',
    text: 'Confirmar eliminación de registro',
    showCancelButton: true,
    }).then((result) => {
      if (result.value) {

        ajax = objetoAjax();
        ajax.open('POST', 'consultasAjax\\eliminarUsuario.php', true);
        ajax.onreadystatechange = function() {

          if (ajax.readyState == 4){

            if(ajax.responseText=='correcto'){
              Swal.fire({
                icon: 'success',
                title: 'Registro eliminado',
                text: 'Se ha eliminado correctamente el registro',
              });

              setTimeout ("window.location='usuarios.php'", 1000);

            }else{
              Swal.fire({
                icon: 'error',
                title: 'Ha ocurrido un error',
                text: ajax.responseText,
              });
            }
          }
        }

        ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        ajax.send('&usuarioID='+usuarioID);

      }
    })
}

function prueba(){
  alert('hola');
}

function modificarUsuario(nombre,nivel){

  formulario=document.getElementById("formRegisUsr");
  formUsuario.innerHTML.replace('registrarUsuario','prueba');

  document.registroUsuario.nombreUsuario.value=nombre;
  document.registroUsuario.nivelUsuario.value=nivel;

  contenedor = document.getElementById("confirmarClave");
  contenedor.innerHTML ="<tr><td><input type='password' name='confirmaClave' placeholder='&nbsp;&nbsp;&nbsp;nueva contraseña'></td></tr>";

  location.href="#registrarUsuario";

}

function limpiarModalRegistrarUsuario(){

  document.registroUsuario.nombreUsuario.value="";
  document.registroUsuario.claveUsuario.value="";
  document.registroUsuario.nivelUsuario.value=1;

  contenedor = document.getElementById("confirmarClave");
  contenedor.innerHTML ="";
}
