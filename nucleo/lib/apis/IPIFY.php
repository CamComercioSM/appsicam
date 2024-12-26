<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Cliente
 *
 * @author SISTEMAS
 */
class IPIFY {
  public static function obtenerIP() {
    $respuesta = file_get_contents('https://api.ipify.org');
    if (empty($respuesta)) {
      return null;
    } else {
      return $respuesta;
    }
  }
}