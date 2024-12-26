<?php
//Archivo de Configuracion y Variables Globales  20230501
include 'encabezados-seguros.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
 setlocale (LC_TIME, "es_ES");
date_default_timezone_set('America/Bogota');
define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
define('DS', DIRECTORY_SEPARATOR);
if (!defined('DIR_BASE')) {
    define('DIR_BASE', __DIR__ . DS);
}
if (!defined('DIR_CORE')) {
    define('DIR_CORE', DIR_BASE . "nucleo" . DS);
}
if (!defined('DIR_CONFIG')) {
    define('DIR_CONFIG', DIR_CORE . "config" . DS);
}
if (!defined('DIR_LIBRERIA')) {
    define('DIR_LIBRERIA', DIR_CORE . "lib" . DS);
}
if (!defined('URL_LIBRERIA')) {
    define('URL_LIBRERIA', "https://libs.tiendasicam32.net/");
}
require_once DIR_CONFIG . 'Superglobales.php';
require_once DIR_CONFIG . 'ConfigBASE.php';
require_once DIR_CONFIG . 'ConfigAPP.php';
require_once DIR_LIBRERIA . 'apis/ApiSICAM' . (isset($modo) ? $modo : "") . '.php';
//Autoloads
require_once DIR_LIBRERIA . 'vendor/autoload.php';
//
//
////
//print_r(get_defined_constants(true)['user']);
////echo "\n\n";
//print_r(new ConfigBASE());
////echo "\n\n";
//print_r(ModeloBase::consultaAPI());
////echo "\n\n";
//die('el configBASE hasta aqui');