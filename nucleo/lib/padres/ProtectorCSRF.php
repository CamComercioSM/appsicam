<?php

class ProtectorCSRF {

  //put your code here
  public const CSRFP_FIELD_TOKEN_NAME = "CSRF_APLICACIONESDESACOPLADAS";
  public const CSRFP_FIELD_URLS = "CRSF_URLS_APLICACIONESDESACOPLADAS";

  public static $token = "";
  public static $config = [];
  public static $urls_validas = ["sicam32.net", "tiendasicam32.net"];

  public static function authorizePost() {
    // TODO(mebjas): this method is valid for same origin request only, 
    // enable it for cross origin also sometime for cross origin the
    // functionality is different.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Set request type to POST
      self::$requestType = "POST";

      // Look for token in payload else from header
      $token = self::getTokenFromRequest();

      // Currently for same origin only
      if (!($token && isset($_SESSION[self::$config['CSRFP_TOKEN']]) && (self::isValidToken($token)))) {

        // Action in case of failed validation
        self::failedValidationAction();
      } else {
        self::refreshToken();    //refresh token for successful validation
      }
    } else if (!static::isURLallowed()) {
      // Currently for same origin only
      if (!(isset($_GET[self::$config['CSRFP_TOKEN']]) && isset($_SESSION[self::$config['CSRFP_TOKEN']]) && (self::isValidToken($_GET[self::$config['CSRFP_TOKEN']])))) {
        // Action in case of failed validation
        self::failedValidationAction();
      } else {
        self::refreshToken();    // Refresh token for successful validation
      }
    }
  }

  private static function tokenValido($tokenRecibido) {
    foreach (self::listadoTokens() as $nombreVariableToken => $valorToken) {
      if ($valorToken == $tokenRecibido) {
        // Clear all older tokens assuming they have been consumed
//        self::eliminarTOKEN($nombreVariableToken);
        return true;
      }
    }
    return false;
  }

  public static function formularioValido() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//      echo "   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<";
//      echo self::sacarCONFIG('CSRFP_VARIABLE_TOKEN');
//      echo "  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
//      echo "   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<";
//      echo self::sacarCONFIG(self::sacarCONFIG('CSRFP_VARIABLE_TOKEN'));
//      echo "  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
//
//      echo "   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<";
//      print_r(self::listadoTokens());
//      echo "  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
//
//      echo "   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<";
//      print_r($_SESSION);
//      echo "  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>";

      $nombreVarToken = $_POST['CSRF_TRAMITESSEGUROS'];
      $tokenRecibido = $_POST[$nombreVarToken];
      return self::tokenValido($tokenRecibido);
    }
    return false;
  }

  public static function listadoTokens() {
    if (!isset($_SESSION['CSRF']['tokens'])) {
      $_SESSION['CSRF']['tokens'] = [];
    }
    return $_SESSION['CSRF']['tokens'];
  }

  public static function generarControlesFormulario() {

    self::init();

    $hiddenInput = '<input type="hidden" id="' . self::CSRFP_FIELD_TOKEN_NAME . '' . uniqid() . '"  name="' . self::CSRFP_FIELD_TOKEN_NAME . '" value="'
        . self::sacarCONFIG('CSRFP_VARIABLE_TOKEN') . '">' . PHP_EOL;
    $hiddenInput .= '<input type="hidden" id="' . self::sacarCONFIG('CSRFP_VARIABLE_TOKEN') . '' . uniqid() . '"  name="' . self::sacarCONFIG('CSRFP_VARIABLE_TOKEN') . '" value="'
        . self::sacarTOKEN(self::sacarCONFIG('CSRFP_VARIABLE_TOKEN')) . '">' . PHP_EOL;
    $hiddenInput .= '<input type="hidden" id="' . self::CSRFP_FIELD_URLS . '' . uniqid() . '"  name="' . self::CSRFP_FIELD_URLS . '" value=\''
        . json_encode(self::$urls_validas) . '\'>';

    return $hiddenInput;
  }

  public static function init($length = null) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }

    if ($length != null) {
      self::guardarCONFIG('tokenLength', intval($length));
    }

//    if (self::sacarCONFIG('CSRFP_VARIABLE_TOKEN') == '') {
    self::guardarCONFIG('CSRFP_VARIABLE_TOKEN', uniqid());
//    }

    if (self::sacarCONFIG(self::sacarCONFIG('CSRFP_VARIABLE_TOKEN')) == '') {
      self::refreshToken();
    }
  }

  public static function refreshToken() {
    self::$token = self::generateAuthToken();

    if (self::sacarCONFIG(self::sacarCONFIG('CSRFP_VARIABLE_TOKEN')) == '') {
      self::agregarTOKEN(self::sacarCONFIG('CSRFP_VARIABLE_TOKEN'), self::$token);
    }
  }

  private static function agregarTOKEN($nombreVariableToken, $token) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }
    if (!isset($_SESSION['CSRF']['tokens'])) {
      $_SESSION['CSRF']['tokens'] = [];
    }
    $_SESSION['CSRF']['tokens'][$nombreVariableToken] = $token;
  }

  private static function sacarTOKEN($nombreVariableToken) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }
    if (!isset($_SESSION['CSRF']['tokens'])) {
      $_SESSION['CSRF']['tokens'] = [];
    }
    return $_SESSION['CSRF']['tokens'][$nombreVariableToken];
  }

  private static function eliminarTOKEN($nombreVariableToken) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }
    if (!isset($_SESSION['CSRF']['tokens'][$nombreVariableToken])) {
      return true;
    } else {
      unset($_SESSION['CSRF']['tokens'][$nombreVariableToken]);
      return true;
    }
    return false;
  }

  public static function generateAuthToken() {
    // TODO(mebjas): Make this a member method / configurable
    $randLength = 64;

    // If config tokenLength value is 0 or some non int
    if (self::sacarCONFIG('tokenLength') == 0) {
      self::guardarCONFIG('tokenLength', 32);    //set as default
    }

    // TODO(mebjas): if $length > 128 throw exception 

    if (function_exists("random_bytes")) {
      $token = bin2hex(random_bytes($randLength));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
      $token = bin2hex(openssl_random_pseudo_bytes($randLength));
    } else {
      $token = '';
      for ($i = 0; $i < 128; ++$i) {
        $r = mt_rand(0, 35);
        if ($r < 26) {
          $c = chr(ord('a') + $r);
        } else {
          $c = chr(ord('0') + $r - 26);
        }
        $token .= $c;
      }
    }
    return substr($token, 0, self::sacarCONFIG('tokenLength'));
  }

  private static function guardarCONFIG($variable, $valor) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }
    if (!isset($_SESSION['CSRF'])) {
      $_SESSION['CSRF'] = [];
    }
    $_SESSION['CSRF'][$variable] = $valor;
  }

  private static function sacarCONFIG($variable) {
    // Start session in case its not, and unit test is not going on
    if (session_status() === PHP_SESSION_DISABLED) {
      session_start();
    }
    if (!isset($_SESSION['CSRF'])) {
      $_SESSION['CSRF'] = [];
    }
    if (!isset($_SESSION['CSRF'][$variable])) {
      $_SESSION['CSRF'][$variable] = null;
    }
    return $_SESSION['CSRF'][$variable];
  }

}
