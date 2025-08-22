<?php

//instancia las clases de la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TemplateController{
    
    //incluye la vista principal de la plantilla
    public function index(){
        include "views/template.php";
    }

    /*==========================================
      Obtener la ruta o path
    ===========================================*/
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

    /*==========================================
      Envio correos electrónicos con PHP Mailer
    ===========================================*/
    static public function sendEmail($subject, $email, $title, $message, $link ){

        //definir la zona horaria donde nos encontremos
        date_default_timezone_set("Europe/Madrid");

        //instanciar la clase PHPMailer
        $mail = new PHPMailer;

        //definir el uso de carácteres latinos
        $mail->CharSet = 'utf-8';
        
        //Habilitar esta línea, al subir el proyecto a un Hosting:
        //$mail->Encoding = 'base64';

        //permite enviar correos usando recursos del servidor Local
        $mail->isMail();

        $mail->UseSendmailOptions = 0;

        //quien envía el correo (From)
        $mail->setFrom("noreply@ecommerce.com", "Ecommerce");
        //asunto (subject) = recibido como parámetro.
        $mail->Subject = $subject;
        //a donde se enviará el correo, recibido como parámetro
        $mail->addAddress($email);
        //contenido html del email, copiado de la template-email.html y modificado con parámetros recibidos
        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family: sans-serif; padding-top: 40px; padding-bottom:  40px;">
            <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px;">
                <center>
                    <img src="'.TemplateController::path().'views/assets/img/template/1/logo.png" style="padding:20px; width: 30%">
                    <h3 style="font-weight: 100; color: #999">'.$title.'</h3>
                    <hr style="border: 1px solid #ccc; width: 80%;">
                    '.$message.'
                    <a href="'.$link.'" target="_blank" style="text-decoration: none;">
                        <div style="line-height: 25px; background: #000; width: 60%; padding: 10px; color: white; border-radius: 5px;">Haz clic aquí</div>
                    </a>
                    <hr style="border: 1px solid #ccc; width: 80%;">
                    <h5 style="font-weight: 100; color: #999">Si no solicitó el envio de este correo, póngase en contacto con nosotros.</h5>
                </center>
            </div>
        </div>
        ');

        //crea el mensaje y lo envía, retornando resultado bool en $send
        $send = $mail->Send();

        //vllida si el envio NO ha sido true
        if(!$send){
            //retorna la info del error, en la propiedad de PHPMailer ErrorInfo
            return $mail->ErrorInfo;
        } else {
            return "ok";
        }

    }

    /*==========================================
      Limpiar HTML para JSON
    ===========================================*/
    static public function htmlClean($code){

        $search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
        $replace = array('>','<','\\1');
        $code = preg_replace($search, $replace, $code);
        $code = str_replace("> <", "><", $code);
        return $code;
    }


    /*=======================================================================
      Capitalizar Strings - pone en mayúscula el primer carácter del strings
    =========================================================================*/
    //requiere parámetro, string a capitalizar
    static public function capitalize($value) {
        $value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
        return $value;
     }


    /*=======================================================================
      Reducir catidad de texto en un párrafo según el limit
    =========================================================================*/
    //requiere texto a reducir y el límite de pala
    static public function reduceText($value, $limit){

        //valida si la longitud del texto > que el límite deseado
        if (strlen($value) > $limit){

            //obtiene el trozo de texto desde la posición inicial 0 hasta la posicón limit,
            //le concatena "..." y lo reasigna a la var $value.
            $value = substr($value, 0, $limit)."...";
        }
        //retorna 
        return $value;
    }

    /*==========================================
      Almacenar imágenes al servidor
    ===========================================*/
    //recibe info del archivo $image a guardar, carpeta, nombre y tamaño con el que queremos guardar la imagen,
    //retorna el nombre final del archivo a guradar en la BD o error
    static public function saveImage($image, $folder, $name, $width, $height){
        
        //valida si existe y no es null la var ["tmp_name"] y no está vacia
        if (isset($image["tmp_name"]) && !empty($image["tmp_name"])) {

            /*==============================================================
              Configura la ruta del directorio donde se guardará la imagen
            ===============================================================*/
            //agrega la carpeta views/ a la ruta recibida en $folder y lo convierte todo a minúsculas.
            //estó servirá por si tenemos los assets/ en otro directorio, lo cambiamos aquí.
            $directory = strtolower("views/".$folder);

            /*===================================================================
              Validar si NO existe el directorio final, crearlo con los permisos
            ====================================================================*/
            if (!file_exists($directory)) {
                mkdir($directory, 0755);
            }

            /*===================================================================
              Capturar el alto y ancho originaes de la imagen
            ====================================================================*/
            //getimagesize() retorna un arreglo cuyos index [0] y [1] son whidth y height de una imagen
            //list() asigna a variables, si los valores son obtenidos de un array,
            list($lastWidth, $lastHeight) = getimagesize($image["tmp_name"]);

            //validar si el ancho $lastWidht o el alto $lastHeight originales de la imagen,
            //son menores que los queremos guradar, recibidos como params $whidht y $height 
            if ($lastWidth < $width || $lastHeight < $height) {

                //asigna los tamaños tamaños deseados a los tamaños originales
                $lastWidth = $width;
                $lastHeight = $height;
            }

            /*===================================================================
              Según el tipo de archivo se asignan funciones
            ====================================================================*/
            if($image["type"] == "image/jpeg"){

                //define extensión del archivo a guardar
                $newName = $name.'.jpg';
                //define el directorio y nombre final, donde guardar el archivo
                $folderPath = $directory.'/'.$newName;
                //crea una copia de la imagen temp

    //debug($image["tmp_name"]);

                $start = imagecreatefromjpeg($image["tmp_name"]);
                //instrucciones para aplicar a la imagen definitiva
                $end = imagecreatetruecolor($width, $height);
                //transforma la copia de la imagen tmp, tomando los nuevos tamaños
                imagecopyresized($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);
                //guarda la imagen final $end, en el directorio y con el nombre de $floderPath
                imagejpeg($end, $folderPath);

            }
            
            if($image["type"] == "image/png"){

                //define extensión del archivo a guardar
                $newName = $name.'.png';
                //define el directorio y nombre final, donde guardar el archivo
                $folderPath = $directory.'/'.$newName;
                //crea una copia de la imagen temp
                $start = imagecreatefrompng($image["tmp_name"]);
                //instrucciones para aplicar a la imagen definitiva
                $end = imagecreatetruecolor($width, $height);
                //mantiene la transparencia si existe
                imagealphablending($end, FALSE);
                imagesavealpha($end, TRUE);
                //transforma la copia de la imagen tmp, tomando los nuevos tamaños
                imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);
                //guarda la imagen final $end, en el directorio y con el nombre de $floderPath
                imagejpeg($end, $folderPath);

            }
            
            if($image["type"] == "image/gif"){

                //define extensión del archivo a guardar
                $newName = $name.'.gif';
                //define el directorio y nombre final, donde guardar el archivo
                $folderPath = $directory.'/'.$newName;
                //gurada la imagen, en el directorio y con el nombre de $floderPath 
                move_uploaded_file($image["tmp-name"], $folderPath);
            }

            //retorna el nombre del archivo, para guardarlo en la BD
            return $newName;

        //si la var ["tmp_name"] NO existe o es null o está vacia
        } else {

            return "error";

        }

    }

}