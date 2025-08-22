<?php

class CategoriesController {
    /*=========================================
      Gestion Categorias - Alta y Edición
    ===========================================*/
    public function categoryManage(){
        //valida si la var name_category esta definida y no es NULL
        if (isset($_POST["name_category"])){
            
            //ejecuta script con SweetAlert en modo loading
            echo '<script>
                fncSweetAlert("loading", "", "");
            </script>';

            /*=========================================
              Validar y guardar la info en la BD
            ===========================================*/
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
                "image_category" => "",
                "description_category" => trim($_POST["description_category"]),
                "keywords_category" => strtolower($_POST["keywords_category"]),
                "date_created_category" => date("Y-m-d")
            );

            eco($fields);

            //llama método que hace la consulta a la BD a través de la api rest
            $createData = CurlController::request($url, $method, $fields);

            eco($createData);


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
}



    // public function adminManage(){
        
    //     //si la var name_admin esta definida y no es NULL
    //     if (isset($_POST["name_admin"])){
            
    //         //ejecuta script: precarga loader y lo ejuta en SweetAlert
    //         echo '<script>
    //             fncMatPreloader("on");
    //             fncSweetAlert("loading", "", "");
    //         </script>';

    //         //validación del lado del servidor del formato de email_admin, name_admin y password_admin
    //         if ( preg_match('/^(([^<>()[\]\\.,;:\s@"ñÑ]+(\.[^<>()[\]\\.,;:\s@"ñÑ]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-ZñÑ\-0-9]+\.)+[a-zA-ZñÑ]{2,}))$/', $_POST["email_admin"]) 
    //             && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]([a-zA-ZñÑáéíóúÁÉÍÓÚ ]){1,}$/', $_POST["name_admin"])) {

    //             //valida si existe la var idAdmin, significa que está EDITANDO
    //             if (isset($_POST["idAdmin"])) {

    //                 //valida si se está poniendo una nueva contraseña en el form de edidión, para cambiarla
    //                 if ($_POST["password_admin"] != "") {

    //                     //valida el formato de la contraseña, si se agrega al form, cuando EDITANDO
    //                     if (preg_match('/^[*\\$\\!\\¡\\?\\\\.\\-\\_\\#\\0-9A-Za-z]{1,}$/', $_POST["password_admin"])){

    //                         //encripta la password, con el mismo hash que utiliza la api (post.controller.php),
    //                         //para encriptar la password, de los neuevos usuario, antes de guardarlas en la BD
    //                         $crypt = crypt($_POST["password_admin"], '$2a$07$azybxcags23425sdg23sdfhsd$');

    //                     } else {

    //                         //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Tastr
    //                         echo '<script>
    //                             fncFormatInputs();
    //                             fncMatPreloader("off");
    //                             fncToastr("error", "Formato de contraseña no válido");
    //                         </script>';
    //                     }

    //                 //si no hay contraseña nueva en el form EDITANDO
    //                 } else {
    //                     //se conserva la original encriptada, que está el value del input hidden odlPassword
    //                     $crypt = $_POST["oldPassword"];
    //                 }

    //                 //define parámetros, para solicitud PUT de actualización, al endpoint de la api, siguiendo la documentación de la api
    //                 $url = "admins?id=".base64_decode($_POST["idAdmin"])."&nameId=id_admin&token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
    //                 $method = "PUT";
    //                 //envia los campos a modificar en formato sistaxis urlencoded, siguiendo la doc de la api.
    //                 $fields = "name_admin=".trim(TemplateController::capitalize($_POST["name_admin"]))."&rol_admin=".$_POST["rol_admin"]."&email_admin=".$_POST["email_admin"]."&password_admin=".$crypt;

    //                 //llama método que hace la consulta PUT a la BD, a través de la api
    //                 $updateData = Curlcontroller::request($url, $method, $fields );

    //                 //valida si la porp status es == 200, la conexión ha sido Correcta
    //                 if ($updateData->status == 200) {

    //                     //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
    //                     echo '<script>
    //                         fncFormatInputs();
    //                         fncMatPreloader("off");
    //                         fncSweetAlert("success", "Registro Adminisrador Actualizado corréctamente", "/admin/administradores");
    //                     </script>';

