<?php
$permitidas = [
    "*.ccsm.org.co",
    "*.sicam32.net", "*.tiendasicam32.net",
    "*.citurcam.com",
    "*.tramites-seguros.net", "*.tramites-seguros.com",
    "ccsm.org.co",
    "sicam32.net", "tiendasicam32.net",
    "citurcam.com",
    "tramites-seguros.net", "tramites-seguros.com",
    "unpkg.com", "cdnsicam.net"
];
$permitidasEspacio = implode(" ", $permitidas);
$controles = [
    "*.cloudflare.com", "*.userway.org", "*.freshchat.com", "*.freshworks.com"
    , "*.google-analytics.com", "*.googleapis.com", "*.googlesyndication.com", "*.googletagmanager.com", "*.googleadservices.com", "*.google.com", "*.google.com.co", "*.gstatic.com"
];
$controlesEspacio = implode(" ", $controles);
$librerias = [
    "*.datatables.net", "*.jsdelivr.net", "*.amcharts.com", "*.jquery.com", "*.mapbox.com"
];
$libreriasEspacio = implode(" ", $librerias);
$originENTRANDO = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : $_SERVER['HTTP_HOST'];
$origin = 'null';
foreach ($permitidas as $url) {
  if (strpos($originENTRANDO, $url)) {
    $origin = $originENTRANDO;
  }
}
header('Access-Control-Allow-Origin: ' . $origin);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization, X-API-KEY, Access-Control-Request-Method');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
// header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');
header(
    "Content-Security-Policy: "
    . "frame-ancestors " . $permitidasEspacio . " ; "
    . "object-src * ; "
    . "frame-src *; "
    . "child-src * ; "
    . "script-src " . $permitidasEspacio . " " . $libreriasEspacio . " " . $controlesEspacio . " 'unsafe-inline'  'unsafe-eval' ; "
    . "script-src-elem " . $permitidasEspacio . " " . $libreriasEspacio . " " . $controlesEspacio . "  'unsafe-inline'  'unsafe-eval'  ; "
    . " "
);
header("X-Frame-Options: SAMEORIGIN ");
header("X-XSS-Protection: 0");
header("X-Content-Type-Options: nosniff");
header("X-Permitted-Cross-Domain-Policies: none ");
header("Referrer-Policy: no-referrer ");
//header("Clear-Site-Data: \"cache\",  \"cookies\",  \"storage\" ");
//header("Cross-Origin-Embedder-Policy: require-corp ");
header("Cross-Origin-Opener-Policy: same-origin ");
header("Cross-Origin-Resource-Policy: cross-origin ");
header("Strict-Transport-Security: max-age=6000 ; includeSubDomains");
header("Cache-Control: no-store, max-age=0 ");
header("Pragma: no-cache ");
