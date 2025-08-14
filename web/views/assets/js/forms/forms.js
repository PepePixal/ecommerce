/*==============================================================
  Validación formulario con Bootstrap 4 y 5 - lado del cliente
===============================================================*/
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


/*==============================================================
  Validación formulario personalizada - lado del cliente
===============================================================*/
//recibe el parámetro event (evento que dispara la validación) y type (tipo de validación)
function validateJS(event, type){

  //accede al elemento padre (div) del elemento event.target (input), y le agrega la clase was-validated,
  //esta clase avisa al validador de bootstrap, que el campo ya se está validando
  $(event.target).parent().addClass("was-validated");

  //si la validación del input es type email
  if(type == "email"){
    //define var con patron expresión regular válida para nombre de email
    var pattern = /^(([^<>()[\]\\.,;:\s@"ñÑ]+(\.[^<>()[\]\\.,;:\s@"ñÑ]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-ZñÑ\-0-9]+\.)+[a-zA-ZñÑ]{2,}))$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Formato de email no válido");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return
    }  
  } 

  //si la validación del input es type text
  if(type == "text"){
    //define var con patron expresión regular válida para nombres
    var pattern = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ]([a-zA-ZñÑáéíóúÁÉÍÓÚ ]){1,}$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Formato de nombre no válido");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return
    }  
  } 

  //si la validación del input es type password
  if(type == "password"){
    //define var con patron expresión regular válida para nombres
    var pattern = /^[*\\$\\!\\¡\\?\\\\.\\-\\_\\#\\0-9A-Za-z]{1,}$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Formato de password no válido");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return
    }  
  } 

  //si la validación del input es type complete
  if(type == "complete"){
    //define var con patron expresión regular válida para no inyectar código malicioso en la bs
    var pattern = /^[-\\(\\)\\=\\%\\&\\;\\"\\'\\*\\$\\!\\¡\\?\\¿\\,\\.\\:\\-\\_\\/\\#\\0-9A-Za-zÑñáéíóúÁÉÍÓÚ ]{1,}$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Carácteres especiales en la entrada");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return
    }  
  } 

}


/*==============================================================
  Recordar el email, en el form login administradores
===============================================================*/

//Función que genera y elimina la var emailAdmin, del local storage, según esta chequeado Recordar del form. 
//requiere parámetro event, value del element (input) que origina el event (onchange) 
function rememberEmail(event){

  //valida si el valor checked, del elemento input que origina el evento onchange, es true
  if(event.target.checked){
    //genera la variable local emailAdmin, en el navegador. (navegador inspeccionar/Aplicación/Almacenamiento local/dominio)
    //le asigna el value del input email del formulario, cuya propiedad name es loginAdminEmail 
    localStorage.setItem("emailAdmin", $('[name="loginAdminEmail"]').val());
    //genera var local checkRem, en el navegador y le asigna true
    localStorage.setItem("checkRem", true);

  //si el checked no es true, es que no está seleccionado
  }  else {

    //elimina las variable locales emailAdmin y checkRem, del navegador.
    localStorage.removeItem("emailAdmin");
    localStorage.removeItem("checkRem");

  }

}

/*==============================================================
  Captura email del local sotrage
===============================================================*/
//captura, si existe, la var email del local Storage, para asignarla al value del form login amin
function getEmail(){
  // valida si el valor de la var emailAdmin del localSotrage, no es null 
  if(localStorage.getItem("emailAdmin") != null){

    //asigna al value (.val) del input del form, el valor de la var del localStorage (el email)
    $('[name="loginAdminEmail"]').val(localStorage.getItem("emailAdmin"));

  }

  //valida si la var checkRem del localStorage, no es null y contiene algun valor
  if(localStorage.getItem("checkRem") != null && localStorage.getItem("checkRem")){

      //asigana true, al atributo "checked" del elemento cuyo id es "remember", para matener el check 
      $("#remember").attr("checked", true);
  }
}

//ejecuta la función getEmail(), a la carga del archivo forms.js
getEmail();


