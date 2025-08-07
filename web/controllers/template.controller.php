<?php

//instancia las clases de la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    /*==========================================
      Envio correos electrónicos con PHP Mailer
    ===========================================*/
    static public function sendEmail($subject, $email, $message, $link ){

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
        //contenido html del email, recibido como parámetro
        $mail->msgHTML($message);

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

}