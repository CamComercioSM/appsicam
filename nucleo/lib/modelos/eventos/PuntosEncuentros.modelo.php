<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Eventos
 *
 * @author SISTEMAS
 */
class PuntosEncuentros {

    static function datosPorEncriptados($eventoENCRIPTADO, $puntoEncuentroCODIGO) {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPorEncriptados', ['eventoENCRIPTADO' => $eventoENCRIPTADO, 'puntoEncuentroCODIGO' => $puntoEncuentroCODIGO]);
        return $PuntoEncuentro;
    }

    static function datosPorId($puntoEncuentroID) {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPuntoEncuentroPorId', ['puntoEncuentroID' => $puntoEncuentroID]);
        return $PuntoEncuentro;
    }

    static function datosPorAsistenteUltimoEvento($puntoEncuentroID, $asistenteID, $encuentroID) {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPuntoEncuentroPorAsistenteUltimoEncuentro', ['puntoEncuentroID' => $puntoEncuentroID, 'asistenteID' => $asistenteID, 'encuentroEventoID' => $encuentroID]);
        return $PuntoEncuentro;
    }
    
    static function datosPorCodigoPreguntasRol($puntoEncuentroCODIGO, $rol, $asistenteID) {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPorCodigoPreguntasRol', ['puntoEncuentroCODIGO' => $puntoEncuentroCODIGO, 'rol' => $rol, 'asistenteID' => $asistenteID]);
        return $PuntoEncuentro;
    }
    
    static function cambiarEstado($puntoEncuentroID, $asistenteID = null, $seleccion = null){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $resultado = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'cambiarEstado', ['puntoEncuentroID' => $puntoEncuentroID, 'asistenteID' => $asistenteID,'seleccion' => $seleccion]);
        return $resultado;
    }
    
    static function cambiarEstadoStand($puntoEncuentroID, $asistenteID = null, $seleccion = null, $primeraSeleccion = null){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $resultado = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'cambiarEstadoStand', ['puntoEncuentroID' => $puntoEncuentroID, 'asistenteID' => $asistenteID, 'seleccion' => $seleccion, 'primeraSeleccion' => $primeraSeleccion]);
        return $resultado;
    }
    
    static function terminarEncuentro($encuentroEventoID){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $resultado = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'terminarEncuentro', ['encuentroEventoID' => $encuentroEventoID]);
        return $resultado;
    }
    
    static function encuentroPorCodigoAsistente($encuentroEventoCODIGO, $asistenteID){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $resultado = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'encuentroPorCodigoAsistente', ['encuentroEventoCODIGO' => $encuentroEventoCODIGO, 'asistenteID' => $asistenteID]);
        return $resultado;
    }
    
    static function delEvento($eventoID){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $resultado = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'puntosEncuentroDelEvento', ['eventoID' => $eventoID]);
        return $resultado;
    }

    static function verificarSeleccionRoles($puntoEncuentroID){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosPuntoEncuentroPorId', ['puntoEncuentroID' => $puntoEncuentroID]);
        if($PuntoEncuentro->estadoPuntoEncuentroCODIGO == 'OCUPADO' && !empty($PuntoEncuentro->EncuentroActual->encuentroEventoCOMPRADORID) && !empty($PuntoEncuentro->EncuentroActual->encuentroEventoVENDEDORID)){
            $Respuesta = ['AMBOS_ROLES_SELECCIONADOS' => 'SI'];
        }else{   
            $Respuesta = ['AMBOS_ROLES_SELECCIONADOS' => 'NO'];
        }
        return $Respuesta;
    }
    
    static function validarEncuentroTerminado($encuentroEventoID){
        Global $Api;
        $Encuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'datosEncuentroPorId', ['encuentroEventoID' => $encuentroEventoID]);
        return !empty($Encuentro->encuentroEventoFCHFINAL);
    }
    
    static function detallesPuntoEncuentroTablero($puntoEncuentroID){
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $PuntoEncuentro = $Api->ejecutarPOST('tienda-apps', 'AppRuedasDeNegocios', 'detallesPuntoEncuentroTablero', ['puntoEncuentroID' => $puntoEncuentroID]);
        return $PuntoEncuentro;
    }
}
