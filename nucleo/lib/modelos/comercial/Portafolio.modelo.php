<?php

class Portafolio {

  //put your code here

  static function todos() {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $Respuesta = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'tienda', 'probarRecibirDatos', $_SESSION);
//    print_r($Respuesta);
    return $Respuesta;
  }

}
