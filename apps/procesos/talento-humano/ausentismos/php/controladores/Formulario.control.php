<?php

class FormularioControlador extends Controladores {

    function ejemplo() {
        Global $Api;
////        $Api::$MOSTRAR_RESPUESTA_API = true;
//        $Respuesta = $Api->ejecutarRESPUESTAsoloDATOS(
//            'tienda-apps', 'Teinda', 'probarRecibirDatos',$_SESSION
//        );        


        $AusentismosTipos = Ausentismos::listadoTiposAusentismos();
        $Politica = Ausentismos::politicaApp();

        Vistas::renderizar('formulario', ["AusentismosTipos" => $AusentismosTipos, "Politica" => $Politica]);
    }
}