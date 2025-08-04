<link rel="stylesheet" href="<?php echo $path ?>views/assets/css/admin/admin.css">


<?php
//valida si todavía NO esxiste la var ["admin"] en el arreglo super glob $_SESSION
if (!isset($_SESSION["admin"])) {

  //inlcuye o inserta login.php 
  include "login/login.php";

//si ya existe la var ["admin"] en el arreglo super glob $_SESSION
} else {

  //incluye o inserta tablero.php administrativo
  include "tablero/tablero.php";

}

?>


