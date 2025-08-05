<?php

class AdminsController {

    /*===================================
    Login de administradores
    ====================================*/
    public function login(){

        //valida si en $_POST existe la var "loginAdminEmail" del form login admin
        if(isset($_POST["loginAdminEmail"])) {

             /*=========================================
                carga plugin Preloader
            =========================================*/
            echo '<script>
                fncMatPreloader("on");
            </script>';

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

            //si la solicitud ha dado error, muestra nestra alerta con un div.
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

        }

    }

}