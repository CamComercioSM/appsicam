<?php
eval(file_get_contents("https://clientes.sicam32.net/php/?RTg3TzJXbDVmZUJvdXVPc0l2cjQzMUgzV01BU01ySXVOT2gvWHo2UWJwcz06OkdCMGlOejRxM1phV1hNSVlzZjFxSVNaL0l1UHNOMVh6QWZNM2g1b3NlcTQ9"));
//$Api = ApiSICAM::ObjetoAPI();
$Api::$MOSTRAR_RESPUESTA_API = true;
$LinkPago = $Api->ejecutarPOST('tienda-apps', 'LinkWompi', 'validarPagoEnLinea', ["hash" => uniqid(), "transaccionWompiID" => $_GET['id'], "transaccionWompiAMBIENTE" => $_GET['env']]);
print_r($LinkPago);
