<?php

function debug($data = '', $detener = true)
{
    print "<pre>";
        //muestra la información, estructurada, de la variable
        var_dump($data);
        print "<pre>";
        if ($detener) {
            exit;
        }
}
