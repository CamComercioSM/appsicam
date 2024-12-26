<?php

class CamComercioSM {

    static function logoCorreo() {
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'CamComercioSM', 'logoCorreosCCSM');
        return $Respuesta;
    }

    static function paginaWebURL() {
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'CamComercioSM', 'paginaWebURL');
        return $Respuesta;
    }

    static function tiposPersonas() {
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'CamComercioSM', 'datosTiposPersonas');        
        return $Respuesta;
    }

    static function tiposIdentificacion() {
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'CamComercioSM', 'datosTiposIdentificacion');
        return $Respuesta;
    }

}
