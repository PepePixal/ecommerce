<?php

//para la conexión a la BD a través de la api, se requerirá el método de curl.controller.php
require_once "../controllers/curl.controller.php";
//para usar la función htmlClean()
require_once "../controllers/template.controller.php";

class DatatableController{

    public function data() {

        //valida si No viene vacia, la var array $_POST, generado por la peticion ajax de tables.js
        if(!empty($_POST)){

            /*=========================================================
              Definir variables para guardar la info que trae $_POST
            =========================================================*/

            //echo '<pre>$draw '; print_r($_POST); echo '</pre>';

            //["draw"] es el contador utilizado por DataTables, para garantizar que los retornos de Ajax
            //de las solicitudes de procesamiento del lado del servidor, sean dibujados en secuencia por DataTables
            $draw = $_POST["draw"];
            // echo '<pre>$draw '; print_r($draw); echo '</pre>';
            //índice de la columna de clasificación. (0 basado en el índice, es decir, 0 es el primer registro)
            $orderByColumnIndex = $_POST["order"][0]["column"];
            // echo '<pre>$orderByColumnIndex '; print_r($orderByColumnIndex); echo '</pre>';
            //Obtener el nombre de la columna de clasificación de su índice
            $orderBy = $_POST["columns"][$orderByColumnIndex]["data"];
            // echo '<pre>$orderBy '; print_r($orderBy); echo '</pre>';
            //obtener el orden ASC o DESC
            $orderType = $_POST["order"][0]["dir"];
            // echo '<pre>$orderType '; print_r($orderType); echo '</pre>';
            //indicador del primer registro de paginación
            $start = $_POST["start"];
            // echo '<pre>$start '; print_r($start); echo '</pre>';
            //indicador de la longitud de la paginación
            $length = $_POST["length"];
            // echo '<pre>$length '; print_r($length); echo '</pre>';

            /*==========================================
              Total de registros de la tabla
            ============================================*/
            //define los parámetros para la consulta (query) a la api
            //De la tabla categories, selecciona la columna id_category
            $url = "categories?select=id_category";
            $method = "GET";
            $fields = array();

            //llama método query que hace la consulta a la api, enviando parámetros
            $response = CurlController::request($url, $method, $fields);

            //valida si la propiedad [status] de la respuesta es == 200, conexión ok
            if ($response->status == 200) {

                //obtiene el total de registros, de la prop [total] de la respuesta de la api rest
                $totalData = $response->total;

            //si la conexión no es correcta o la tabla está vacia
            } else {
                //retorna un json con datos para que pinte la tabla y la data vacia, a tables.js
                echo '{
                    "Draw": 1,
                    "recordsTotal": 0,
                    "recordsFiltered": 0,
                    "data":[]
                }';
                //para el código aquí
                return;
            }


            //var con las columnas de donde obtener la info del registro. En SQL * representa de todas las columnas
            $select = "*";
            

            /*============================================
              Búsqueda de datos del buscador DataTable
            ============================================*/

            //valida si NO esta vacia la propiedad value de search
            if (!empty($_POST['search']['value'])) {

                //valida si el contenido de ['value'] coincide con la expresión regular,
                //para garantizar que no se trata de una cadena de carácteres raros.
                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])){

                    //define arreglo con las columnas de la tabla sobre las que se hará la búsqueda
                    $linkTo = ["name_category", "url_category", "description_category", "keywords_caegory", "date_updated_category"];

                    //reemplaza los espacios en blanco " " por "_" , del valor de 'value', para mejora la búsqueda en la Bd
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    //itera el array con las columnas en las se hará al búsqueda y en cada columna:
                    foreach ($linkTo as $key => $value) {

                        //Define la url utilizando las variables creadas con la info que genera DataTable en $_POST.
                        //De la tabla categories, selecciona las columnas $select y obten la info, de los registros que en la columna $value, contengan la cadena buscada $searh, ordenando los registros obtenidos según la comlumna en $orderBy,
                        //con el tipo de orden en $orderType, iniciando en el registro $start y finalizando en el registro $length que contiene el número de registros por paginación.
                        $url = "categories?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

                        //llama método query que hace la consulta a la api, enviando parámetros,
                        //y asigna a $data solo el contenido del atributo results
                        $data = CurlController::request($url, $method, $fields)->results;

                        //valida si $data = "Not found", que es como lo devolverá la api, si no se han encontrado coincidencias
                        if($data == "Not Found"){

                            $data = array();
                            //define var, cantidad de registros encontrados
                            $recordsFiltered = 0;

                        //si se han encontrado coincidencias con lo buscado
                        } else {

                            //define var, cantidad de rgistros encontrados
                            $recordsFiltered = count($data);
                            //parar el foreach
                            break;
                        }

                    } //fin foreach

                //si contiene carácteres raros
                } else {

                    //retorna un json con datos para que pinte la tabla y la data vacia, a tables.js
                    echo '{
                        "Draw": 1,
                        "recordsTotal": 0,
                        "recordsFiltered": 0,
                        "data":[]
                    }';
                    //para el código aquí
                    return;
                }


            //si no hay value para buscar (buscador de DataTable)
            } else {

                /*==========================================
                Obtener datos seleccionados, en un orden
                ============================================*/
                //Define la url utilizando las variables creadas con la info que genera DataTable en $_POST.
                //De la tabla categories, selecciona las columnas en $select (*) y obten la info, ordenándola según la comlumna en $orderBy,
                //con el tipo de orden en $orderType, iniciando en el registro $start y finalizando en el registro $length que contiene el número de registros por paginación.
                $url = "categories?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
                
                //llama método query que hace la consulta a la api, enviando parámetros,
                //y asigna a $data solo el contenido del atributo results
                $data = CurlController::request($url, $method, $fields)->results;

                //registros filtrados
                $recordsFiltered = $totalData;

            }

            /*==========================================
              Cuando la $data viene vacia
            ============================================*/
            if (empty($data)) {

                //retorna un json con datos para que pinte la tabla y la data vacia, a tables.js
                echo '{
                    "Draw": 1,
                    "recordsTotal": 0,
                    "recordsFiltered": 0,
                    "data":[]
                }';
                //para el código aquí
                return;
            }

            /*=======================================================================
             Construir del dato JSON con la info de la BD, para retornar a DataTable
            ========================================================================*/
            $dataJson = '{
                "Draw": '.intval($draw).',
                "recordsTotal": '.$totalData.',
                "recordsFiltered": '.$recordsFiltered.',
                "data": [';  
                    foreach ($data as $key => $value) {

                        /*===========================
                          Status
                        ===========================*/
                        $status_category = $value->status_category;

                        /*===========================
                          Textos
                        ===========================*/
                        //define variables
                        $name_category = $value->name_category;
                        $url_category = $value->url_category;
                        $image_category = $value->image_category;
                        $description_category = $value->description_category;
                        $keywords_category = $value->keywords_category;
                        $subcategories_category = $value->subcategories_category;
                        $products_category = $value->products_category;
                        $views_category = $value->views_category;
                        $date_updated_category = $value->date_updated_category;

                        //iconos editar y eliminar.
                        //a href, envia a la url agregandole el argumento admin con el id_admin, codificado con base64_encode()
                        $actions = "<div class=btn-group>
                                    <a href='/admin/categorias/gestion?admin=".base64_encode($value->id_category)."' class='btn bg-purple border-0 rounded-pill mr-2 btn-sm px-3'>
                                        <i class='fas fa-pencil-alt text-white'></i>
                                    </a>
                                    <button class='btn btn-dark border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='categories' column='category' idItem='".base64_encode($value->id_category)."'>
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </button>
                                </div>";
                        
                        //aplica la función htmlClean() a $actions, para eliminar los espacios 
                        $actions = TemplateController::htmlClean($actions);

                        $dataJson.='{
                            "id_category":"'.($start+$key+1).'",
                            "status_category":"'.$status_category.'",
                            "name_category":"'.$name_category.'",
                            "url_category":"'.$url_category.'",
                            "image_category":"'.$image_category.'",
                            "description_category":"'.$description_category.'",
                            "keywords_category":"'.$keywords_category.'",
                            "subcategories_category":"'.$subcategories_category.'",
                            "products_category":"'.$products_category.'",
                            "views_category":"'.$views_category.'",
                            "date_updated_category":"'.$date_updated_category.'",                            
                            "actions":"'.$actions.'"
                        },';
                    }
                    
            //substr retorna un nuevo string $dataJson, desde el primer caracter (0) menos el último, que es una coma, para que no rompa la tabla. pasa de {},...,{}, a {},...{}
            $dataJson = substr($dataJson,0,-1);

            $dataJson .= ']}';

            //retorna del objeto json con la info, a tables.js
            echo $dataJson;
        }

    }

}

/*=================================
  Activar la función DataTable
=================================*/
$data = new DatatableController();
$data-> data(); 