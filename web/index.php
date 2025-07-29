<?php
//** Depurar errores .log **/
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/htdocs/ecomerce/web/php_error_log");
//* ------------------------------------------------------------------//

//incluye, una sola vez, la class libs/Helper.php
require_once("controllers/helper.php");
//requerir una sola vez el archvio .php
require_once "controllers/controller.template.php";

//nuevo objeto $index, con la instancia de la class TemplateController
//para poder utilizar sus métodos o funciones
$index = new TemplateController();

//llama al método index() de la class TemplateController()
$index->index();


