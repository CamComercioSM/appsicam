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
class Eventos {

    static function verificarSiAsistenteLogueadoEstaConfirmado($ListadoEventosConfirmado, $Evento) {
        $Inscrito = array_filter($ListadoEventosConfirmado, function ($Inscripcion) use ($Evento) {
            return $Inscripcion->eventoID == $Evento->eventoID;
        });
        if (count($Inscrito)) {
            return current($Inscrito);
        }
        return null;
    }

//put your code here


    static function guardarInscripcion($eventoID, $tipoIdentificacionID, $personaIDENTIFICACION, $personaPRIMERNOMBRE, $personaSEGUNDONOMBRE, $personaPRIMERAPELLIDO, $personaSEGUNDOAPELLIDO, $telefonoNUMEROCELULAR, $correoDIRECCION, $direccionNOMENCLATURADOMICILIO, $municipioID, $ocupacionID, $tipoClienteID, $empresaNIT, $empresaRAZONSOCIAL, $empresaCORREO, $mercadeoCOMOTEENTERASTE) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'guardar',
                [
                    "eventoID" => $eventoID,
                    "tipoIdentificacionID" => $tipoIdentificacionID,
                    "personaIDENTIFICACION" => $personaIDENTIFICACION,
                    "personaPRIMERNOMBRE" => $personaPRIMERNOMBRE,
                    "personaSEGUNDONOMBRE" => $personaSEGUNDONOMBRE,
                    "personaPRIMERAPELLIDO" => $personaPRIMERAPELLIDO,
                    "personaSEGUNDOAPELLIDO" => $personaSEGUNDOAPELLIDO,
                    "telefonoNUMEROCELULAR" => $telefonoNUMEROCELULAR,
                    "correoDIRECCION" => $correoDIRECCION,
                    "direccionNOMENCLATURADOMICILIO" => $direccionNOMENCLATURADOMICILIO,
                    "municipioID" => $municipioID,
                    "ocupacionID" => $ocupacionID,
                    "tipoClienteID" => $tipoClienteID,
                    "empresaNIT" => $empresaNIT,
                    "empresaRAZONSOCIAL" => $empresaRAZONSOCIAL,
                    "empresaCORREO" => $empresaCORREO,
                    "eventoComoTeEnterasteID" => $mercadeoCOMOTEENTERASTE,
                ]
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function guardarInscripcionNuevo(
            $eventoID, $tipoIdentificacionID, $personaIDENTIFICACION,
            $personaPRIMERNOMBRE, $personaSEGUNDONOMBRE, $personaPRIMERAPELLIDO,
            $personaSEGUNDOAPELLIDO, $telefonoNUMEROCELULAR, $correoDIRECCION,
            $direccionNOMENCLATURADOMICILIO, $municipioID, $ocupacionID, $tipoClienteID,
            $empresaNIT, $empresaRAZONSOCIAL, $empresaCORREO, $mercadeoCOMOTEENTERASTE,
            $personaSEXO, $personaFCHNACIMIENTO,
            $grupoEtnicoID, $condicionEspecialID, $nivelEducativoID,
            $personaCARGOEMPRESA) {
        Global $Api;
//   $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'guardarNuevo',
                [
                    "eventoID" => $eventoID,
                    "tipoIdentificacionID" => $tipoIdentificacionID,
                    "personaIDENTIFICACION" => $personaIDENTIFICACION,
                    "personaPRIMERNOMBRE" => $personaPRIMERNOMBRE,
                    "personaSEGUNDONOMBRE" => $personaSEGUNDONOMBRE,
                    "personaPRIMERAPELLIDO" => $personaPRIMERAPELLIDO,
                    "personaSEGUNDOAPELLIDO" => $personaSEGUNDOAPELLIDO,
                    "personaTELEFONOCELULAR" => $telefonoNUMEROCELULAR,
                    "personaCORREOELECTRONICO" => $correoDIRECCION,
                    "personaDIRECCIONDOMICILIO" => $direccionNOMENCLATURADOMICILIO,
                    "municipioDOMICILIOID" => $municipioID,
                    "personaOCUPACION" => $ocupacionID,
                    "eventoAsistenteTIPOCLIENTE" => $tipoClienteID,
                    "eventoAsistenteEMPRESANIT" => $empresaNIT,
                    "eventoAsistenteEMPRESANOMBRE" => $empresaRAZONSOCIAL,
                    "eventoAsistenteEMPRESACORREO" => $empresaCORREO,
                    "eventoComoTeEnterasteID" => $mercadeoCOMOTEENTERASTE,
                    "personaSEXO" => $personaSEXO,
                    "personaFCHNACIMIENTO" => $personaFCHNACIMIENTO,
                    "grupoEtnicoID" => $grupoEtnicoID,
                    "condicionEspecialID" => $condicionEspecialID,
                    "nivelEducativoID" => $nivelEducativoID,
                    "eventoAsistenteCARGOEMPRESA" => $personaCARGOEMPRESA,
                ]
        );

//    print_r($Respuesta);
        return $Respuesta;
    }

    static function guardarInscripcionNuevoPruebas(
            $eventoID, $tipoIdentificacionID, $personaIDENTIFICACION,
            $personaPRIMERNOMBRE, $personaSEGUNDONOMBRE, $personaPRIMERAPELLIDO,
            $personaSEGUNDOAPELLIDO, $telefonoNUMEROCELULAR, $correoDIRECCION,
            $direccionNOMENCLATURADOMICILIO, $municipioID, $ocupacionID, $tipoClienteID,
            $empresaNIT, $empresaRAZONSOCIAL, $empresaCORREO, $mercadeoCOMOTEENTERASTE,
            $personaSEXO, $personaFCHNACIMIENTO,
            $grupoEtnicoID, $condicionEspecialID, $nivelEducativoID,
            $personaCARGOEMPRESA) {
        Global $Api;
//   $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'guardarNuevoPruebas',
                [
                    "eventoID" => $eventoID,
                    "tipoIdentificacionID" => $tipoIdentificacionID,
                    "personaIDENTIFICACION" => $personaIDENTIFICACION,
                    "personaPRIMERNOMBRE" => $personaPRIMERNOMBRE,
                    "personaSEGUNDONOMBRE" => $personaSEGUNDONOMBRE,
                    "personaPRIMERAPELLIDO" => $personaPRIMERAPELLIDO,
                    "personaSEGUNDOAPELLIDO" => $personaSEGUNDOAPELLIDO,
                    "personaTELEFONOCELULAR" => $telefonoNUMEROCELULAR,
                    "personaCORREOELECTRONICO" => $correoDIRECCION,
                    "personaDIRECCIONDOMICILIO" => $direccionNOMENCLATURADOMICILIO,
                    "municipioDOMICILIOID" => $municipioID,
                    "personaOCUPACION" => $ocupacionID,
                    "eventoAsistenteTIPOCLIENTE" => $tipoClienteID,
                    "eventoAsistenteEMPRESANIT" => $empresaNIT,
                    "eventoAsistenteEMPRESANOMBRE" => $empresaRAZONSOCIAL,
                    "eventoAsistenteEMPRESACORREO" => $empresaCORREO,
                    "eventoComoTeEnterasteID" => $mercadeoCOMOTEENTERASTE,
                    "personaSEXO" => $personaSEXO,
                    "personaFCHNACIMIENTO" => $personaFCHNACIMIENTO,
                    "grupoEtnicoID" => $grupoEtnicoID,
                    "condicionEspecialID" => $condicionEspecialID,
                    "nivelEducativoID" => $nivelEducativoID,
                    "eventoAsistenteCARGOEMPRESA" => $personaCARGOEMPRESA,
                ]
        );

