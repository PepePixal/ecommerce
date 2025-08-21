<?php
/*====================================================
Iniciar variables de sesión
=====================================================*/
//Activa el output buffering
ob_start();
//Inicializa session data
session_start();

/*==========================================================
Variable Path - Obtiene el path con el método static path()
===========================================================*/

$path = TemplateController::path();

/*====================================================
Capturar las rutas de la URL, descartando el arguemto
=====================================================*/

//La llave ["REQUEST_URI"], contiene un string con el path (o ruta) de la url de la página, solo la parte posterior al dominio (/admin/...)
//explode() divide el string (path o ruta) en un arreglo index, tomando como separador "/" y lo almacena como arreglo index en $routeArray
$routesArray = explode("/", $_SERVER["REQUEST_URI"]);
//como en el arreglo creado, el primer elemento [0] siempre será un string vacio (la parte anterior a la primera / ),
//con array_shift() se elimina el primer elemento [0], que no contiene información, del arreglo index $routerArray y lo reindexa
array_shift($routesArray);

//para descartar la parte de argumento ( ?var=... ) que puede venir en la URL,
//recorre el arreglo index $routeArray y al valor ($value) de cada llave ($key):
foreach ($routesArray as $key => $value) {

  //explode() divide el string, tomando como separador "?", genera un nuevo arreglo idex y
  //obtiene solo el valor de la llave [0], del nuevo arreglo generado, descartando el argumento que va despues de ?,
  //reasigna el valor al correspondiente indice ($key) del arreglo index $routesArray.
  //Si la ruta es /admin/administradores/gestion... en el índice [0] estará admin, en el [1] administradores, en el [2] gestion, etc
  $routesArray[$key] = explode("?", $value)[0]; 

}

/*=============================================
Obtener datos de la tabla plantillas, de la BD
==============================================*/

//Define vars para enviar como arguementos al metodo request(), solicitud a la tabla de la BD.
//Con la url se filtra para traer solo el registro, cuya columna active_template contenga el valor ok
$url = "templates?linkTo=active_template&equalTo=ok";
$method = "GET";
$fields = array();

//llama método static request(), enviando parámetros, que retornará un JSON 
$template = CurlController::request($url,$method,$fields);

//valida si el arreglo status del objeto recibido en $template es == 200 (conexión ok)
if ($template->status == 200){
  //obtine el contenido del indice [0] del arreglo reuslts, del objeto recibido en $template
  // y lo reasigna a la var $template
  $template = $template->results[0];
  
//si la conexión con la api no ha sido ok
} else {
    //como aquí todavía no se ha cargado nada del dom, para mostrar la página de error 500:
    echo '<!DOCUTYPE html>
          <html lang="es">
            <head>
              <link rel="stylesheet" href="'.$path.'views/assets/css/plugins/adminlte/adminlte.min.css">
            </head>
            <body class="hold-transition sidebar-collapse layout-top-nav">
              <div class="wrapper">
    ';
              include "pages/500/500.php";
      echo '  </div>  
            </body>
          </html>
    ';

    //para el código aquí
    return;
}

/*======================================================
Formateo de arrglo en cadena de texto json, a arreglo php
========================================================*/
//define var $keywords, para almacenar las palabras clave
$keywords = null;
//Decodifica el string json, a formato arreglo asociativo php (por el true),
//recorre el arreglo index decodificado y por el valor de cada llave:
foreach (json_decode($template->keywords_template, true) as $key => $value) {
  //le concatena a cada valor, una coma y un espacio (", ") al final,
  //obteniendo un string con las palabras clave, separados por comas, lo asigna a $keywords
  $keywords .= $value.", "; 
}
//la función php substr(), extrae, enpezando desde el final 0, los dos últimos carácteres -2 de la cadena,
//el útimo espacio y la última coma, sanitizando así el string para su uso
$keywords = substr($keywords, 0, -2); 

/*======================================================
Formateo de objeto en cadena de texto json, a Objeto php
========================================================*/
//decodifica el string json de fonts_template a un objeto php y obtiene el valor del atributo fontFamily,
//que es un string con <link> html a la url de google.fonts, codificado
$fontFamily = json_decode($template->fonts_template)->fontFamily;
//decodifica el string al fomato html <link> url, original
$fontFamily = urldecode($fontFamily);

//decodifica el string json de fonts_template a un objeto, y otiene el valor del atributo fontBody,
//que es un string con <link> html a la url de google.fonts, codificado 
$fontBody = json_decode($template->fonts_template)->fontBody;
//decodifica el string json de fonts_template a un objeto, y otiene el valor del atributo fontSlide,
//que es un string con <link> html a la url de google.fonts, codificado 
$fontSlide = json_decode($template->fonts_template)->fontSlide;

/*===========================================================
Formateo de objeto json en cadena de texto, a objeto json php
=============================================================*/
//decodifica el string json a ojeto json y
//obtiene el valor de la propidad top, del indice [0] del arreglo json
$topColor = json_decode($template->colors_template)[0]->top;
//decodifica el string json a ojeto json y
//obtiene el valor de la propidad template, del indice [1] del arreglo json
$templateColor = json_decode($template->colors_template)[1]->template;

