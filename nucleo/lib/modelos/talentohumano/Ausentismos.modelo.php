<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ausentismos {
    
    
    static function datos($ausenciaColaboradorID) {
        Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppAusentismos', 'datos', [ "ausenciaColaboradorID" => $ausenciaColaboradorID]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }

    
    static function listadoTiposAusentismos() {
        Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppAusentismos', 'listadoTiposAusentismos'
        );
//        print_r($Respuesta);
        return $Respuesta;
    }

    static function politicaApp() {
        Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppAusentismos', 'politicaApp'
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function registrarSolicitud(
        $colaboradorID, $fechaInicio,
        $fechaFin, $motivo, $descripcion, 
        $soporte, $tipoSolicitud
    )
    {
         Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'registrarSolicitud',
                [
                    'colaboradorID' => $colaboradorID,
                    'ausenciaColaboradorCODIGO' => uniqid(),
                    'tipoAusentismoID' => $motivo,
                    'ausenciaColaboradorFCHINICIO' => $fechaInicio,
                    'ausenciaColaboradorFCHFINAL' => $fechaFin,
                    'ausenciaColaboradorENLACE' => $soporte,
                    'ausenciaColaboradorDESCRIPCION' => $descripcion,
                    'tipoSolicitud' => $tipoSolicitud
                ]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function autorizarSolicitud($ausenciaColaboradorID)
    {
         Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'autorizarSolicitud',
                [
                    'ausenciaColaboradorID' => $ausenciaColaboradorID,
                ]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function rechazarSolicitud($ausenciaColaboradorID)
    {
         Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'rechazarSolicitudNuevo',
                [
                    'ausenciaColaboradorID' => $ausenciaColaboradorID,
                ]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function cancelarSolicitud($ausenciaColaboradorID, $motivoNoUso)
    {
         Global $Api;
         Global $Config;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'cancelarSolicitudNuevo',
                [
                    'ausenciaColaboradorID' => $ausenciaColaboradorID,
                    'motivoNoUso' => $motivoNoUso
                ]
        );
        $Config->Ausentismo = self::datos($ausenciaColaboradorID);
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function cerrarPermiso($ausenciaColaboradorID)
    {
         Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'cerrarPermiso',
                [
                    'ausenciaColaboradorID' => $ausenciaColaboradorID
                ]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
    
    static function iniciarPermiso($ausenciaColaboradorID)
    {
         Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'iniciarPermiso',
                [
                    'ausenciaColaboradorID' => $ausenciaColaboradorID
                ]
        );
//        print_r($Respuesta);
        return $Respuesta;
    }
}
