<?php 
//obtiene el path con el método static path() y lo asigna a la var $path
$path = TemplateController::path();

//Solicitud GET para obtener info de la tabla templates, de la BD,
//con la url se filtra para traer solo el registro, cuya columna active_template contenga el valor ok
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
  
} else {
  debug("Error al conectar con la api");
  //redireccionar a página 500
}

/*======================================================
Formateo del arreglo almacenado en keywords_template
========================================================*/
//define var $keywords, para almacenar las palabras clave
$keywords = null;
//Decodifica el string del json, a formato arreglo index (por el true), para php
//recorre el arreglo index decodificado y por cada valor de cada llave:
foreach (json_decode($template->keywords_template, true) as $key => $value) {
  //le concatena a cada valor, una coma y un espacio (", ") al final de cada valor,
  //obteniendo un string con las palabras clave, separados por comas, lo asigna a $keywords
  $keywords .= $value.", "; 
}
//sustrae, enpezando desde el final 0, el útimo espacio y la última coma (-2),
//con la función php substr(), sanitizando así el string para su uso
$keywords = substr($keywords, 0, -2); 

/*======================================================
Formateo del objeto almacenado en keywords_template
========================================================*/
//decodifica el string json de fonts_template a un objeto, y otiene el valor del atributo fontFamily,
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
  <!-- JDS Slider CSS -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/jdSlider/jdSlider.css">
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

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">
    <?php
      include "modules/top.php";
      include "modules/navbar.php";
      include "modules/sidebar.php"; 
      include "pages/home/home.php";
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
