<?php

class SeguridadControlador extends Controladores {

    function estaLogueado() {
        return RespuestasSistema::exito("Datos Correctos", SesionCliente::estaLogueado());
    }

    function iniciarSesionColaborador() {
        Global $Api;
//        $Api::$MOSTRAR_RESPUESTA_API = true;
        //print_r($this);
        $Respuesta = $Api->ejecutarPOST(
            'tienda-apps', 'seguridad', 'iniciarSesionColaboradorDesdeTiendaSICAM',
            ["usuario" => $this->colaboradorUSUARIO, "password" => $this->colaboradorPASSWORD,]
        );
        if ($Respuesta) {
            if (isset($Respuesta->usuarioNOMBRE)) {
                SesionCliente::abrirSesion($Respuesta);
                return RespuestasSistema::exito("Datos Correctos", $Respuesta);
            } else {
                return RespuestasSistema::fallo("Datos ERRADOS del Usuario/Colaborador.<br/>" . $Respuesta);
            }
        } else {
            return RespuestasSistema::error("No huba respuesta desde el servidor.<br/>" . json_decode($Respuesta));
        }
    }

    function cerrarSesionColaborador() {
        SesionCliente::cerrarSesion();
        return RespuestasSistema::exito("Cerrada la Sesión del Usuario", $_SESSION);
    }

    function datosSesionColaborador() {
        Global $Api;
        $Usuario = new stdClass();
        $Usuario->TiendaSICAM = $_SESSION;
        $Usuario->ApiSICAM = $Respuesta = $Api->ejecutarPOST(
            'tienda-apps', 'seguridad', 'datosSesionAbierta',
            []
        );
        return RespuestasSistema::exito("Datos en la Sesión del Usuario", $Usuario);
    }

}