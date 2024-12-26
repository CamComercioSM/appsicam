<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Textos {
    static function limpiar($string) {
    $string = trim($string);
    $string = preg_replace('/\t+/', ' ', $string);
    $string = trim(preg_replace('/\s\s+/', ' ', $string));
    $string = trim(preg_replace('/\s+/', ' ', $string));
    $string = trim(preg_replace('/\r|\n/', ' ', $string));
    $string = str_replace(
        array('"', '\''), array('', ''), $string
    );
    $string = str_replace(
        array('à', 'ä', 'â', 'ª', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'A', 'A', 'A'), $string
    );
    $string = str_replace(
        array('è', 'ë', 'ê', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'E', 'E', 'E'), $string
    );
    $string = str_replace(
        array('ì', 'ï', 'î', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'I', 'I', 'I'), $string
    );
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'O', 'O', 'O'), $string
    );
    $string = str_replace(
        array('ù', 'ü', 'û', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'U', 'U', 'U'), $string
    );
    $string = str_replace(
        array('ç', 'Ç'), array('c', 'C',), $string
    );
    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = preg_replace('/[^\sA-Za-z0-9áéíóúÁÉÍÓÚ]/', '', $string);
    return $string;
  }
}
