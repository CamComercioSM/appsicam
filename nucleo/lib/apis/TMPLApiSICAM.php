<?php


class __ApiSICAM {
    public static $MODO_PRUEBAS = false;
    public static $MOSTRAR_RESPUESTA_API = false;
    static $URL = "https://api.sicam32.net/";
    static $URL_SICAM = "https://si.sicam32.net/";
    static $USERNAME = "SKuip064CBoyqfEZV1LtQf0SQf9L2h6aijY15+x5HIvLD6qSODQSsJdPq5EQzkQd";
    static $PASSWORD = "6AfpZApDsYmXwQEdopwlV3G5ZQ3fd4rX8ymAPmXHiic=";
    private $conexionApi = null;
    private static $instancia;
    private $JSONRespuesta = null;
    private $estadoConexion = false;
    private $resultado;

    public static function ObjetoAPI($usuario = null, $clave = null) {
        if (!is_null($usuario)) {
            self::$USERNAME = $usuario;
        }
        if (!is_null($clave)) {
            self::$PASSWORD = $clave;
        }
        if (!isset(self::$instancia)) {
            $obj = __CLASS__;
            self::$instancia = new $obj;
        } return self::$instancia;
    }

    public function __construct() {
        
    }

    private function __clone() {
        throw new Exception("Este objeto no se puede clonar");
    }

    public function ejecutarPOST($componente, $controlador, $operacion, array $parametros = null) {
        return $this->ejecutarRESPUESTAsoloDATOS($componente, $controlador, $operacion, $parametros, "POST");
    }

    public function ejecutarGET($componente, $controlador, $operacion, array $parametros = null) {
        return $this->ejecutarRESPUESTAsoloDATOS($componente, $controlador, $operacion, $parametros, "GET");
    }

