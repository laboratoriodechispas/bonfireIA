<?php
date_default_timezone_set("Mexico/General");

$rawPost = strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0? (isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input")) : NULL;

require_once("application/libraries/nusoap/lib/nusoap.php"); // load nusoap toolkit library in controller

$server = new nusoap_server();
// Configura WSDL
$server->configureWSDL('wservice', 'urn:wservicewsdl');
// Un tipo complejo que se usa con el método encriptar
$server->wsdl->addComplexType(  'datos_persona_entrada',
    'complexType',
    'struct',
    'all',
    '',
    array('nombre'   => array('name' => 'nombre','type' => 'xsd:string'),
        'email'    => array('name' => 'email','type' => 'xsd:string'),
        'telefono' => array('name' => 'telefono','type' => 'xsd:string'),
        'ano_nac'  => array('name' => 'ano_nac','type' => 'xsd:int'))
);
// Parametros de Salida
$server->wsdl->addComplexType(  'datos_persona_salidad',
    'complexType',
    'struct',
    'all',
    '',
    array('mensaje'   => array('name' => 'mensaje','type' => 'xsd:string'))
);

$server->register(  'calculo_edad', // nombre del metodo o funcion
    array('datos_persona_entrada' => 'tns:datos_persona_entrada'), // parametros de entrada
    array('return' => 'tns:datos_persona_salidad'), // parametros de salida
    'urn:mi_ws1', // namespace
    'urn:wservicewsdl2#calculo_edad', // soapaction debe ir asociado al nombre del metodo
    'rpc', // style
    'encoded', // use
    'La siguiente funcion recibe los parametros de la persona y calcula la Edad' // documentation
);

function calculo_edad($datos_persona_entrada) {

    $edad_actual = date('Y') - $datos_persona_entrada['ano_nac'];
    $msg = 'Hola, ' . $datos_persona_entrada['nombre'] . '. Hemos procesado la siguiente informacion ' . $datos_persona_entrada['email'] . ', telefono'. $datos_persona_entrada['telefono'].' y su Edad actual es: ' . $edad_actual . '.';
    return array('mensaje' => $msg);
}

$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
$server->service($POST_DATA);
exit();
?>