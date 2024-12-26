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
class EleccionesJunta {
  
  static function totalesConteoVotosCandidatosEleccion($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'totalesConteoVotosCandidatosEleccion',
        ['eleccionJuntaID' => $eleccionJuntaID,]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function datosConteoVotosEleccion($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'datosConteoVotosEleccion',
        ['eleccionJuntaID' => $eleccionJuntaID,]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function datosConteoVotosMesa($eleccionJuntaID, $mesaVotacionID, $juradoVotacionID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'datosConteoVotosMesa',
        ['eleccionJuntaID' => $eleccionJuntaID, "mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID,]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function conteoMesaRealizado($eleccionJuntaID, $mesaVotacionID, $juradoVotacionID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'conteoMesaRealizado',
        ['eleccionJuntaID' => $eleccionJuntaID, "mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID,]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function registrarConteoVotos($eleccionID, $mesaVotacionID, $juradoVotacionID, $votosJUNTA, $votosREVISOR) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutar('tienda-apps', 'APPEleccionesJunta', 'registrarConteoVotos', [
        "mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID, "eleccionJuntaID" => $eleccionID,
        "votosJUNTA" => $votosJUNTA, "votosREVISOR" => $votosREVISOR
    ]);
//    print_r($contratos);
    return $contratos;
  }

  static function contadorVotantesMesa($eleccionJuntaID, $mesaVotacionID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'contadorVotantesMesa',
        ['eleccionJuntaID' => $eleccionJuntaID, "mesaVotacionID" => $mesaVotacionID,]
    );
//    print_r($contratos);
    return $contratos;
  }

  //put your code here
  static function candidatosRevisorFiscal($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'candidatosRevisorFiscal',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function candidatosJuntaDirectiva($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'candidatosJuntaDirectiva',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function registrarAsistenciaVotanteJUNTA($mesaVotacionID, $juradoVotacionID, $censoID, $censoREPRESENTAIDENTIFICACION = null, $censoREPRESENTANOMBRE = null) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutar('tienda-apps', 'APPEleccionesJunta', 'registrarAsistenciaVotanteJUNTA',
        ["mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID, "censoID" => $censoID, "censoREPRESENTAIDENTIFICACION" => $censoREPRESENTAIDENTIFICACION, "censoREPRESENTANOMBRE" => $censoREPRESENTANOMBRE]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function registrarAsistenciaVotanteREVISOR($mesaVotacionID, $juradoVotacionID, $censoID, $censoREPRESENTAIDENTIFICACION = null, $censoREPRESENTANOMBRE = null) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutar('tienda-apps', 'APPEleccionesJunta', 'registrarAsistenciaVotanteREVISOR',
        ["mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID, "censoID" => $censoID, "censoREPRESENTAIDENTIFICACION" => $censoREPRESENTAIDENTIFICACION, "censoREPRESENTANOMBRE" => $censoREPRESENTANOMBRE]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function registrarAsistenciaVotante($mesaVotacionID, $juradoVotacionID, $censoID, $censoREPRESENTAIDENTIFICACION = null, $censoREPRESENTANOMBRE = null) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutar('tienda-apps', 'APPEleccionesJunta', 'registrarAsistenciaVotante',
        ["mesaVotacionID" => $mesaVotacionID, "juradoVotacionID" => $juradoVotacionID, "censoID" => $censoID, "censoREPRESENTAIDENTIFICACION" => $censoREPRESENTAIDENTIFICACION, "censoREPRESENTANOMBRE" => $censoREPRESENTANOMBRE]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function consultarExpedienteMercantil($censoID, $identificacion) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'consultarExpedienteMercantil',
        ['identificacion' => $identificacion, "censoID" => $censoID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function mesasVotacionConJurados($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'mesasVotacionConJurados',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function validarDatosLoginJurado($mesaVotacionID, $mesaCLAVE, $juradoCEDULA, $juradoCLAVE, $eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutar('tienda-apps', 'APPEleccionesJunta', 'validarDatosLoginJurado', [
        'mesaVotacionID' => $mesaVotacionID, 'mesaVotacionCLAVE' => $mesaCLAVE,
        'juradoVotacionIDENTIFICACION' => $juradoCEDULA, 'juradoVotacionCLAVE' => $juradoCLAVE,
        'eleccionJuntaID' => $eleccionJuntaID
    ]);
//    print_r($contratos);
    return $contratos;
  }

  static function jurados($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'juradosPorEleccion',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function sedesVotacion($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'sedesVotacion',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function mesasVotacion($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'mesasVotacion',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function censo($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'censoElectoral',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function censoConControlVotacion($eleccionJuntaID) {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'censoElectoralControlVotacion',
        ['eleccionJuntaID' => $eleccionJuntaID]
    );
//    print_r($contratos);
    return $contratos;
  }

  static function todos() {
    Global $Api;
//    $Api = new ApiSICAM();
//    $Api::$MOSTRAR_RESPUESTA_API = true;
    $contratos = $Api->ejecutarRESPUESTAsoloDATOS('tienda-apps', 'APPEleccionesJunta', 'listadoContratosEnejecucion');
//    print_r($contratos);
    return $contratos;
  }

}
