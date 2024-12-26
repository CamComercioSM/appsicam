<?php

class SesionCliente {
  public static function estaLogueado() {
    SesionCliente::abrir();
    $ObjUSER = SesionCliente::valor('COLABORADOR');
    SesionCliente::cerrar();
    if ($ObjUSER) {
      return $ObjUSER;
    }
    return false;
  }

  public static function abrirSesion($usuario, $desde = null, $ip = null) {
    SesionCliente::valor('COLABORADOR', $usuario);
    SesionCliente::valor('SESION_ESTADO', $desde);
    SesionCliente::valor('SESION_IP', $ip);
    return SesionCliente::valor('COLABORADOR');
  }

  public static function cerrarSesion() {
    SesionCliente::destruir();
  }

  static function abrir() {
    $status = session_status();
    switch ($status) {
      case PHP_SESSION_NONE:
        error_reporting(0);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
        session_start();
        error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
        break;
      case PHP_SESSION_ACTIVE:
        return true;
        break;
    }
  }

  static function cerrar() {
    $status = session_status();
    if ($status == PHP_SESSION_ACTIVE) {
      session_write_close();
    }
  }

  static function activa() {
    return self::valor(SESION);
  }

  static function dato($variable) {
    $valor = false;
    $SesionActiva = self::valor(SESION);
    if (property_exists($SesionActiva, $variable)) {
      $valor = $SesionActiva->$variable;
    }
    return $valor;
  }

  static public function valor($nombre, $valor = null) {
    if (!is_null($valor)) {
      self::abrir();
      $_SESSION [$nombre] = $valor;
      self::cerrar();
    } else {
      self::abrir();
      if (!empty($_SESSION [$nombre])) {
        try {
          try {
            $valor = $_SESSION [$nombre];
          } catch (Exception $e) { $valor = null; }
        } catch (Exception $e) { $valor = null; }
        self::cerrar();
        return $valor;
      } else {
        self::cerrar();
        return false;
      }
    }
  }

  static public function eliminar($nombre) {
    self::abrir();
    unset($_SESSION [$nombre]);
    self::abrir();
  }

  static public function destruir() {
    self::abrir();
    $_SESSION = array();
    session_destroy();
    self::cerrar();
  }

  static function ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
      $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
      $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
      $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
      $ipaddress = getenv('REMOTE_ADDR');
    } else {
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
      } else {
        $ipaddress = 'DESCONOCIDA';
      }
    }
    return $ipaddress;
  }

  static function gpsIP() {
    $gps = GEOPLUGIN::gpsIP(self::ip());
    if (empty($gps)) {
      return null;
    }
    return $gps;
  }

  static function latitudIP() {
    $gps = GEOPLUGIN::gpsIP(self::ip());
    if (empty($gps)) {
      return null;
    }
    return $gps->latitud;
  }

  static function longitudIP() {
    $gps = GEOPLUGIN::gpsIP(self::ip());
    if (empty($gps)) {
      return null;
    }
    return $gps->longitud;
  }
}