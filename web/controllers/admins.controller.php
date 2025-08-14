<?php

class AdminsController {

    /*===================================
      Login de administradores
    ====================================*/
    public function login(){

        //valida si en $_POST existe y no es nula, la var "loginAdminEmail" del form login admin
        if(isset($_POST["loginAdminEmail"])) {

            /*=========================================
                carga plugin Preloader
            =========================================*/
            echo '<script>
                fncMatPreloader("on");
                fncSweetAlert("loading", "", "");
            </script>';

            /*=======================================
             Validación de email - Lado del servidor
            ========================================*/
            //valida el formato del email recibido en $_POST, según la expresión regular
            if(preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST["loginAdminEmail"])){

                /*=========================================
                    Solicitud de login a la API
                =========================================*/
                //definir parámetros para la solicitud, segun la docum de la API
                $url = "admins?login=true&suffix=admin";
                $method = "POST";
                //envia los valores de los campos, recibidos del form en $_POST
                $fields = array(
                    "email_admin" => $_POST["loginAdminEmail"],
                    "password_admin" => $_POST["loginAdminPass"]
                );

                //llama método que realiza la solicitud, enviano parámetros, retorna object(stdClass)
                $login = CurlController::request($url, $method, $fields);

                //valida si la propiedad status del objeto $login es = 200, solicitud ok
                if ($login->status == 200) {

                    //obtine la info del registro de administrador consultado y
                    //lo asigna a la var "admin" del arreglo $_SESSION
                    $_SESSION["admin"] = $login->results[0];

                    //imprime un <script> que recarga la página actual ecommerce.com/admin,
                    //volviendo a cargar template.php, donde se separa la url y se comprueba:
                    //si existe la var "admin" en $_SESSION, para cargar el botón que activa el slide lateral y
                    //si la url contiene /admin, para cargar admin.php o home.php
                    //si carga admin.php, se comprueba  y si hay algo en $_SESSION["admin"] y se carga tablero.php
                    echo '<script>
                        location.reload();
                    </script> ';

                //si la solicitud ha dado error, muestra nuestra alerta con un div.
                //Se pueden probar tres tipos de alertas más de plugins, configuradas en alerts.js.
                //La fncMatPreloader("off") detiene el preloader. 
                //Al final formatea los inputs el formulario Administradores
                } else {
                    echo '
                        <div class="alert alert-danger mt-3">Error: '.$login->results.'</div>

                        <script>
                            // fncNotie("error", "Error: '.$login->results.'");
                            // fncSweetAlert("error", "Error: '.$login->results.'", "");
                            fncToastr("error", "Error: '.$login->results.'" );

                            fncMatPreloader("off");

                            fncFormatInputs();
                        </script>
                    ';
                }

            //si el fomrmato de email NO es válido
            } else {
                echo '
                    <div class="alert alert-danger mt-3">Error de formato</div>

                    <script>
                        // fncNotie("error", "Error de formato");
                        // fncSweetAlert("error", "Error de formato", "");
                        fncToastr("error", "Error de formato" );

                        fncMatPreloader("off");

                        fncFormatInputs();
                    </script>
                ';
            }

        }

    }


    /*===================================
      Recuperar Contraseña
    ====================================*/
    public function resetPassword() {

        //valida si la var resetPassword que viene del form, está declarada y no es null
        if(isset($_POST["resetPassword"])){

            /*=========================================
                carga plugin Preloader
            =========================================*/
            echo '<script>
                fncMatPreloader("on");
                fncSweetAlert("loading", "", "");
            </script>';
             
            //valida la sintaxis del valor de la var resetPassword, formato email válido
            if(preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST["resetPassword"])) {

                    /*=========================================================
                      Consultar si el email (usuario) está registrado en la BD
                    ===========================================================*/
                    //Defie los parámentros para la consulta GET a la api.
                    //En la tabla admins, en la columna email_admin, busca si hay algun registro cuyo valor
                    //sea igual al valor de la var $_POST["resetPassword"],
                    //si lo hay, obten únicamente el valor de la columna id_admin
                    $url = "admins?linkTo=email_admin&&equalTo=".$_POST["resetPassword"]."&select=id_admin";
                    $method = "GET";
                    $fields = array();
                    
                    //llama al método request() enviando argumentos
                    $admin = CurlController::request($url, $method, $fields);
                    
                    //valida, si la propiedad status es = 200, existe el correo en la tabla admins de BD
                    if($admin->status == 200){
                        //funcion q genera una contraseña aleatória de $length carácteres, basada en $chain, 
                        function genPassword($length){
                            //define vars
                            $password = "";
                            $chain = "0123456789abcdefghijklmnopqrstuvwxyz";
                            //str_shuffle() desordena el string inventado $chain,
                            //substr() sustrae del string desordenado, empezando por la posición 0,
                            //la cantidad de carácteres $length.
                            $password = substr(str_shuffle($chain), 0, $length);
                            return $password;
                        }

                        //llama genPassword() enviando cantidad de carácteres a sustraer
                        $newPassword = genPassword(11);

                        //encripta la nueva password, con el mismo hash que utiliza la api (post.controller.php),
                        //para encriptar la password, de los neuevos usuario, antes de guardarlas en la BD
                        $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');
                        
                        
                        /*=========================================================
                        Actualizar la nueva contraseña del usuario, en la BD
                        ===========================================================*/
                        //define parámetros para la request PUT, siguiendo la documentación de la api,
                        //en la sección CREAR O EDITAR UN REGISTRO CON EXCEPCIÓN
                        $url = "admins?id=".$admin->results[0]->id_admin."&nameId=id_admin&token=no&except=password_admin";
                        $method = "PUT";
                        $fields = "password_admin=".$crypt;
                        
                        //llama func request() enviando params, instanciando la class
                        $updatePassword = CurlController::request($url, $method, $fields);
                        
                        if($updatePassword->status == 200){
                        
                            //Definición de parámetros para enviar al método sendEmail()
                            //asunto del email
                            $subject = "Envio de nueva contraseña, desde Ecommerce";
                            //destinatario del email, obtenido del $_POST del form restablecer password
                            $email = $_POST["resetPassword"];
                            //titulo para la plantilla
                            $title = "SOLICITUD DE NUEVA CONTRAEÑA";
                            //contenido html del email
                            $message = '<h4 style="font-weight: 100; color: #999; padding: 0px 20px;"><strong>Su nueva contraseña: '.$newPassword.'</strong></h4>
                            <h4 style="font-weight: 100; color: #999; padding: 0px 20px;">Acceda nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario.</h4>';
                            //enlace que retorne a la página ecommerce.com/admin
                            $link = TemplateController::path().'admin';

                            //llama func sendEmail() enviando params, instanciando su class. Retorna string.
                            $sendEmail = TemplateController::sendEmail($subject, $email, $title ,$message, $link);

                            //valida si el resultado del envio es "ok"
                            if ($sendEmail == "ok") {
                                echo '
                                    <script>
                                        fncFormatInputs();
                                        fncMatPreloader("off");

                                        // fncNotie("success", "Su nueva contraseña ha sido enviada. Revise la carpeta de spam");
                                        // fncSweetAlert("success", "Su nueva contraseña ha sido enviada. Revise la carpeta de spam", "");
                                        fncToastr("success", "Su nueva contraseña ha sido enviada. Revise la carpeta de spam" );
                                    </script>
                                ';

                            //si el resultado del envio NO ha sido "ok"
                            } else {
                                echo '
                                    <script>
                                        fncFormatInputs();
                                        fncMatPreloader("off");

                                        fncNotie("error", "'.$sendEmail.'");
                                        // fncSweetAlert("error", "'.$sendEmail.'", "");
                                        // fncToastr("error", "'.$sendEmail.'" );
                                    </script>
                                ';
                            }
                        }

                    //si no es = 200, el correo no existe en la BD de admins de la BD
                    } else {
                        echo '<script>
                                fncFormatInputs();
                                fncMatPreloader("off");
                                fncNotie("error", "El correo no existe");
                            </script>
                        ';
                    }
            }

        }

    }

    /*===================================
      Gestion Administradores
    ====================================*/
    public function adminManage(){
        
        //si la var name_admin esta definida y no es NULL
        if (isset($_POST["name_admin"])){
            
            //ejecuta script: precarga loader y lo ejuta en SweetAlert
            echo '<script>
                fncMatPreloader("on");
                fncSweetAlert("loading", "", "");
            </script>';
        

            //validación del lado del servidor del formato de email_admin, name_admin y password_admin
            if ( preg_match('/^(([^<>()[\]\\.,;:\s@"ñÑ]+(\.[^<>()[\]\\.,;:\s@"ñÑ]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-ZñÑ\-0-9]+\.)+[a-zA-ZñÑ]{2,}))$/', $_POST["email_admin"]) 
                && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]([a-zA-ZñÑáéíóúÁÉÍÓÚ ]){1,}$/', $_POST["name_admin"])
                && preg_match('/^[*\\$\\!\\¡\\?\\\\.\\-\\_\\#\\0-9A-Za-z]{1,}$/', $_POST["password_admin"]) ) {

                //encripta la password, con el mismo hash que utiliza la api (post.controller.php),
                //para encriptar la password, de los neuevos usuario, antes de guardarlas en la BD
                $crypt = crypt($_POST["password_admin"], '$2a$07$azybxcags23425sdg23sdfhsd$');

                //define la url, según el manual de la api, para crear un registro en la tabla de la BD 
                $url = "admins?token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
                $method = "POST";
                //define array asoc con los datos de los campos a guardar
                $fields = array (
                    //capitalize() pone en mayuscula el primer carácter de string,
                    //trim() elimina espacios en blanco al inicio y al final del string,
                    "name_admin" => trim(TemplateController::capitalize($_POST["name_admin"])),
                    "rol_admin" => $_POST["rol_admin"],
                    "email_admin" => $_POST["email_admin"],
                    "password_admin" => $crypt,
                    "date_created_admin" => date("Y-m-d")
                );

                //llama método que hace la consulta a la BD, a través de la api
                $createData = Curlcontroller::request($url, $method, $fields );

                //valida si la porp status es == 200, la conexión ha sido Correcta
                if ($createData->status == 200) {

                    //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
                    echo '<script>
                        fncFormatInputs();
                        fncMatPreloader("off");
                        fncSweetAlert("success", "Registro Adminisrador creado corréctamente", "/admin/administradores");
                    </script>';

                //si la conexión no ha sido Correcta, valida dos causas
                } else {

                    //cuando el token del Administrador logueado está vencido, la api retorna un error 303
                    if ($createData->status == 303) {
                        //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas SweetAlert
                        echo '<script>
                            fncFormatInputs();
                            fncMatPreloader("off");
                            fncSweetAlert("Error", "Sesión caducada. Vuelva a iniciar sesión", "/salir");
                        </script>';
                    
                    //si no ha sido por un error 303 de token
                    } else {
                        //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Toastr
                        echo '<script>
                            fncFormatInputs();
                            fncMatPreloader("off");
                            fncToastr("error", "Error al guardar los datos, inténtalo de nuevo");
                        </script>';
                    }

                }

            //si no pasa la validación de formato
            } else {

                //ejecuta el script: formatea los inputs, desactiva MatPreloader y llama al plugin de alertas Tastr
                echo '<script>
                    fncFormatInputs();
                    fncMatPreloader("off");
                    fncToastr("error", "Error en los campos, al guradar los datos");
                </script>';

            }

        }
    }

}