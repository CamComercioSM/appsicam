<?php
echo __DIR__;die();

require_once '/base.php';

class Config extends ConfigAPP {

    public $APP_URL = "https://ausentismos.tiendasicam32.net/";
    public $APP_DIR = __DIR__ . DIRECTORY_SEPARATOR;
    public $APP_PLANTILLA_DIR = __DIR__ . DIRECTORY_SEPARATOR . "plantilla" . DIRECTORY_SEPARATOR;
    public $APP_NOMBRE = "APP Ausentismos";
    public $APP_TITULO = "Ausentismos";
    public $APP_DESCRIPCION = "Ausentismos";

    public

    const DIR_BASE = __DIR__ . DIRECTORY_SEPARATOR;

    public $DIR_APP = __DIR__ . DIRECTORY_SEPARATOR;
    public $DIR_PANTILLA = __DIR__ . DIRECTORY_SEPARATOR . 'plantilla/';
    public $BASE_PANTILLA_NOMBRE = 'ausentismos';
    public $Autorizar = false;
    public $Cancelar = false;
    public $Cerrar = false;
    public $Iniciar = false;
    public $Mantenimiento = false;

    public function __construct() {
        parent::__construct();
    }

}

//$Api::$MODO_PRUEBAS = true;
$Api = ApiSICAM::ObjetoAPI(
                "OfGHlbyt/i6RtrFf+jan9qrc+rKcbCDIPNy2MLt1PllMSdshnyF99QezacQfFIRJ", "gDIDifzUUTFg6rzvm5R/QLmK1uFJxgZYr5206wEOXMM="
);
$Config = new Config();
$Config->AusentismosTipos = Ausentismos::listadoTiposAusentismos();
$Config->Politicas = Ausentismos::politicaApp();

if (isset($_GET['operacion'])) {
    if (isset($_GET['ausenciaColaboradorID'])) {
        $Config->Ausentismo = Ausentismos::datos($_GET['ausenciaColaboradorID']);

        switch ($_GET['operacion']) {
            case 'AUTORIZAR':
                if ($Config->Ausentismo->tipoAusentismoGRUPO == 'PERMISO' || $Config->Ausentismo->tipoAusentismoGRUPO == 'COMPENSATORIO') {
                    $Config->Autorizar = true;
                }
                break;
            case 'CANCELAR':
                if ($Config->Ausentismo->tipoAusentismoGRUPO == 'PERMISO' || $Config->Ausentismo->tipoAusentismoGRUPO == 'COMPENSATORIO') {
                    $Config->Cancelar = true;
                }
                break;
            case 'CERRAR':
                if ($Config->Ausentismo->ausenciaColaboradorFCHINICIO != $Config->Ausentismo->ausenciaColaboradorFCHPERMISOINICIO && $Config->Ausentismo->tipoAusentismoGRUPO == 'PERMISO') {
                    $Config->Cerrar = true;
                }
                break;
            case 'INICIAR':
                if ($Config->Ausentismo->tipoAusentismoGRUPO == 'PERMISO') {
                    $Config->Iniciar = true;
                }
                break;
            default:
                break;
        }
    }
}