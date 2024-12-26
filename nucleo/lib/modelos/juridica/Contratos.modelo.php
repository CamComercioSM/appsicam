<?php

/*
 * Copyright (C) 2022 desarrollo
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Description of Contratos
 *
 * @author desarrollo
 */
class Contratos {
    
    static function datosActaPorCodigo($contratoActaCODIGO) {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $ContratoActa = $Api->ejecutarPOST('tienda-apps', 'APPContratos', 'datosActaPorCodigo', ['contratoActaCODIGO' => $contratoActaCODIGO]);
        return $ContratoActa;
    }

    //put your code here
    static function deSupervisor($supervisorId) {
        Global $Api;
        $Contratos = $Api->ejecutarPOST('tienda-apps', 'APPContratos', 'listadoContratosEnEjecucionDeSupervisor', ['supervisorId' => $supervisorId]);
        return $Contratos;
    }
    
    static function tiposActas() {
        Global $Api;
        $TiposActas = $Api->ejecutarPOST('tienda-apps', 'APPContratos', 'listadoTiposActas');
        return $TiposActas;
    }

    static function todos() {
        Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $contratos = $Api->ejecutarPOST('tienda-apps', 'APPContratos', 'listadoContratosEnejecucion');
//    print_r($contratos);
        return $contratos;
    }

    static function datosParaActaAvance($contratoID) {
        Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $contrato = $Api->ejecutarPOST('tienda-apps', 'APPContratos', 'datosParaActaAvance', ["contratoID" => $contratoID]);
//    print_r($contrato);
        return $contrato;
    }

}
