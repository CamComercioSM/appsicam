<?php

//Archivo de Configuracion y Variables Globales  20230501
class ConfigBASE extends Superglobales {
    public $GoogleAnalitycsTag = "G-ZBTLK22S7Q";
    public $GA4Tag = "G-ZBTLK22S7Q";
    public $APP_NOMBRE = "Nombre de la APP";
    public $APP_TITULO = "Titulo de la APP";
    public $APP_DESCRIPCION = "Descripción de la APP.";
    public $APP_DIR = null;
    public $APP_URL = "https://subdomino_app.ccsm.org.co/";
    public $APP_PLANTILLA_DIR = null;
    public $APP_PLANTILLA_URL = null;
    public $BASE_URL = "https://tiendasicam32.net/";
    public $LIBRERIA_URL = URL_LIBRERIA;
    public $BASE_PANTILLA_NOMBRE = 'basica';
    public $BASE_PANTILLA_URL = URL_LIBRERIA . 'plantillas/';
    public $BASE_PANTILLA_DIR = DIR_LIBRERIA . 'plantillas/';
    public $SUBPAGINA = null;
    public $PRESENTACION  = null;
    public $Mantenimiento = false;
    public $LoginColaboradores = true;

    function __construct() {
        $this->BASE_PANTILLA_DIR = DIR_LIBRERIA . 'plantillas/' . $this->BASE_PANTILLA_NOMBRE . '/';
        $this->BASE_PANTILLA_URL = URL_LIBRERIA . 'plantillas/' . $this->BASE_PANTILLA_NOMBRE . '/';
        $this->crearPropiedadesDatosRecibidos();
    }

    public $CCSM_NOMBRE = 'Cámara de Comercio de Santa Marta para el Magdalena';
    public $CCSM_URL = 'https://www.ccsm.org.co';
}
//
//
////
//print_r(get_defined_constants(true)['user']);
//echo "\n\n";
//print_r(new ConfigBASE());
//echo "\n\n";
//die('el configBASE hasta aqui');