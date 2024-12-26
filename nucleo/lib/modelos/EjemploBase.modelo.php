<?php

class EjemploBase {

  //put your code here

  static function consultaSESION() {    
    return $GLOBALS;
  }

  static function consultaAPI() {
    Global $Api;
    $Api::$MOSTRAR_RESPUESTA_API = true;
    $Respuesta = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'tienda', 'probarRecibirDatos', $_SESSION);
//    print_r($Respuesta);
    return $Respuesta;
  }

}
