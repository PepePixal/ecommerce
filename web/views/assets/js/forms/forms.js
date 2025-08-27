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
  Validar datos repetidos en la BD
===============================================================*/
//recibe el evento que dispara la función y el type para saber que tabla consultar
function validateDataRepeat(event, type){

  //valida si el tipo es == category
  if (type == "category"){
    
    //vars con la tabla y la columna a consultar
    var table = "categories";
    var linkTo = "name_category";
  }

  //var para el value del elemento que dispara el evento
  var value = event.target.value;

  //define data tipo FormData, para enviar la info en petición ajax,
  //que se enviará a una url con un archivo .php, que realizará la consulta a la api rest
  var data = new FormData();
  data.append("table", table);
  data.append("equalTo", value);
  data.append("linkTo", linkTo);

  //petición ajax al archivo .php de la url. 
  $.ajax({
    url: "/ajax/forms.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response){

        //si response = 404, significa que NO se ha encontrado el valor (value) en la BD,
        //por tanto, si que se puede agregar a la BD
        if (response == 404){
          //validación tipo completa de texto seguro, del valor del elemento (input) que genera el evento
          validateJS(event, "completa");

          //llama func que crea una url, con el valor del elemento (input) que origina el evento y
          //asigna la url creada, al value del input con class "url_category"
          createUrl(event, "url_category");

          //Pone el título en el Visor de Metadatos.
          //Obtiene el elemento con class .metaTitle y en su html le inserta el valor de event.target.value
          $(".metaTitle").html(value);

        //si se ha encontrado, significa que ya existe esa categoría en la tabla
        } else {
          
          //muestra mensaje agregando la class al elemento padre
          $(event.target).parent().addClass("was-validated");
          //muestra mensaje obteniendo el elemento hijo con class .invalid-feedback y cambiando su html
          $(event.target).parent().children(".invalid-feedback").html("El nombre de la categoría ya existe");
          //limpia el valor del campo (input) que origina el evento
          event.target.value = "";
          //para el código y retorna
          return;
        }

    }
  })

}

