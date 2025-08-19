//Ejecuta el Plugin DataTable sobre la tabla cuyo id="tables"

$("#tables").DataTable({

    "responsive": true,
    "aLengthMenu":[[10, 25, 50, 100],[10, 25, 50, 100]],
    "order":[[0,"desc"]],
    "lengthChange": true, 
    "autoWidth": false,
    "processing":true,

    /*==========================================================
      Configuración solicitud ajax, del lado del servidor
    ==========================================================*/

    "serverSide": true,

    "ajax":{
        //url al archivo que hará la solicitud ajax a la BD, a través de la api.
        //Obtiene $path, del value del input hidden con id="urlPath", en template.php y le agrega + el resto de la url
        "url":$("#urlPath").val()+"ajax/data-admins.ajax.php",
        //tipo de solicitur ajax, que genera contenido en la var super glob $_POST
        "type": "POST"
    },

    //columnas donde se buscará info en la tabla de la BD con la solucitud ajax y posteriormente se insertará 
    //en las columnas de la tabla html sobre la que se ha aplicado el plugin DataTable, en administradores/modules/listado.php
    //excepto la columna "actions" que contiene los botones y no tiene relación con la tabla de la BD, con los false no se buscará en la BD.
    "columns":[
        {"data":"id_admin"},
        {"data":"name_admin"},
        {"data":"email_admin"},
        {"data":"rol_admin"},
        {"data":"date_updated_admin"},
        {"data":"actions", "orderable":false, "searchable":false}
    ],


    //** Configuración lenguaje */
    //sustituye los textos del plugin por textos en español
    "language":{
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
});


/*===============================================================================
  Eliminar elemento o item - solo permitido a los Administradores con rol admin
=================================================================================*/
//cuando se haga click sobre el elemento cuya clase contiene deleteItem
$(document).on("click",".deleteItem", function(){
  //capturar los atributos del elemento y los asigna a las variables
  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var column = $(this).attr("column");
  var rol = $(this).attr("rol");

  //ejecuta funcion fnSweetAlert()  de alerts.js, para confirmar el borrado,
  //como la función contiene una promesa, entonces se recibe la respuesta en resp
  fncSweetAlert("confirm","¿Estas seguro de borrar este elemento?", "").then(resp=>{

    //si resp es true
    if(resp){
      //carga y ejecuta el loader a través d SweetAlert
      fncMatPreloader("on");
      fncSweetAlert("loading", "", "");

      //valida si el valor de la var rol es "admin" (para poder eliminar el registro)
      if (rol == "admin") {

        //obtinene el valor de la var token-admin almacenada previamente en el localStorage
        var token = localStorage.getItem("token-admin");
        //var url donde está el archivo que eliminará el item de la BD
        var url = "/ajax/delete-admin.ajax.php";
      }

      //FormData es una interfaz que te permite construir un conjunto de pares clave/valor
      //que representan los campos de un formulario y sus valores, como si estuvieran en un formulario HTML tradicional. 
      //Se usa principalmente para enviar datos a través de una solicitud HTTP, especialmente con la API fetch(),
      //de manera sencilla a través de JavaScript.
      var data = new FormData();
      //agrega claves y sus valores a data, para la consulta ajax
      data.append("token", token);
      data.append("table", table);
      data.append("id", idItem);
      data.append("nameId", "id_"+column)

      //función $.ajax() de la librería jQuery que envia una solicitud HTTP POST
      //a la URL especificada en la variable url
      $.ajax({

        url: url,
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        //response contendrá la info devuelta tras la consulta a la api rest
        success: function (response) {

          //valida si la respuesta del request DELETE ha sido afirmativa
          if (response == 200) {

            fncMatPreloader("off");
            fncSweetAlert( "success", "Registro borrado correctamente", location.reload());
          
          //si la respuesta ha sido "no-borrar"
          } else if (response == "no-borrar"){

            fncMatPreloader("off");
            fncToastr("warning", "Este registro no se puede borrar");

          //si la respuesta no ha sido 200 ni "no-borrar", es que ha habido un error
          } else {

            fncMatPreloader("off");
            fncToastr("Error", "Error al intentar borrar el registro");
          }

        }

      });

    }

  });


})