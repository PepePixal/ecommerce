<?php

class CurlController{
    /*=====================================================
    Peticiones a la API - recibe $url, $method y $fileds (campos)
    ======================================================*/
    static public function request($url, $method, $fields){
        //código base obtenido de POSTMAN y modificado

        //asigna a $curl, la función php que inicia una sesion cURL
        $curl = curl_init();

        //configura un arreglo con la configuración para sesion $curl
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.ecommerce.com/'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: SSDFzdg235dsgsdfAsa44SDFGDFDadg'
            ),
        ));

        //ejecuta sesion cURL y asigna la respuesta a $response (string)
        $response = curl_exec($curl);

        //cierra la sesión cURL
        curl_close($curl);

        //decodifica el string de $respuesta a un JSON para php
        $response = json_decode($response);

        return $response;
    }

}