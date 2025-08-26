<?php

class CategoriesController {

    /*=========================================
      Gestion Categorias - Alta y Edición
    ===========================================*/

    public function categoryManage(){

        //valida, si name_category está definida y no es NULL
        if (isset($_POST["name_category"])){
            
            //ejecuta script con SweetAlert en modo loading
            // echo '<script>
            //     fncSweetAlert("loading", "", "");
            // </script>';

            /*=========================================
              Validar si está EDITANDO
            ===========================================*/
            //valida, si desde el form se ha enviado idCategory del input hidden
            if (isset($_POST["idCategory"])) {

                //valida si ya hay una nueva imagen temporal en el formulario para guardar - EDITANDO
                if (isset($_FILES["image_category"]["tmp_name"]) && !empty($_FILES["image_category"]["tmp_name"])){

                    /*=========================================
                       EDITANDO - Validar y guardar la imagen
                    ===========================================*/
                    //obtine arreglo con la info del archivo enviado por el form (imagen categoria)
                    $image = $_FILES["image_category"];
                    //var con la url de la carpeta, según la url de la categoría, para guardar el archivo subido
                    $folder = "assets/img/categories/".$_POST["url_category"];
                    //var con el nombre del archivo igual a la url de la categoría
                    $name = $_POST["url_category"];
                    //vars con el tamaño, en pixels, con el que queremos guardar las imágenes 
                    $width = 1000;
                    $height = 600;

                    //llama método saveImage() enviando el arreglo con la info del archivo (imagen), 
                    //carpeta donde gurdar el archivo y nombre del archivo a guardar, tamaño de la imagen,
                    //el método retornara el nombre final del archivo a guardar en la BD o error
                    $saveImageCategory = TemplateController::saveImage($image, $folder, $name, $width, $height);
                
                //si no hay una nueva imagen temporal para subir
                } else {

                    //obtener el nombre de la imagen original del registro
                    $saveImageCategory = $_POST["old_image_category"];

                }

                /*==============================================
                  EDITANDO - Validar y guardar la info en la BD
                ===============================================*/
                //define $url para PUT a la tabla categorias, siguiendo la documentación de la API rest.
                //tomando el idCategory, enviado por el input hidden del form, como referencia a buscar..
                $url = "categories?id=".base64_decode($_POST["idCategory"])."&nameId=id_category&token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
                $method = "PUT";
                //almacena la info de los campos, como cadena de texto (no como array), porque el método es PUT
                //capitalize() pone la primera letra en mayúscula de cada palabra.
                //trim() elimina espacio en blanco al inicio y al fianal de la cadena
                $fields ="name_category=".trim(TemplateController::capitalize($_POST["name_category"]))."&url_category=".$_POST["url_category"]."&icon_category=".$_POST["icon_category"]."&image_category=".$saveImageCategory."&description_category=".trim($_POST["description_category"])."&keywords_category=".strtolower($_POST["keywords_category"]);

                //llama método que hace la consulta PUT a la BD, a través de la API rest
                $updateData = CurlController::request($url, $method, $fields);
                
                //si la actualización del registro ha sido exitosa, status = 200
                if ($updateData->status == 200){

                    //ejecuta script, limpia los input del form, muestra alerta SweetAlert
                    echo '<script>
                        fncFormatInputs();
                        fncSweetAlert("success", "Datos actualizados", "/admin/categorias");
                    </script>';

                //si el alta del registro NO ha sido exitosa, por token expirado, status = 303
                } else {

                    if ($updateData->status == 303){
                        //ejecuta script: limpia los input del form, muestra alerta SweetAlert
                        echo '<script>
                            fncFormatInputs();
                            fncSweetAlert("error", "Token expirado. Vuelve a iniciar sesión", "/salir");
                        </script>';

                    //si el alta del registro NO ha sido exitosa, por error 404, 400 u otros
                    } else {

                        //ejecuta script: limpia los input del form, muestra alerta Toastr
                            echo '<script>
                                fncFormatInputs();
                                fncToastr("error", "Error al actualizar los datos. Intentelo de nuevo");
                            </script>';
                    }

                }
                
            //si NO está editando, está en ALTA nueva
            } else {

                /*=========================================
                  ALTA NUEVA - Validar y guardar la imagen
                ===========================================*/
                //valida si existe y no es NULL la var "tmp_name" y que la var no esté vacia
                if (isset($_FILES["image_category"]["tmp_name"]) && !empty($_FILES["image_category"]["tmp_name"])){

                    //obtine arreglo con la info del archivo enviado por el form (imagen categoria)
                    $image = $_FILES["image_category"];
                    //var con la url de la carpeta, según la url de la categoría, para guardar el archivo subido
                    $folder = "assets/img/categories/".$_POST["url_category"];
                    //var con el nombre del archivo igual a la url de la categoría
                    $name = $_POST["url_category"];
                    //vars con el tamaño, en pixels, con el que queremos guardar las imágenes 
                    $width = 1000;
                    $height = 600;

                    //llama método saveImage() enviando el arreglo con la info del archivo (imagen), 
                    //carpeta donde gurdar el archivo y nombre del archivo a guardar, tamaño de la imagen,
                    //el método retornara el nombre final del archivo a guardar en la BD o error
                    $saveImageCategory = TemplateController::saveImage($image, $folder, $name, $width, $height);

                //si la var "tmp_name" NO existe o es NULL o está vacia  
                } else {

                    //ejecuta script con alerta Notice y limpia Inputs
                    echo '<script>
                            fncFormatInputs():
                            fncNotice(3, "El campo imagen no puede ir vacio");
                    </script>';

                    return;

                }

                /*=================================================
                  ALTA NUEVA - Validar y guardar la info en la BD
                ==================================================*/
                //define $url para POST a la tabla categorias, siguiendo la documentación de la api rest
                $url = "categories?token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
                $method = "POST";
                //almacena la info de los campos del post, para enviarlos a la api 
                $fields = array(
                    //capitalize() pone la primera letra en mayúscula de cada palabra.
                    //trim() elimina espacio en blanco al inicio y al fianal de la cadena
                    "name_category" => trim(TemplateController::capitalize($_POST["name_category"])),
                    "url_category" => $_POST["url_category"],
                    "icon_category" => $_POST["icon_category"],
                    "image_category" => $saveImageCategory,
                    "description_category" => trim($_POST["description_category"]),
                    "keywords_category" => strtolower($_POST["keywords_category"]),
                    "date_created_category" => date("Y-m-d")
                );

                //llama método que hace la consulta POST a la BD, a través de la api rest
                $createData = CurlController::request($url, $method, $fields);

                //si el alta del registro ha sido exitosa, status = 200
                if ($createData->status == 200){

                    //ejecuta script, limpia los input del form, muestra alerta SweetAlert
                    echo '<script>
                        fncFormatInputs();
                        fncSweetAlert("success", "Datos registrados", "/admin/categorias");
                    </script>';

                //si el alta del registro NO ha sido exitosa, por token expirado, status = 303
                } else {

                    if ($createData->status == 303){
                        //ejecuta script: limpia los input del form, muestra alerta SweetAlert
                        echo '<script>
                            fncFormatInputs();
                            fncSweetAlert("error", "Token expirado. Vuelve a iniciar sesión", "/salir");
                        </script>';

                    //si el alta del registro NO ha sido exitosa, por error 404 o 400
                    } else {

                        //ejecuta script: limpia los input del form, muestra alerta Toastr
                            echo '<script>
                                fncFormatInputs();
                                fncToastr("error", "Error al guardar los datos. Intentelo de nuevo");
                            </script>';
                    }

                }

            }

        }

    }// fin func categoryManage()

} //fin Class


