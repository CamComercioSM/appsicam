<?php

class Autenticador {
    static function sicam32($usuarioDATOS) {
        Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'seguridad', 'validarTokenUsuarioAPI', ["datos" => $usuarioDATOS]);
//        print_r($Respuesta);
        return $Respuesta;
    }

}