    //                 //si la conexión no ha sido Correcta, valida dos causas
    //                 } else {

    //                     //cuando el token del Administrador logueado está vencido, la api retorna un error 303
    //                     if ($updateData->status == 303) {
    //                         //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
    //                         echo '<script>
    //                             fncFormatInputs();
    //                             fncMatPreloader("off");
    //                             fncSweetAlert("Error", "Sesión caducada. Vuelva a iniciar sesión", "/salir");
    //                         </script>';
                        
    //                     //si no ha sido por un error 303 de token
    //                     } else {
    //                         //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Toastr
    //                         echo '<script>
    //                             fncFormatInputs();
    //                             fncMatPreloader("off");
    //                             fncToastr("error", "Error al guardar los datos modificados. Inténtalo de nuevo");
    //                         </script>';
    //                     }
    //                 }

    //             //si no esta editando, esta dando ALTA NUEVA
    //             } else {

    //                 if (preg_match('/^[*\\$\\!\\¡\\?\\\\.\\-\\_\\#\\0-9A-Za-z]{1,}$/', $_POST["password_admin"])){

    //                 //encripta la password, con el mismo hash que utiliza la api (post.controller.php),
    //                 //para encriptar la password, de los neuevos usuario, antes de guardarlas en la BD
    //                 $crypt = crypt($_POST["password_admin"], '$2a$07$azybxcags23425sdg23sdfhsd$');

    //                 }  else {

    //                     //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Tastr
    //                     echo '<script>
    //                         fncFormatInputs();
    //                         fncMatPreloader("off");
    //                         fncToastr("error", "Formato de contraseña no válido");
    //                     </script>';
    //                 }

    //                 //define la url, según el manual de la api, para crear un registro en la tabla de la BD 
    //                 $url = "admins?token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
    //                 $method = "POST";
    //                 //define array asoc con los datos de los campos a guardar
    //                 $fields = array (
    //                     //capitalize() pone en mayuscula el primer carácter de string,
    //                     //trim() elimina espacios en blanco al inicio y al final del string,
    //                     "name_admin" => trim(TemplateController::capitalize($_POST["name_admin"])),
    //                     "rol_admin" => $_POST["rol_admin"],
    //                     "email_admin" => $_POST["email_admin"],
    //                     "password_admin" => $crypt,
    //                     "date_created_admin" => date("Y-m-d")
    //                 );

    //                 //llama método que hace la consulta a la BD, a través de la api
    //                 $createData = Curlcontroller::request($url, $method, $fields );

    //                 //valida si la porp status es == 200, la conexión ha sido Correcta
    //                 if ($createData->status == 200) {

    //                     //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
    //                     echo '<script>
    //                         fncFormatInputs();
    //                         fncMatPreloader("off");
    //                         fncSweetAlert("success", "Registro Adminisrador creado corréctamente", "/admin/administradores");
    //                     </script>';

    //                 //si la conexión no ha sido Correcta, valida dos causas
    //                 } else {

    //                     //cuando el token del Administrador logueado está vencido, la api retorna un error 303
    //                     if ($createData->status == 303) {
    //                         //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
    //                         echo '<script>
    //                             fncFormatInputs();
    //                             fncMatPreloader("off");
    //                             fncSweetAlert("Error", "Sesión caducada. Vuelva a iniciar sesión", "/salir");
    //                         </script>';
                        
    //                     //si no ha sido por un error 303 de token
    //                     } else {
    //                         //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Toastr
    //                         echo '<script>
    //                             fncFormatInputs();
    //                             fncMatPreloader("off");
    //                             fncToastr("error", "ERROR al guardar los datos, inténtalo de nuevo");
    //                         </script>';
    //                     }

    //                 }

    //             }
                
    //         //si no pasa la validación de formato
    //         } else {

    //             //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Tastr
    //             echo '<script>
    //                 fncFormatInputs();
    //                 fncMatPreloader("off");
    //                 fncToastr("error", "Error en los campos, al guradar los datos");
    //             </script>';

    //         }

    //     }
    // }
