<?php

/**
 * Description of Respuestas
 *
 * @Autor: Ing. Juan Pablo Llinás Ramírez 
 * @Email: jpllinas@ccsm.org.co 
 */
class RespuestasSistema {
    //put your code here
    const EXITO = 'EXITO';
    const INFO = 'INFO';
    const FALLO = 'FALLO';
    const ALERTA = 'ALERTA';
    const ERROR = 'ERROR';

    public static function enJSON($respuesta, $mensaje, $datos = null, $error = null) {
        header('Content-Type: application/json; charset=utf-8');
        echo self::respuesta($respuesta, $mensaje, $datos, $error);
    }

    public static function responseJson($respuesta, $mensaje, $datos = null) {
        echo self::respuesta($respuesta, $mensaje, $datos);
    }

    public static function respuesta($respuesta, $mensaje, $datos = null, $error = null) {
        if (!empty(SesionCliente::valor('ERROR'))) {
            $error .= "<strong>datos técnicos de soporte</strong><br /><em><small>" . SesionCliente::valor('ERROR_BD') . "</small></em>";
            SesionCliente::valor('ERROR', '');
        }
        if (!empty($mensaje)) {
            $mensaje = "<em>" . $mensaje . "</em>";
        }

        $arrayRespuesta = array(
          'RESPUESTA' => $respuesta,
          'MENSAJE' => $mensaje,
          'DATOS' => $datos,
          'ERROR' => $error
        );
        $jsonRespuesta = json_encode($arrayRespuesta);
        return $jsonRespuesta;
    }

    static public function exito($mensaje = null, $datos = null) {
        if (is_array($mensaje)) {
            $datos = $mensaje;
            $mensaje = "";
        }
        if (is_object($mensaje)) {
            $array = (array) $mensaje;
            $mensaje = "";
            $datos = $array;
        }
        return self::respuesta(self::EXITO, $mensaje, $datos);
    }

    static public function alerta($mensaje, $datos = null) {
        return self::respuesta(self::ALERTA, $mensaje, $datos);
    }

    static public function fallo($mensaje, $datos = null) {
        return self::respuesta(self::FALLO, $mensaje, $datos);
    }

    static public function error($mensaje, $codigo = null, $datos = null) {
        return self::respuesta(self::ERROR, $mensaje, $datos, $codigo);
    }

    static public function informacion($mensaje, $datos = null) {
        return self::respuesta(self::INFO, $mensaje, $datos);
    }

    public static function getRespuesta() {
        return self::$respuesta;
    }

    public static function getMensajeRespuesta() {
        return self::$mensaje;
    }
}