/*=================================================================
  Función para crear URLs y asignarla a un elemento html del form
==================================================================*/
//recibe el evento y el name del input a cuyo value le queramos asignar la URL creada 
function createUrl(event, input){
    
  //obtiene el value del elemento (input) que origina el evento
  var value = event.target.value;

  //** Validaciones para crear URLs válidas */
  //convierte en minúscula el value
  value = value.toLowerCase();
  //validación que reemplaza cualquier carácter especial por nada "" (lo elimina);
  value = value.replace(/[#\\(\\)\\=\\%\\&\\;\\"\\'\\*\\$\\!\\¡\\?\\¿\\,\\.\\:\\/\\]/g, "");
  //validación, si encuntra uno o varios (/g) espacios en blanco, los sustituye por "-"
  value = value.replace(/[ ]/g, "-");
  value = value.replace(/[á]/g, "a");
  value = value.replace(/[é]/g, "e");
  value = value.replace(/[í]/g, "i");
  value = value.replace(/[ó]/g, "o");
  value = value.replace(/[ú]/g, "u");
  value = value.replace(/[ñ]/g, "n");

  //código jquery.
  //busca en el dom, un elemento con atributo name= al valor del param input y 
  //le asigna el valor de la var value, a su value
  $('[name="'+input+'"]').val(value);

  //Pone la url en el Visor de Metadatos.
  //Obtiene el elemento con class .metaUrl y en su html le inserta el valor de value
  $(".metaUrl").html(value);
}


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
    var pattern = /^[-\\(\\)\\=\\%\\&\\;\\"\\'\\*\\$\\!\\¡\\?\\¿\\,\\.\\:\\-\\_\\/\\#\\0-9A-Za-zÑñÇçáéíóúÁÉÍÓÚ ]{1,}$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Carácteres especiales en la entrada");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return;

    //si pasa la validación test  
    } else {

      //mostrar tabién el texto de descripción, en el Visor de Metadatos.
      //obtiene el elemento  html con class .metaDescription y en su htm, inserta el value del elemento original
      $(".metaDescription").html(event.target.value);
    } 
  } 

  //si la validación del input es type complete-tags
  if(type == "complete-tags"){
    //define var con patron expresión regular válida para no inyectar código malicioso en la bs
    var pattern = /^[-\\(\\)\\=\\%\\&\\;\\"\\'\\*\\$\\!\\¡\\?\\¿\\,\\.\\:\\-\\_\\/\\#\\0-9A-Za-zÑñÇçáéíóúÁÉÍÓÚ ]{1,}$/;
    //valida si NO es true, el resultado de testear el valor del elemento que dispara el evento
    // (el onchange input del formulario), con el patrón de la expresión regular. El email to tiene formato válido.
    if(!pattern.test(event.target.value)){
      //accede al elemento hijo cuya clase contenga ".invalid-feedback" y en su html le inserta el mensaje
      $(event.target).parent().children(".invalid-feedback").html("Carácteres especiales en la entrada");
      //limpia el valor del elemento que dispara el evento
      event.target.value = "";
      return;

    //si pasa la validación test  
    } else {

      //mostrar tabién el texto de descripción, en el Visor de Metadatos.
      //obtiene el elemento  html con class .metaDescription y en su htm, inserta el value del elemento original
      $(".metaTags").html(event.target.value);
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


/*==============================================================
  Cambio de Icono con Buscador, para la categoría, en el form
===============================================================*/
function addIcon(event){

  //.show() dispara o ejecuta la ventana modal con id = myIcon, hecha con Bootstrap5, en categorias/modules/gestion.php,
  //cuando se ejecute la función addIcon()
  $("#myIcon").show();

  //** Buscador de iconos en la ventana modal **//
  //Cuando documento (ventana modal) esté preparado (cargado), ejecuta función
  $(document).ready(function(){
    //sobre el elemento con class .myInputIcon (input del buscador), cuando se deja de teclear, ejecta función
    $(".myInputIcon").on("keyup", function(){
      //obtiene el value de este campo, donde se está escribiendo (input del buscador), lo convierte en minúsculas y lo asigna a la var value
      var value = $(this).val().toLowerCase();
      //obtiene los elementos con class .btnChangeIcon (divs con los iconos),
      //itera sobre cada uno de los elementos y le ejecuta una función que:
      $(".btnChangeIcon").filter(function(){
        //$(this) se refiere ahora a cada uno de los elementos .btnChangeIcon a medida que se itera sobre ellos,
        //$(this).attr("mode"), obtiene el valor del atributo "mode" de ese elemento (nombre del icono o la palabra clave por la que se va a buscar),
        //toLowerCase(), convierte también este valor a minúsculas, igual que se hizo con el texto del buscador,
        //indexOf(value), busca la cadena de texto que el usuario escribió (value), la busca dentro del valor del atributo mode,
        //si la cadena es encontrada, indexOf() devuelve la posición donde la encontró, que será un número mayor o igual a cero (>= 0),
        //si no la encuentra, devuelve -1,
        //el > -1 convierte el resultado en un valor booleano (true si se encontró, false si no),
        //finalmente, .toggle(true/false) toma este valor booleano:
          // Si es true (se encontró una coincidencia), el elemento se muestra.
          // Si es false (no hubo coincidencia), el elemento se oculta.
        $(this).toggle($(this).attr("mode").toLowerCase().indexOf(value) > -1);
      })
    })
  })

  //** Asigna el icono de la modal al input **/
  //sobre el DOM, cuando click sobre el elemento con class .btnChangeIcon (el icono botón de la modal),
  //ejecuta función enviando el elemento (e)
  $(document).on("click", ".btnChangeIcon", function(e){

    //desactiva las acciones por defecto del elemento e (icono botón del modal)
    e.preventDefault();

    //selecciona el elemento con class .iconView y cambia html por un nuevo icono <i...></i>
    //cuya clase contenga el valor del atributo "mode"
    $(".iconView").html(`<i class="`+$(this).attr("mode")+`"></i>`);
    //selecciona el elemento que genera el evento y a su value le asigna el valor del atributo "mode"
    $(event.target).val($(this).attr("mode"));

    //oculta el elemento con id = a myIcon, la ventana modal
    $("#myIcon").hide();

  });

}

/*====================================================================================
  Función Para cerrar la ventana modal que tenga el atributo data-bs-dismiss="modal"
=====================================================================================*/
//selecciona todo el DOM, escucha el eveno "click" sobre el elemento que tenga
//el atributo data-bs-dismiss con valor = "modal" y ejcuta función:
$(document).on("click", '[data-bs-dismiss="modal"]', function(){
  
  //selecciona todos los elementos con class .modal
  var modal = $(".modal");
  
  //.each(), método de jQuery que itera sobre cada elemento (i) de la colección modal
  modal.each((i)=>{
    //modal[i], dentro del bucle, esta sintaxis accede a cada modal [i] de forma individual,
    //.hide(), método que oculta el elemento seleccionado, haciendo que el modal desaparezca de la vista.
    $(modal[i]).hide();
  });

})


/*====================================================================================
  Tags Input o Etiquetas en los input - con la librería Tags Input
=====================================================================================*/
//Activar el uso de la librería o plugin Tags Input
//Valida los elementos del dom con class .tags-input, cuya long es > 0 (se supune que todos)
if($('.tags-input').length > 0){

  //llama al método tagsinput() del plugin Tags Input, sobre los elementos seleccionados
  $('.tags-input').tagsinput({
    //con un máximo de 5 tags o etiquetas
    maxTags: 5
  }); 

}

/*====================================================================================
  Validación de imágen en el form
=====================================================================================*/
//recibe params evento, y tagImg (nombre de la clase del elemento html <img> donde se aplica la funcion)
function validateImageJS(event, tagImg){

  //activa el plugin de alerta SweetAlert en modo loading
  fncSweetAlert("loading", "", "");

  //event.target.files es una propiedad de JavaScript que se utiliza para acceder a los archivos seleccionados
  //por un usuario a través de un elemento <input> de tipo file.
  //Es un FileList que contiene una lista de los archivos seleccionados y sus propiedades (name, size, type, etc).
  var image = event.target.files[0];

  //valida si la var image NO está definida
  if (image == undefined){
    //detiene el loader de SweetAler y para el código
    fncSweetAlert("close", "", "");
    return;
  }

  /*=====================================================
    Valida los tipos de formatos de imágenes permitidos
  =====================================================*/
  //si el tipo de imagen NO es:
  if (image["type"] !== "image/jpeg" && (image["type"]) !== "image/png" && (image["type"]) !== "image/gif" ) {
    //muestra alerta y para el código
    fncSweetAlert("error", "El formato de la imagen debe ser JPG o GIF o PNG", null);
    return;
  }
  /*=====================================================
    Valida el tamaño de la imágen en bytes
  =====================================================*/
  else if (image["size"] > 2000000) {
    fncSweetAlert("error", "El peso de la imagen debe ser menor que 2MB", null);
    return;
  }
  /*=====================================================
    Mostrar la imagen temporal
  =====================================================*/
  else {

    //nueva instancia del objeto JS FileReader(), que permite leer de forma asíncrona
    //el contenido de archivos (File) o Blobs (Binary Large Objects) almacenados en el cliente
    var data = new FileReader();
    //método readAsDataURL() le dice al FileReader que lea el archivo que se le pasa como argumento (image) y
    //que lo codifique en una Data URL, que es una cadena de texto que representa el contenido del archivo
    data.readAsDataURL(image);

    //cuando se haya cargado data (archivo img), ejecuta función enviando la información del evento load
    $(data).on("load", function(event){
      //console.log(event);

      //obtiene el resultado del target del evento y lo asigna a path
      var path = event.target.result
      
      //detiene la alerta SweetAlert
      fncSweetAlert("close", "", "");

      //obtiene el elemento con la class recibida como param en la funcion validateImageJS(.., tagImg) y
      //al atributo "src" del elemento le asigna el valor de la var path
      $("."+tagImg).attr("src", path);

      //obtiene el elemento con la class .metaImg (en imagen visor metadatos) y
      //al atributo "src" del elemento le asigna el valor de la var path (url imagen temporal)
      $(".metaImg").attr("src", path);
      
      
    })
  }

}