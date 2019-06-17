<?php

include_once('./../lib/nusoap.php');
require_once('usuario.php');
//$url = "http://localhost/soap/servidorSoap/service.php";

$server = new nusoap_server();
$server->configureWSDL("server","urn:server"); 
$server->wsdl->schemaTargetNamespace = 'urn:server';

$server->register("usuario.insert",
            array("codigo"  => "xsd:array"),
            array("return" => "xsd:array") 
            );

$server->service(file_get_contents("php://input"));

?>