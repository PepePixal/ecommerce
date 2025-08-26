<?php

//** Class para eliminar registros o items de las tablas

//para poder usar el request()
require_once "../controllers/curl.controller.php";

class DeleteController {

    //define propiedades de la class
    public $token;
    public $table;
    public $id;
    public $nameId;

    public function ajaxDelete(){       

        //valida si la tabla es admins y el id es "1",
        //para que no se pueda borrar el administrador principal (id= 1) de la tabla admnins,
        if ($this->table == "admins" && base64_decode($this->id) == "1"){

            //retorna "no-borrar", a la función de la propiedad success, de la solicitud ajax de tables.js
            echo "no-borrar";
            return;
        }

        //valida si la tabla sobre la que eliminar registros es categories,
        //ya que requiere borrar tambien las imágenes y sus directorios
        if ($this->table == "categories"){

            /*=========================================
              Consulta GET a la API rest
            =========================================*/
            //var con las columnas de la tabla de donde obtener los datos, para borrar la imagen de la categoria y su carpeta
            $select = "url_category,image_category,subcategories_category";

            //Buscar el id del registro a eliminar, en la tabla categories.
            //de la tabla categories, en su columna id_category, busca el valor igual a id, seleccionando
            //la info, de las columnas en $select
            $url = "categories?linkTo=id_category&equalTo=".base64_decode($this->id)."&select=".$select;
            $method = "GET";
            $fields = array();

            //llama al método que hace la consulta. Obtiene solo el indice [0] de la prop results. Requiere curl.controller.php
            $dataItem = CurlController::request($url, $method, $fields)->results[0];

            /*======================================================================
              Validar para no borrar categorías que tengan subcategorías vinculadas
            =======================================================================*/
            if ($dataItem->subcategories_category > 0){
                
                //retorna "no-borrar", a la función de la propiedad success, de la solicitud ajax de tables.js
                echo "no-borrar";
                return;
            }

            /*================================================================================
              Borrar la imagen y el directorio, de la categoría
            ==================================================================================*/
            //eliminar el archivo imagen de la categoría
            unlink("../views/assets/img/categories/".$dataItem->url_category."/".$dataItem->image_category);

            //eliminar también el directorio ya que solo contiene siempre una imagen
            rmdir("../views/assets/img/categories/".$dataItem->url_category);
        }

        //define parámetros, dinámicamente, para la consulta tipo DELETE a la API rest, siguiendo la doc de la API
        $url = $this->table."?id=".base64_decode($this->id)."&nameId=".$this->nameId."&token=".$this->token."&table=admins&suffix=admin";
        $method = "DELETE";
        $fields = array();

        //llama al método que hace la consulta. Requiere curl.controller.php
        $delete = CurlController::request($url, $method, $fields);

        //retorna status, a la función de la propiedad success, de la solicitud ajax de tables.js
        echo $delete->status;
        
    }

}


/*===============================================
  valida si la var token existe y no es null
===============================================*/

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


