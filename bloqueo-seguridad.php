<?php
//if (!session_status() == PHP_SESSION_ACTIVE) {
//session_start();
//}
//$_SESSION = null;
//die();
if (!isset($_SESSION['hashSESION'])) { $_SESSION['hashSESION'] = null; }
if (!isset($_SESSION['hashSERVICIO'])) { $_SESSION['hashSERVICIO'] = null; }
if (!isset($_SESSION['ControlServicio'])) { $_SESSION['ControlServicio'] = null; }
//print_r($_SESSION);
$tiempo_bloqueo_seguridad = 30; //segundos
$intentos_fallidos_acceso = 5;
if (!isset($_SESSION['access_error'])) { $_SESSION['access_error'] = 0; }
if (!isset($_SESSION['bloqueo_seguridad'])) { $_SESSION['bloqueo_seguridad'] = false; }
if (!isset($_SESSION['tiempo_espera_seguridad'])) { $_SESSION['tiempo_espera_seguridad'] = 0; }
if (!isset($_SESSION['fecha_inicio_bloqueo'])) { $_SESSION['fecha_inicio_bloqueo'] = null; }
if (!isset($_SESSION['fecha_final_bloqueo'])) { $_SESSION['fecha_final_bloqueo'] = null; }
if ($_SESSION['bloqueo_seguridad'] && $_SESSION['tiempo_espera_seguridad'] > 0) {
  $_SESSION['tiempo_espera_seguridad'] = $_SESSION['fecha_final_bloqueo'] - strtotime('now');
  die("Debes esperar " . $_SESSION['tiempo_espera_seguridad'] . " segundos para intentarlo nuevamente.");
}

if ($_SESSION['access_error'] >= $intentos_fallidos_acceso) {
  $_SESSION['access_error'] = 0;
  $_SESSION['bloqueo_seguridad'] = true;
  $_SESSION['fecha_inicio_bloqueo'] = strtotime('now');
  $_SESSION['fecha_final_bloqueo'] = strtotime('now +' . $tiempo_bloqueo_seguridad . ' seconds ');
  $_SESSION['tiempo_espera_seguridad'] = $_SESSION['fecha_final_bloqueo'] - strtotime('now');
  die("Se completó el máximo de intentos fallidos. Estaras bloqueado hasta " . date("Y-m-d H:i:s", $_SESSION['fecha_final_bloqueo']));
}

if ($_SESSION['bloqueo_seguridad'] && $_SESSION['tiempo_espera_seguridad'] <= 0) {
  $_SESSION['tiempo_espera_seguridad'] = 0;
  $_SESSION['access_error'] = 0;
  $_SESSION['bloqueo_seguridad'] = false;
  $_SESSION['fecha_inicio_bloqueo'] = null;
  $_SESSION['fecha_final_bloqueo'] = null;
}

//if (session_status() == PHP_SESSION_ACTIVE) {
$_SESSION['bloqueoPHP_hash_' . uniqid()] = uniqid(); 
//session_write_close();
//}