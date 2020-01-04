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
    ajax.open("POST", "registrarUsuario.php", true);

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
