<?php

spl_autoload_register(function (string $className) {
    if ($className !== "Controladores") {
        $className = str_replace(["Controlador", "Modelo"], ["", ""], $className);
    }
    //echo "entrando al instanciador BASE .............\n\r";
    //echo $className . ".............\n\r";
    $path = DIR_LIBRERIA . 'clases';
    //echo $path;
    //echo ".............\n\r";
    if (is_file($path . DS . 'padres' . DS . $className . '.clase.php')) {
        //echo $path . DS . 'padres' . DS . $className . '.clase.php';
        include $path . DS . 'padres' . DS . $className . '.clase.php';
    }
    //echo ".............\n\r";
    if (is_file($path . DS . 'objetos' . DS . $className . '.clase.php')) {
        //echo $path . DS . 'objetos' . DS . $className . '.clase.php';
        include $path . DS . 'objetos' . DS . $className . '.clase.php';
    }
    //echo ".............\n\r";
    //echo $path . DS . 'base-datos' . DS . $className . '.modelo.php';
    //echo ".............\n\r";
    if (is_file($path . DS . 'base-datos' . DS . $className . '.modelo.php')) {
        //echo $path . DS . 'base-datos' . DS . $className . '.modelo.php';
        include $path . DS . 'base-datos' . DS . $className . '.modelo.php';
    } else {
        $rutaDir = $path . DS . 'base-datos' . DS;
        $nombreArchivoModelo = $className . '.modelo.php';
        if (is_dir($rutaDir)) {
            if ($dh = opendir($rutaDir)) {
                while (($file = readdir($dh)) !== false) {
                    //echo $rutaDir . $file . DS . $nombreArchivoModelo;
                    //echo ".............\n\r";
                    if (is_dir($rutaDir . $file) && $file != "." && $file != "..") :
                        if (is_file($rutaDir . $file . DS . $nombreArchivoModelo)) {
                            require_once $rutaDir . $file . DS . $nombreArchivoModelo;
                            //echo "cargado .............\n\r";
                        }
                    endif;
                }
                closedir($dh);
            }
        }
    }
    //echo ".............\n\r";
    if (is_file($path . DS . 'logica' . DS . $className . '.control.php')) {
        //echo $path . DS . 'logica' . DS . $className . '.control.php';
        include $path . DS . 'logica' . DS . $className . '.control.php';
    }
    //echo ".............\n\r";
    if (is_file($path . DS . 'vistas' . DS . $className . '.html.php')) {
        //echo $path . DS . 'logica' . DS . $className . '.control.php';
        include $path . DS . 'vistas' . DS . $className . '.html.php';
    }
    //echo ".............\n\r";
    if (is_file($path . DS . 'apis' . DS . $className . '.php')) {
        //echo $path . DS . 'logica' . DS . $className . '.control.php';
        include $path . DS . 'apis' . DS . $className . '.php';
    }

    if (is_file($path . DS . 'utilidades' . DS . $className . '.util.php')) {
        //echo $path . DS . 'logica' . DS . $className . '.control.php';
        include $path . DS . 'utilidades' . DS . $className . '.util.php';
    }
    //echo ".............\n\r";
});

#[AllowDynamicProperties]
abstract class Superglobales {

    public function crearPropiedadesDatosRecibidos() {
        if (isset($_POST) and !empty($_POST)) {
            foreach ($_POST as $variable => $valor) {
                $this->$variable = $valor;
                $variable = str_replace("-", "_", $variable);
                $this->$variable = $valor;
            }
        }
        if (isset($_GET) and !empty($_GET)) {

            if (isset($_GET['RUTA_PERSONALIZADA']) and !empty($_GET['RUTA_PERSONALIZADA'])) {
                $PARTES = explode("/", $_GET['RUTA_PERSONALIZADA']);
                $this->SUBPAGINA = $PARTES[0];
                if (count($PARTES) > 1) {
                    $this->PRESENTACION = $PARTES[1];
                }
            }

            foreach ($_GET as $variable => $valor) {
                $this->$variable = $valor;
                $variable = str_replace("-", "_", $variable);
                $this->$variable = $valor;
            }
        }
        if (isset($_FILES) and !empty($_FILES)) {
            $cntArchivos = 0;
            foreach ($_FILES as $variable => $valor) {
                if (is_array($valor['name'])) {
                    $this->$variable = array();
                    foreach ($valor['name'] as $nombre) {
                        if ($valor['size'][$cntArchivos] > 0) {
                            $archivo = array();
                            $archivo['name'] = $valor['name'][$cntArchivos];
                            $archivo['type'] = $valor['type'][$cntArchivos];
                            $archivo['tmp_name'] = $valor['tmp_name'][$cntArchivos];
                            $archivo['error'] = $valor['error'][$cntArchivos];
                            $archivo['size'] = $valor['size'][$cntArchivos];
                            array_push($this->$variable, $archivo);
                            $cntArchivos++;
                        }
                    }
                } else {
                    if ($valor['size'] > 0) {
                        $this->$variable = $valor;
                    }
                }
            }
        }
    }
}
