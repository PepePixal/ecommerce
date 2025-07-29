<?php

class TemplateController{
    
    //incluye la vista principal de la plantilla
    public function index(){
        include "views/template.php";
    }

    //retorna la ruta principal o dominio del sitio, obtenida de $_SERVER
    static public function path(){

        //si el parámetro 'HTTPS' NO está vacio y está en on,
        //estamos en un dominio https
        if(!empty($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) {
            //retorna el nombre de la ruta con https://
            return "https://".$_SERVER["SERVER_NAME"]."/";

        //si no estamos en un dominio con https
        } else {
            //retorna el nombre de la ruta con http
            return "http://".$_SERVER["SERVER_NAME"]."/";
        }

    }

}