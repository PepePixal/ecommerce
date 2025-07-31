<?php 
//define objeto con método static path();
$path = TemplateController::path();
?>

<!-- de plantilla recursos/AdminLTE-3.2.0/pages/layout/top-nav-sidevar.html -->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Top Navigation + Sidebar</title>

  <!-- Google Font: Ubuntu, Ubuntu Condense -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  
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
