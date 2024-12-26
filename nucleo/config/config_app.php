<?php
//Archivo de Configuración y Variables Aplicacion  20230501
require_once '../../configBASE.php';

class Config extends ConfigAPP {
    public $APP_URL = "https://tmpl.tiendasicam32.net/";
    public $APP_DIR = __DIR__ . DIRECTORY_SEPARATOR;
    public $APP_PLANTILLA_DIR = __DIR__ . DIRECTORY_SEPARATOR . "plantilla" . DIRECTORY_SEPARATOR;
    //variables personalizadas
    public const constanteOparametroDelaAplicacion = 1;
}
$Api::$MODO_PRUEBAS = true;
$Api = ApiSICAM::ObjetoAPI(
        "ckJy7EFv7qci5akH6HKp7Hcf2S7y4dT40YozADGzfSFMTh4pFWMDbpnGtCsYzA5J",
         "p+Dm3Ya9vGrpz1zAkLZpBpzUT7ZnlatzkCALpO+gi4M="
);
$Config = new Config(); //($APP_NOMBRE, $APP_TITULO, $APP_DESCRIPCION, $APP_DIR, $APP_URL, $APP_PLANTILLA_DIR, $APP_PLANTILLA_URL, $Mantenimiento, $LoginColaboradores);
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