//    print_r($Respuesta);
        return $Respuesta;
    }

    static function datosLandingPage($eventoCODIGOURL) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'datosCompletosEvento', ["eventoCODIGO" => $eventoCODIGOURL]
        );

        $Respuesta->TiposPatrocinadores = [];

        if (isset($Respuesta->Patrocinadores)) {
            foreach ($Respuesta->Patrocinadores as $Patrocinador) {

                // Verificar si ya existe un elemento con ese tipoID
                $existe = false;
                foreach ($Respuesta->TiposPatrocinadores as $tipo) {
                    if ($tipo['tipoID'] === $Patrocinador->tipoPatrocinadorID) {
                        $existe = true;
                        break;
                    }
                }

                // Si no existe, añadimos el nuevo tipo
                if (!$existe) {
                    $tipo = [
                        "tipoID" => $Patrocinador->tipoPatrocinadorID,
                        "tipoNOMBRE" => $Patrocinador->tipoPatrocinadorTITULO
                    ];
                    array_push($Respuesta->TiposPatrocinadores, $tipo);
                }
            }
        }

//    print_r($Respuesta);
        return $Respuesta;
    }

    static function datosLandingPageEncriptado($eventoENCRIPTADOURL) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'datosCompletosEventoEncriptado', ["eventoENCRIPTADO" => $eventoENCRIPTADOURL]
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function datosLandingPageEncriptadoGrupo($eventoENCRIPTADOGRUPOURL) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'datosCompletosEventoEncriptadoGrupo', ["eventoENCRIPTADOGRUPO" => $eventoENCRIPTADOGRUPOURL]
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoMunicipios() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoMunicipios'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoMunicipios2() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoMunicipios2'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoTiposIdentificacionPersonas() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoTiposIdentificacionPersonas'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoTiposClientes() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoTiposClientes'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoComoTeEnteraste() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoComoTeEnteraste'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoOcupaciones() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoOcupaciones'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoGruposEtnicos() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoGruposEtnicos'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoNivelesEducativos() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoNivelesEducativos'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoCondicionesEspeciales() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoCondicionesEspeciales'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoEventosPasados() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoEventosPasados'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoEventosProximos() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoEventosProximos'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoEventosActuales() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoEventosActuales'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoEventosConsulta() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppEventosCapacitaciones', 'listadoEventosConsulta'
        );
