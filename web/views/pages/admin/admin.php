<link rel="stylesheet" href="<?php echo $path ?>views/assets/css/admin/admin.css">

<?php
//valida si todavía NO esxiste la var ["admin"] en el arreglo super glob $_SESSION,
//significa que no hay un admin logueado
if (!isset($_SESSION["admin"])) {

  //inlcuye o inserta login.php 
  include "login/login.php";

//si ya existe la var ["admin"] en el arreglo super glob $_SESSION,
//significa que ya hay un usuario admin logueado
} else {

  //valida si NO esta vacio el segundo indice [1] dela var array $routesArray,
  //el segundo indice [1] del arreglo, es donde se almacena la segunda parte de la url
  if(!empty($routesArray[1])){

      //valida la segunda parte de la url, almacenada en $routesArray[1]
      if($routesArray[1] == "administradores" ||
         $routesArray[1] == "plantillas" ||
         $routesArray[1] == "integraciones" ||
         $routesArray[1] == "slides" ||
         $routesArray[1] == "banners" ||
         $routesArray[1] == "categorias" ||
         $routesArray[1] == "subcategorias" ||
         $routesArray[1] == "inventario" ||
         $routesArray[1] == "mensajes" ||
         $routesArray[1] == "pedidos" ||
         $routesArray[1] == "disputas" ||
         $routesArray[1] == "informes" ||
         $routesArray[1] == "clientes" ){

          //inserta en admin.php, el correspondiente archivo .php, según la segunda parte de la url
          include $routesArray[1]."/".$routesArray[1].".php";

      } else {

        //envia a la url ecommerce.com/404/, como no existe, desde template.php se ejecuta el include 404
        echo '<script>
          window.location = "'.$path.'404"
        </script>';
      
      }

  //si no hay una segunda parte en la url, se queda en /admin/
  } else {

      //incluye o inserta tablero.php administrativo
      include "tablero/tablero.php";
  }

}

?>

<!-- para la validación del fomrulario con bootstrap -->
<script src="<?php echo $path ?>views/assets/js/forms/forms.js"></script>

