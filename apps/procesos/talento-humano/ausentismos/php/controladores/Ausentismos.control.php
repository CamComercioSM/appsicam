<?php

class AusentismosControlador extends Controladores {

    public $rutaArchivo = "";

    function cargarCancelar() {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'mostrarCancelar', ["ausenciaColaboradorID" => $this->ausenciaColaboradorID]
        );
        echo $Encontrado->DATOS[0];
    }
    
    function cargarCerrar() {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'mostrarCerrar', ["ausenciaColaboradorID" => $this->ausenciaColaboradorID]
        );
        echo json_encode($Encontrado);
    }
    
    function cargarAutorizar() {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'mostrarAutorizar', ["ausenciaColaboradorID" => $this->ausenciaColaboradorID]
        );
        echo json_encode($Encontrado);
    }
    
    function cargarIniciar() {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'mostrarIniciar', ["ausenciaColaboradorID" => $this->ausenciaColaboradorID]
        );
        echo json_encode($Encontrado);
    }
    
    function cargarFormulario() {
        Global $Api;
        //$Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutar(
                'tienda-apps', 'AppAusentismos', 'mostrarFormulario'
        );
        echo json_encode($Encontrado);
    }

    function consultarDatosColaborador() {
        Global $Api;
//    $Api::$MOSTRAR_RESPUESTA_API = true;
        $Encontrado = $Api->ejecutarPOST(
                'tienda-apps', 'AppAusentismos', 'consultarDatosColaborador', ["colaboradorIDENTIFICACION" => $this->colaboradorIDENTIFICACION,]
        );
        $Colaborador = null;
        if ($Encontrado->Colaborador) {
            // Solo se pasan los datos necesarios por seguridad
            $Colaborador = new stdClass();
            $Colaborador->colaboradorNOMBRECOMPLETO = $Encontrado->Colaborador->colaboradorNOMBRECOMPLETO;
            $Colaborador->colaboradorJEFEINMEDIATO = $Encontrado->Colaborador->jefeInmediatoNOMBRES . " " . $Encontrado->Colaborador->jefeInmediatoAPELLIDOS;
            $Colaborador->colaboradorID = $Encontrado->Colaborador->colaboradorID;

            echo RespuestasSistema::exito($Colaborador);
        } else {
            echo RespuestasSistema::alerta('No existe un colaborador con esa identificación.');
        }
    }

    private function validarVacios() {
        $ObjSolicitud = new stdClass();
        $ObjSolicitud->colaboradorID = empty($this->colaboradorID) ? NULL : $this->colaboradorID;
        $ObjSolicitud->fechaInicio = empty($this->fechaInicio) ? NULL : $this->fechaInicio;
        $ObjSolicitud->fechaFin = empty($this->fechaFin) ? NULL : $this->fechaFin;
        $ObjSolicitud->motivo = empty($this->motivo) ? NULL : $this->motivo;
        $ObjSolicitud->descripcion = empty($this->descripcion) ? NULL : $this->descripcion;
        $ObjSolicitud->soporte = empty($this->soporte) ? NULL : $this->guardarArchivo($this->soporte);
        return $ObjSolicitud;
    }

    private function guardarArchivo($archivo) {
        Global $Config;
        $NombreArchivo = uniqid() . '.' . Archivos::extension($archivo);
        Archivos::moverArchivoRecibido($archivo, 'tmp/', $NombreArchivo);
        $this->rutaArchivo = $Config->APP_DIR . 'tmp' . DS . $NombreArchivo;
        return $Config->APP_URL . 'tmp' . DS . $NombreArchivo;
    }

    function registrarSolicitud() {
        $DatosSolicitud = $this->validarVacios();
        $solicitudRegistrada = Ausentismos::registrarSolicitud(
                        $DatosSolicitud->colaboradorID, $DatosSolicitud->fechaInicio, $DatosSolicitud->fechaFin, $DatosSolicitud->motivo, $DatosSolicitud->descripcion, $DatosSolicitud->soporte, $this->tipoSolicitud
        );
        if ($solicitudRegistrada->RESPUESTA == "EXITO") {
            Archivos::borrar($this->rutaArchivo);
            echo RespuestasSistema::exito($solicitudRegistrada->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($solicitudRegistrada->MENSAJE);
        }
    }

    function autorizarSolicitud() {
        $autorizado = Ausentismos::autorizarSolicitud($this->ausenciaColaboradorID);
        if ($autorizado->RESPUESTA == "EXITO") {
            echo RespuestasSistema::exito($autorizado->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($autorizado->MENSAJE);
        }
    }

    function rechazarSolicitud() {
        $autorizado = Ausentismos::rechazarSolicitud($this->ausenciaColaboradorID);
        if ($autorizado->RESPUESTA == "EXITO") {
            echo RespuestasSistema::exito($autorizado->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($autorizado->MENSAJE);
        }
    }

    function cancelarSolicitud() {
        $autorizado = Ausentismos::cancelarSolicitud($this->ausenciaColaboradorID, $this->motivoNoUso);
        if ($autorizado->RESPUESTA == "EXITO") {
            echo RespuestasSistema::exito($autorizado->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($autorizado->MENSAJE);
        }
    }

    function cerrarPermiso() {
        $autorizado = Ausentismos::cerrarPermiso($this->ausenciaColaboradorID);
        if ($autorizado->RESPUESTA == "EXITO") {
            echo RespuestasSistema::exito($autorizado->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($autorizado->MENSAJE);
        }
    }

    function iniciarPermiso() {
        $autorizado = Ausentismos::iniciarPermiso($this->ausenciaColaboradorID);
        if ($autorizado->RESPUESTA == "EXITO") {
            echo RespuestasSistema::exito($autorizado->MENSAJE);
        } else {
            echo RespuestasSistema::informacion($autorizado->MENSAJE);
        }
    }

}