//    print_r($Respuesta);
        return $Respuesta;
    }

    static function listadoProximasRuedasDeNegocios() {
        Global $Api;
//$Api::$MOSTRAR_RESPUESTA_API = true;
        $Respuesta = $Api->ejecutarPOST(
                'tienda-apps', 'AppRuedasDeNegocios', 'listadoProximasRuedasDeNegocios'
        );
        return $Respuesta;
    }

    static function guardarInscripcionTraerEncuesta(
            $eventoID, $tipoIdentificacionID, $personaIDENTIFICACION,
            $personaPRIMERNOMBRE, $personaSEGUNDONOMBRE, $personaPRIMERAPELLIDO,
            $personaSEGUNDOAPELLIDO, $telefonoNUMEROCELULAR, $correoDIRECCION,
            $direccionNOMENCLATURADOMICILIO, $municipioID, $ocupacionID, $tipoClienteID,
            $empresaNIT, $empresaRAZONSOCIAL, $empresaCORREO, $mercadeoCOMOTEENTERASTE,
            $personaSEXO, $personaFCHNACIMIENTO,
            $grupoEtnicoID, $condicionEspecialID, $nivelEducativoID,
            $personaCARGOEMPRESA) {
        Global $Api;
//   $Api::$MOSTRAR_RESPUESTA_API = true;
//   $Api::$MODO_PRUEBAS = true;
        $Respuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'guardarInscripcionTraerEncuesta',
                [
                    "eventoID" => $eventoID,
                    "tipoIdentificacionID" => $tipoIdentificacionID,
                    "personaIDENTIFICACION" => $personaIDENTIFICACION,
                    "personaPRIMERNOMBRE" => $personaPRIMERNOMBRE,
                    "personaSEGUNDONOMBRE" => $personaSEGUNDONOMBRE,
                    "personaPRIMERAPELLIDO" => $personaPRIMERAPELLIDO,
                    "personaSEGUNDOAPELLIDO" => $personaSEGUNDOAPELLIDO,
                    "personaTELEFONOCELULAR" => $telefonoNUMEROCELULAR,
                    "personaCORREOELECTRONICO" => $correoDIRECCION,
                    "personaDIRECCIONDOMICILIO" => $direccionNOMENCLATURADOMICILIO,
                    "municipioDOMICILIOID" => $municipioID,
                    "personaOCUPACION" => $ocupacionID,
                    "eventoAsistenteTIPOCLIENTE" => $tipoClienteID,
                    "eventoAsistenteEMPRESANIT" => $empresaNIT,
                    "eventoAsistenteEMPRESANOMBRE" => $empresaRAZONSOCIAL,
                    "eventoAsistenteEMPRESACORREO" => $empresaCORREO,
                    "eventoComoTeEnterasteID" => $mercadeoCOMOTEENTERASTE,
                    "personaSEXO" => $personaSEXO,
                    "personaFCHNACIMIENTO" => $personaFCHNACIMIENTO,
                    "grupoEtnicoID" => $grupoEtnicoID,
                    "condicionEspecialID" => $condicionEspecialID,
                    "nivelEducativoID" => $nivelEducativoID,
                    "eventoAsistenteCARGOEMPRESA" => $personaCARGOEMPRESA,
                ]
        );

//print_r($Respuesta);
        return $Respuesta;
    }

    static function traerEncuesta($eventoAsistenteHASH) {
        Global $Api;
//$Api::$MOSTRAR_RESPUESTA_API = true;
//    $Api::$MODO_PRUEBAS = true;
        $Encuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'encuestaDeEvento', ["eventoAsistenteHASH" => $eventoAsistenteHASH]
        );
        return $Encuesta;
    }

    static function guardarRespuestasEncuesta($eventoAsistenteID, $Respuestas) {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Encuesta = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'guardarRespuestasAsistenteEncuesta', ['eventoAsistenteID' => $eventoAsistenteID, 'Respuestas' => $Respuestas]
        );
//        print_r($Encuesta);
        return $Encuesta;
    }

    static function datosCompletosPorCodigo($eventoCODIGO) {
        Global $Api;
//$Api::$MOSTRAR_RESPUESTA_API = true;
        $Evento = $Api->ejecutar(
                'tienda-apps', 'AppEventosCapacitaciones', 'datosCompletosEvento', ['eventoCODIGO' => $eventoCODIGO]
        );
//        print_r($Encuesta);
        return $Evento->DATOS;
    }

    static function datosEventoPorEncriptado($eventoENCRIPTADO) {
        Global $Api;
//$Api::$MOSTRAR_RESPUESTA_API = true;
        $Evento = $Api->ejecutarPOST(
                'tienda-apps', 'AppRuedasDeNegocios', 'datosEventoPorEncriptado', ['eventoENCRIPTADO' => $eventoENCRIPTADO]
        );
        return $Evento;
    }

    static function datosEventoPuntosEncuentroPorEncriptado($eventoENCRIPTADO) {
        Global $Api;
//$Api::$MOSTRAR_RESPUESTA_API = true;
        $Evento = $Api->ejecutarPOST(
                'tienda-apps', 'AppRuedasDeNegocios', 'datosEventoPuntosEncuentroPorEncriptado', ['eventoENCRIPTADO' => $eventoENCRIPTADO]
        );
        return $Evento;
    }
}