    public function ejecutarRESPUESTAsoloDATOS($componente, $controlador, $operacion, array $parametros = null, $metodo = "POST", $formato = "DATOS") {
        $JSONRespuesta = null;
        $estadoConexion = false;
        $this->conexionApi = curl_init();
        curl_setopt($this->conexionApi, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->conexionApi, CURLOPT_USERPWD, self::$USERNAME . ":" . self::$PASSWORD);
        curl_setopt($this->conexionApi, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->conexionApi, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->conexionApi, CURLOPT_RETURNTRANSFER, true);
        $urlCompleta = self::$URL . $componente . "/" . $controlador . "/" . $operacion;
        if (!is_null($parametros)) {
            if (self::$MODO_PRUEBAS) {
                $parametros['modo'] = "PRUEBAS";
            }
            $data_string = json_encode($parametros);
            curl_setopt($this->conexionApi, CURLOPT_CUSTOMREQUEST, $metodo);
            curl_setopt($this->conexionApi, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($this->conexionApi, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: application/json", "Content-Length: " . strlen($data_string)));
        }
        curl_setopt($this->conexionApi, CURLOPT_URL, $urlCompleta);
        $resultado = curl_exec($this->conexionApi);
        ApiSICAM::mostrar_resultado_para_depuracion($resultado, 'respuesta del servidor');
        $respuesta = json_decode($resultado);
        ApiSICAM::mostrar_resultado_para_depuracion($respuesta, 'DESPUIES DE TRANSFORMAR');
        if (json_last_error() === JSON_ERROR_NONE) {
            if (!session_status() == PHP_SESSION_ACTIVE) {
                session_start();
            }
            $estadoConexion = $_SESSION["API_CONEXION"] = true;
            if ($respuesta->RESPUESTA == "EXITO") {
                $JSONRespuesta = $respuesta->DATOS;
            } else {
                $JSONRespuesta = $respuesta->MENSAJE;
                ApiSICAM::mostrar_resultado_para_depuracion(curl_getinfo($this->conexionApi), 'Configuracion de la conexion');
            }
        } else {
            $JSONRespuesta = "Error en el formato o contenido de la respuesta: " . json_last_error_msg();
            ApiSICAM::mostrar_resultado_para_depuracion(curl_getinfo($this->conexionApi), 'Configuracion de la conexion');
        }
        $this->desconectar();
        return $JSONRespuesta;
    }

    public function ejecutar($componente, $controlador, $operacion, array $parametros = null, $metodo = "POST", $formato = "JSON") {
        $JSONRespuesta = $this->formatearRespuesta(
            $this->solicitarDatos(
                $this->conectar($componente, $controlador, $operacion),
                $parametros, $metodo
            ),
            $formato
        );
        $this->desconectar();
        return $JSONRespuesta;
    }

    function conectar($componente, $controlador, $operacion) {
        $this->conexionApi = curl_init();
        curl_setopt($this->conexionApi, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->conexionApi, CURLOPT_USERPWD, self::$USERNAME . ":" . self::$PASSWORD);
        curl_setopt($this->conexionApi, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->conexionApi, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->conexionApi, CURLOPT_RETURNTRANSFER, true);
        return $urlCompleta = self::$URL . $componente . "/" . $controlador . "/" . $operacion;
    }

    function solicitarDatos($urlCompleta, $parametros, $metodo) {
        if (!is_null($parametros)) {
            $data_string = json_encode($parametros);
            curl_setopt($this->conexionApi, CURLOPT_CUSTOMREQUEST, $metodo);
            curl_setopt($this->conexionApi, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($this->conexionApi, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: application/json", "Content-Length: " . strlen($data_string)));
            ApiSICAM::mostrar_resultado_para_depuracion([$urlCompleta, $parametros, $metodo], 'conformado el paquete de datos');
        }
        curl_setopt($this->conexionApi, CURLOPT_URL, $urlCompleta);
        return $this->resultado = curl_exec($this->conexionApi);
    }

    function formatearRespuesta($resultado, $formato = "JSON") {
        $respuesta = json_decode($resultado);
        ApiSICAM::mostrar_resultado_para_depuracion([curl_getinfo($this->conexionApi), $resultado, $respuesta], 'respondiendo por formaterRespuesta');
        if (json_last_error() === JSON_ERROR_NONE) {
            if (!session_status() == PHP_SESSION_ACTIVE) {
                session_start();
            }
            $this->estadoConexion = $_SESSION["API_CONEXION"] = true;
            session_write_close();
            $this->info = curl_getinfo($this->conexionApi);

            switch ($formato) {
                case "JSON":
                    return $this->JSONRespuesta = $resultado;
                    break;
                case "COMPLETA":
                    return $this->JSONRespuesta = $respuesta;
                    break;
                case "DATOS":
                default:
                    if ($respuesta->RESPUESTA == "EXITO") {
                        return $this->JSONRespuesta = $respuesta->DATOS;
                    } else {
                        return $this->JSONRespuesta = $respuesta->MENSAJE;
                    }
                    break;
            }
        } else {
            $Error = new stdClass();
            $Error->RESPUESTA = "ERROR";
            $Error->MENSAJE = 'Error en el formato o contenido de la respuesta: [' . json_last_error_msg() . '].  ' . $resultado . '';

            ApiSICAM::mostrar_resultado_para_depuracion(json_last_error_msg(), $Error->MENSAJE);
            return $this->JSONRespuesta = $Error;
        }
    }

    public function desconectar() {
        return curl_close($this->conexionApi);
    }

    private static function mostrar_resultado_para_depuracion($objetos, $informacion = null) {
        if (ApiSICAM::$MOSTRAR_RESPUESTA_API) {
            echo "\n-->>>\n ";
            if ($informacion) {
                echo "[" . strtoupper($informacion) . "]\n ";
            }
            print_r($objetos);
            if (empty($objetos)) {
                var_dump($objetos);
                echo "[Vacio / Sin Respuesta ]\n ";
            }
            echo "<<<--\n\n ";
        }
    }

}

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
        echo self::respuesta($respuesta, $mensaje, $datos);
    }

    public static function responseJson($respuesta, $mensaje, $datos = null) {
        echo self::respuesta($respuesta, $mensaje, $datos);
    }

    public static function respuesta($respuesta, $mensaje, $datos = null, $codigo = null, $error = null) {
        if (!isset($_SESSION)) {
            @session_start();
        }
        if (array_key_exists('IDLOG', $_SESSION) && !empty(SesionCliente::valor("IDLOG"))):
            Log::respuestaOperacion(SesionCliente::valor("IDLOG"), $respuesta, $mensaje);
        endif;
        @session_write_close();

        if (!empty(SesionCliente::valor('ERROR_BD'))) {
            $mensaje .= "<br /><strong>___Datos para Soporte TICS___</strong><br /><em><small>" . SesionCliente::valor('ERROR_BD') . "</small></em>";
            SesionCliente::valor('ERROR_BD', '');
        }

        if (!empty($mensaje)) {
            $mensaje = "<em>" . $mensaje . "</em>";
        }
        if (is_null($error)) {
            $error = "NO DEFINIDO";
        }
        $arrayRespuesta = array(
          'RESPUESTA' => $respuesta,
          'MENSAJE' => $mensaje,
          'DATOS' => $datos,
          'CODIGO' => $codigo,
          'ERROR' => $error
        );
        $jsonRespuesta = json_encode($arrayRespuesta);
        return $jsonRespuesta;
    }

    static public function exito($mensaje = null, $datos = null) {
        if (is_array($mensaje)) {
            $tmp = $datos;
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
        if (is_array($mensaje)) {
            $tmp = $datos;
            $datos = $mensaje;
            $mensaje = "";
        }

        if (is_object($mensaje)) {
            $array = (array) $mensaje;
            $mensaje = "";
            $datos = $array;
        }
        return self::respuesta(self::INFO, $mensaje, $datos);
    }

    public static function getRespuesta() {
        return self::$respuesta;
    }

    public static function getMensajeRespuesta() {
        return self::$mensaje;
    }

}
//$Api = ApiSICAM::ObjetoAPI();
