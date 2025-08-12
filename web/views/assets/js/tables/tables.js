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