<?php
/*=============================================
Obtener datos de las redes sociales, de la BD
==============================================*/

//Define vars para enviar como arguementos al metodo request(), solicitud a la tabla de la BD.
//En la url se seleccionan solo los campos o columnas que necesitamos traer de la tabla
$url = "socials?select=name_social,url_social,icon_social,color_social";
$method = "GET";
$fields = array();

//llama método static request(), enviando parámetros, que retornará un JSON 
$socials = CurlController::request($url, $method, $fields);

//valida si el arreglo status, del objeto recibido en $socials es == 200 (conexión ok)
if ($socials->status == 200){
  //obtine el contenido del indice [0] del arreglo reuslts, del objeto recibido en $socials
  // y lo reasigna a la var $socials
  $socials = $socials->results;
 
} else {
  //redireccionar a página 500
  debug("Error al conectar con la api");
}

?>

<div class="container-fluid topColor">
    <div class="container">
        <div class="d-flex justify-content-between"> 
            <div class="p-2">
                <div class="d-flex justify-content-center">

                    <!-- itera el objeto obtenido en $sociales y por cada valor de la llave, obtinene los valores -->
                    <?php foreach ($socials as $key => $value): ?>

                        <div class="p-2">
                            <a href="<?php echo $value->url_social ?>" target="_blank" >
                            <i class="<?php echo $value->icon_social ?> <?php echo $value->color_social ?>"></i>
                            </a>
                        </div>

                    <?php endforeach ?>
                    
                </div>      
            </div>

            <div class="p-2">
                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="#" class="text-white">
                            Ingresar
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="#" class="text-white">
                            |
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="#" class="text-white">
                            Crear Cuenta
                        </a>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>