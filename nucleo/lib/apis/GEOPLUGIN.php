<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of GEOPLUGIN
 *
 * @author SISTEMAS
 */
class GEOPLUGIN {
  //put your code h
  public static function gpsIP($direccionIP) {
    $meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $direccionIP));
    if (empty($meta)) {
      return null;
    } else {
      $datos = new stdClass();
      $datos->latitud = $meta['geoplugin_latitude'];
      $datos->longitud = $meta['geoplugin_longitude'];
      return $datos;
    }
  }
}