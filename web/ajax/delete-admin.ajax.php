<?php

//para poder usar el request()
require_once "../controllers/curl.controller.php";

class DeleteController {

    //define propiedades de la class
    public $token;
    public $table;
    public $id;
    public $nameId;

    public function ajaxDelete(){

        //para que no se pueda borrar el administrador principal (id= 1) de la tabla admnins,
        //valida si la tabla es admins y el id es "1"
        if ($this->table == "admins" && base64_decode($this->id) == "1"){

            //retorna "no-borrar", a la función de la propiedad success, de la solicitud ajax de tables.js
            echo "no-borrar";
            return;
        }
        
        //define parámetros para la consulta tipo DELETE a la api rest, siguiendo la doc de la api
        $url = "admins?id=".base64_decode($this->id)."&nameId=id_admin&token=".$this->token."&table=admins&suffix=admin";
        $method = "DELETE";
        $fields = array();

        //llama al método que hace la consulta. Requiere curl.controller.php
        $delete = CurlController::request($url, $method, $fields);

        //retorna status, a la función de la propiedad success, de la solicitud ajax de tables.js
        echo $delete->status;
        
    }

}

//valida si la var token existe y no es null
if(isset($_POST["token"])){

    //objeto con instancia la class DeleteController() con sus propiedades y función
    $Delete = new DeleteController();
    //asigna a cada propiedad del objeto, el valor recibido en la petición ajax POST
    $Delete -> token = $_POST["token"];
    $Delete -> table = $_POST["table"];
    $Delete -> id = $_POST["id"];
    $Delete -> nameId = $_POST["nameId"];
    //llama a la función de la class, que ejecutará la eliminación del item o elemento
    $Delete -> ajaxDelete();

}


