<?php

require_once "../controllers/curl.controller.php";

class StatusController{

    public $token;
    public $id;
    public $table;
    public $column;
    public $status;

    public function ajaxStatus(){

        //tabla, id a buscar, columna en la que buscar, token del admin, tabla del admin y suffix
        $url = $this->table."?id=".base64_decode($this->id)."&nameId=id_".$this->column."&token=".$this->token."&table=admins&suffix=admin";
        $method = "PUT";
        //columna (status_category) y nuevo valor a asignar
        $fields = "status_".$this->column."=".$this->status;

        //consulta a la API rest, con el método request()
        $status = CurlController::request($url, $method, $fields);

        //retorna como respuesta, la propiedad status del resultado de la consulta en $status
        echo $status->status;

    }

}
    
//si en $_POST está definida la var "status" y no es NULL
if (isset($_POST["status"])){

    //objeto con instancia del la class StatusController()
    $status = new StatusController();

    //asignar los valores que vienen en $_POST, a las propiedades de la class
    $status -> token = $_POST["token"];
    $status -> id = $_POST["id"];
    $status -> table = $_POST["table"];
    $status -> column = $_POST["column"];
    $status -> status = $_POST["status"];

    //llama a la función ajaxStatus() de la class
    $status -> ajaxStatus();

}