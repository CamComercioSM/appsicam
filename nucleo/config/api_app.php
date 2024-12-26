<?php
if (isset($_POST['controlador'])) {
  $controlador = ucfirst($_POST['controlador']);
//    $rutaAPP = 'php/controladores/' . $controlador . '.control.php';
  $nombreClase = $controlador . 'Controlador';
  if (class_exists($nombreClase)) {
    $classCtrl = new $nombreClase();
//    print_r($classCtrl);
    if ($classCtrl instanceof $nombreClase) {
      $nombreFuncion = lcfirst($_POST['operacion']);
//      print_r($classCtrl);
      if (method_exists($classCtrl, $nombreFuncion)) {
//        echo $nombreFuncion;
//        print_r($classCtrl);
        $Respuesta = $classCtrl->$nombreFuncion();
        echo $Respuesta;
      } else {
        die('No existe el metodo u operacion [' . $nombreFuncion . '] para la clase [' . $nombreClase . ']');
      }
    } else {
      die('No cargó la clase [' . $nombreClase . '].');
    }
  } else {
    die('No existe la clase [' . $nombreClase . '].');
  }
}