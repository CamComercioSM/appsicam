<?php

class EventosAsistentes {

    static function datosAsistentePorHASH($codigoASISTENTE) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
//    $Api::$MODO_PRUEBAS = true;
        $Respuesta = $Api->ejecutar(
          'tienda-apps', 'AppEventosCapacitaciones', 'consultarDatosCompletoHASHAsistente',
          ['eventoAsistenteCODIGO' => $codigoASISTENTE]
        );
        if(empty($Respuesta->DATOS)){
            return null;
        }
        return $Respuesta->DATOS;
    }    

    static function datosAsistentePorCodigo($codigoASISTENTE) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
          'tienda-apps', 'AppEventosCapacitaciones', 'consultarDatosCodigoAsistente',
          ['eventoAsistenteCODIGO' => $codigoASISTENTE]
        );
        return $Respuesta->DATOS;
    }
    
    static function consultarEscarapelaCodigoAsistente($codigoASISTENTE) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
          'tienda-apps', 'AppEventosCapacitaciones', 'consultarEscarapelaCodigoAsistente',
          ['eventoAsistenteCODIGO' => $codigoASISTENTE]
        );
        return $Respuesta->DATOS;
    }

    static function consultaSESION() {
        return $GLOBALS;
    }

    static function consultaAPI() {
        Global $Api;    
        $Respuesta = $Api->ejecutar('tienda-apps', 'tienda', 'probarRecibirDatos', ["dato_prueba"=> "gdfgsdfgsdfgdsg"]);
        return $Respuesta->DATOS;
    }
    
    static function registrarAsistencia($eventoID, $eventoAsistentePERSONAID, $eventoAsistenteIPFIRMAASISTENCIA){
        Global $Api;
        $Respuesta = $Api->ejecutar('tienda-apps', 'AppEventosCapacitaciones', 'registrarAsistencia',
                [
                   'eventoID' => $eventoID,
                   'eventoAsistentePERSONAID' => $eventoAsistentePERSONAID,
                   'eventoAsistenteIPFIRMAASISTENCIA' => $eventoAsistenteIPFIRMAASISTENCIA
                ]);
        if($Respuesta->RESPUESTA == "EXITO"){
            return RespuestasSistema::exito($Respuesta->MENSAJE, true);
        }
        
        return RespuestasSistema::informacion($Respuesta->MENSAJE);
    }
    
    static function registrarAsistenciaGrupo($eventoENCRIPTADOGRUPO, $eventoAsistentePERSONAID, $eventoAsistenteIPFIRMAASISTENCIA){
        Global $Api;
        $Respuesta = $Api->ejecutar('tienda-apps', 'AppEventosCapacitaciones', 'registrarAsistenciaGrupo',
                [
                   'eventoENCRIPTADOGRUPO' => $eventoENCRIPTADOGRUPO,
                   'eventoAsistentePERSONAID' => $eventoAsistentePERSONAID,
                   'eventoAsistenteIPFIRMAASISTENCIA' => $eventoAsistenteIPFIRMAASISTENCIA
                ]);
        if($Respuesta->RESPUESTA == "EXITO"){
            return RespuestasSistema::exito($Respuesta->MENSAJE, true);
        }
        
        return RespuestasSistema::informacion($Respuesta->MENSAJE);
    }
    
    static function traerDatosAsistentePorCorreoIdentificacion($correo, $identificacion){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosAsistentePorCorreoIdentificacion',
                ["eventoAsistentePERSONACORREO" => $correo,
                 "eventoAsistentePERSONAID" => $identificacion]);
        return $Respuesta;
    }
    
    static function encuentros($asistenteID){
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'encuentrosDelAsistente', ['asistenteID' => $asistenteID]);
        return $Respuesta;
    }
    
    static function datosPersona($personaID){
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPersona', ['personaID' => $personaID]);
        return $Respuesta;
    }
    
    static function guardarRespuesta($encuentroID, $asistenteID, $preguntaID, $respuesta, $completado){
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'guardarRespuesta',
                ["encuentroEventoID" => $encuentroID,
                 "asistenteEventoID" => $asistenteID,
                 "preguntaEncuentroEventoID" => $preguntaID,
                 "respuestaEncuentroEventoDESCRIPCION" => $respuesta,
                 "completado" => $completado]);
        return $Respuesta;
    }
    
    static function asistentesConfirmadosPorEventoID($eventoID){
        Global $Api;
        $Respuesta = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'asistentesConfirmadosPorEventoID', ['eventoID' => $eventoID]);
        return $Respuesta;
    }
}