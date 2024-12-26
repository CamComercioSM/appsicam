<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Ayuda
 *
 * @author jpllinas
 */
class Ayuda {

    //put your code here

    static function codigoHTML($vista) {
        global $Config;
        $rutaXML = $Config->APP_DIR . 'html/' . $vista . '.xml';
        if (file_exists($rutaXML)) {
            $xml = simplexml_load_file($rutaXML);
            if ($xml) {
                if ($xml->ayuda) {
                    $titulo = ( isset($xml->ayuda->attributes()->TITULO) ? $xml->ayuda->attributes()->TITULO : "clic para ver la ayuda");
                    return '<span class="badge float float-end"><a href="' . $xml->ayuda->attributes()->URL . '" target="_blank" title="' . $titulo . '"><i class="fa-solid fa-circle-question fa-3x"></i></a></span>';
                }
            }
        }
    }
}