?>

<!-- de plantilla recursos/AdminLTE-3.2.0/pages/layout/top-nav-sidevar.html -->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $template->title_template ?></title>

  <meta name="description" content="<?php echo $template->description_template ?>">
  <meta name="keywords" content="<?php echo $keywords; ?>">

  <!-- icono de la pestaña -->
  <link rel="icon" href="<?php echo $path ?>views/assets/img/template/<?php echo $template->id_template?>/<?php echo $template->icon_template?>">

  <!-- Google Font: Ubuntu, Ubuntu Condense (obtenido de la tabla templates en la BD-->
  <?php echo $fontFamily; ?>
  
  <!-- *** CSS ***  -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/fontawesome-free/css/all.min.css">
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- JDS Slider plugin CSS -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/jdSlider/jdSlider.css">
  <!-- Notie Alert plugin CSS -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/notie/notie.min.css">
  <!-- Toastr Alert plugin CSS -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/toastr/toastr.min.css">
  <!-- Material Preloader plugin CSS -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/material-preloader/material-preloader.css">
  <!-- DataTables plugin LTE -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Tags Input plugin -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/tags-input/tags-input.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/adminlte/adminlte.min.css">
  <!-- CSS personalizado -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/template/template.css">
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/products/products.css">
  
  <!-- estilo css, con variables con info de la DB, personalizado para template.php -->
  <style>
      body{
        font-family: <?php echo $fontBody ?>, sans-serif; 
      }

      .slideOpt h2, .slideOpt h3, .slideOpt h4{
        font-family: <?php echo $fontSlide ?>, sans-serif;
      }

      .topColor{
        background-color: <?php echo $topColor->background ?>;
        color: <?php echo $topColor->color ?>;
      }

      .templateColor, .templateColor:hover, a.templateColor{
        background: <?php echo $templateColor->background ?> !important;
        color: <?php echo $templateColor->color ?> !important;
      }
  </style>

  <!-- *** JS ***  -->
  <!-- jQuery -->
  <script src="<?php echo $path ?>views/assets/js/plugins/jquery/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JDS Slider JS -->
  <script src="<?php echo $path ?>views/assets/js/plugins/jdSlider/jdSlider.js"></script>
  <!-- Kanob plugin de la plantilla adminlite, para graficos visits.php -->
  <script src="<?php echo $path ?>views/assets/js/plugins/knob/knob.js"></script>
  <!-- Notie Alert plugin alertas -->
  <script src="<?php echo $path ?>views/assets/js/plugins/notie/notie.min.js"></script>
  <!-- Sweet Alert 2 plugin alertas -->
  <script src="<?php echo $path ?>views/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
  <!-- Toastr plugin alertas -->
  <script src="<?php echo $path ?>views/assets/js/plugins/toastr/toastr.min.js"></script>
  <!-- Material Preloader plugin loader -->
  <script src="<?php echo $path ?>views/assets/js/plugins/material-preloader/material-preloader.js"></script>
  
  <!-- DataTables Plugins - LTE -->
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  
  <!-- Tags Input plugin -->
  <!-- https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/ -->
  <script src="<?php echo $path ?>views/assets/js/plugins/tags-input/tags-input.js"></script>

  <!-- Alertas Personalizado -->
  <script src="<?php echo $path ?>views/assets/js/alerts/alerts.js"></script>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">

  <!-- input oculto solo para obtener el $path de su value, desde tables.js -->
  <input type="hidden" id="urlPath" value="<?php echo $path ?>">

  <div class="wrapper">
    <?php
      include "modules/top.php";
      include "modules/navbar.php";

      //Para mostrar el sidebar lateral de administración,
      //valida si existe y no es NULL la var ["admin"] en la super glob $_SESSION
      if (isset($_SESSION["admin"])) {
        include "modules/sidebar.php";
      }
      
      //valida si el index 0 de $routesArray[0] NO viene vacio, significa que contiene una URL
      if (!empty($routesArray[0])) {

        //valida si el valor del indice [0] del arreglo $routesArray es = "admin" o
        // el valor del indice [0] del arreglo $routesArray es = "salir"
        if ($routesArray[0] == "admin" ||
            $routesArray[0] == "salir") {

          //incluye (iserta) la ruta correspondiente 
          include "pages/".$routesArray[0]."/".$routesArray[0].".php";
        
        //si no existe la url
        } else {

          include "pages/404/404.php";
        
        }

      //si $routesArray viene vacio
      } else {
        //incluye (inserta) home.php en template.php
        include "pages/home/home.php";
      }

      include "modules/footer.php";
    ?>
  </div>

<!-- REQUIRED SCRIPTS -->
<!-- AdminLTE App -->
<script src="<?php echo $path ?>views/assets/js/plugins/adminlte/adminlte.min.js"></script>
<!-- scripts personalizados -->
<script src="<?php echo $path ?>views/assets/js/products/products.js"></script>

</body>
</html>
