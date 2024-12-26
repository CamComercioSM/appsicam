<?php
//Archivo de Configuración y Variables Aplicacion  20230501
require_once DIR_CONFIG . 'ConfigBASE.php';  //'/home/tiendasicam32/public_html/libs/ConfigBASE.php';

class ConfigAPP extends ConfigBASE {
    public $GoogleAnalitycsTag = "G-ZBTLK22S7Q";
    public $GA4Tag = "G-ZBTLK22S7Q";
    public $APP_NOMBRE = "APP de Ejemplo 2023";
    public $APP_TITULO = "Titulo de la Aplicación - Llamado a la Acción";
    public $APP_DESCRIPCION = "Descripcion de la Aplicación - Información para Redes Sociales";
    public $APP_DIR = __DIR__ . DS;
    public $APP_URL = "https://ejemplo.ccsm.org.co/";
    public $APP_PLANTILLA_DIR = DIR_LIBRERIA  . "plantillas" . DS . "en-construccion" . DS;
    public $APP_PLANTILLA_URL = URL_LIBRERIA . "plantillas" . DS . "en-construccion" . DS;
    public $Mantenimiento = false;
    public $LoginColaboradores = true;

    function __construct($APP_NOMBRE = null, $APP_TITULO = null, $APP_DESCRIPCION = null, $APP_DIR = null, $APP_URL = null, $APP_PLANTILLA_DIR = null, $APP_PLANTILLA_URL = null, $Mantenimiento = null, $LoginColaboradores = null) {
        parent::__construct();
//        echo "configAPP ..............";  print_r($this);
//        echo ".............\n\r";

        (!is_null($APP_NOMBRE) ? $this->APP_NOMBRE = $APP_NOMBRE : null);
        (!is_null($APP_TITULO) ? $this->APP_TITULO = $APP_TITULO : null);
        (!is_null($APP_DESCRIPCION) ? $this->APP_DESCRIPCION = $APP_DESCRIPCION : null);
        (!is_null($APP_URL) ? $this->APP_URL = $APP_URL : null);
        (!is_null($APP_DIR) ? $this->APP_DIR = $APP_DIR : __DIR__ . DS);
        (!is_null($APP_PLANTILLA_DIR) ? $this->APP_PLANTILLA_DIR = $APP_PLANTILLA_DIR : __DIR__ . DS . "plantilla" . DS);
        (!is_null($APP_PLANTILLA_URL) ? $this->APP_PLANTILLA_URL = $APP_PLANTILLA_URL : $this->APP_URL . "plantilla" . DS);
//        (!is_null($EJEMPLO) ? $this->EJEMPLO = $EJEMPLO : null);
        (!is_null($Mantenimiento) ? $this->Mantenimiento = $Mantenimiento : null);
        (!is_null($LoginColaboradores) ? $this->LoginColaboradores = $LoginColaboradores : null);

        spl_autoload_register(
            function ($className) {
                $nombreArchivo = str_replace(
                    ['Controlador'], [''], $className
                );
//                echo "entrando al instanciador de la aplicacion.............\n\r";
//                print_r($this);
//                echo $this->APP_DIR . 'php/clases/' . $nombreArchivo . '.clase.php';
                if (is_file($this->APP_DIR . 'php/clases/' . $nombreArchivo . '.clase.php')) {
                    include $this->APP_DIR . 'php/clases/' . $nombreArchivo . '.clase.php';
                }
                if (is_file($this->APP_DIR . 'php/controladores/' . $nombreArchivo . '.control.php')) {
                    include $this->APP_DIR . 'php/controladores/' . $nombreArchivo . '.control.php';
                }
                if (is_file($this->APP_DIR . 'php/modelos/' . $nombreArchivo . '.modelo.php')) {
                    include $this->APP_DIR . 'php/modelos/' . $nombreArchivo . '.modelo.php';
                }
//            echo ".............\n\r";
            }
        );
    }

}
//
//
////
//print_r(get_defined_constants(true)['user']);
//echo "\n\n";
//print_r($Config);
//echo "\n\n";
//print_r(ModeloBase::consultaAPI());
//echo "\n\n";
//die('el configAPP hasta aqui');

