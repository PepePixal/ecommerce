<?php

//para poder hacer la consulta cURL a la BD con el método query()
require_once "../controllers/curl.controller.php";

class FormsController{

    //define propiedades de la class, para almacenar la data de la petición ajax POST
    public $table;
    public $equalTo;
    public $linkTo;

    //busca en la BD la existencia de un valor concreto
    public function ajaxForms(){

        //url para obtener de la tabla, un elemento concreto en una columna concreta.
        //De la tabla, busca lo que sea equalTo, buscando en la columna linkTo y obteniendo la info de la columna select
        $url = $this->table."?equalTo=".urlencode($this->equalTo)."&linkTo=".$this->linkTo."&select=".$this->linkTo;
        $method = "GET";
        $fields = array();

        //solicitud cURL GET a la api rest
        $data = CurlController::request($url, $method, $fields);

        //retorna $data->status
        //si status es 200 significa que SI encontro coincidencia 
        //si status es 404 significa que NO encontro coincidencia 
        echo $data->status;
    
    }
}

//valida si está definida y no es null, la var "table" en $_POST,
if (isset($_POST["table"])){

    //nuevo objeto con la instancia de la class, sus propiedades y métodos
    $forms = new FormsController();
    //asigna a las propiedades del objeto $forms, los valores de las vars recibidas en $_POST
    $forms->table = $_POST["table"];
    $forms->equalTo = $_POST["equalTo"];
    $forms->linkTo = $_POST["linkTo"];
    //llama la función ajaxForms()
    $forms-> ajaxForms(); 

}

