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

  //valida si la validación del input es tipo email
  if(type == "email"){

    //define var con patron expresión regular válida para nombre de email
    var pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento padre (div) del elemento event.target (input), y le agrega la clase was-validated,
      //esta clase avisa al validador de bootstrap, que el campo ya se está validando
      $(event.target).parent().addClass("was-validated");
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Formato de email no válido");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return
    }  
  } 

}
