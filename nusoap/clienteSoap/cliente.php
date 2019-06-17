<?php 
include_once('./../lib/nusoap.php');
require_once('./../servidorSoap/server.php');
$url = "http://localhost/soap/servidorSoap/server.php";

$cliente = new nusoap_client($url,false);
$cuerpo= file_get_contents('php://input');

$array = json_decode($cuerpo);
$cursos=$cliente->call('usuario.insert',array("parametros"=>$array));

echo($cursos);
 

// if(!isset($HTTP_RAW_POST_DATA))
// $HTTP_RAW_POST_DATA=file_get_contents('php://input');
// $server->service($HTTP_RAW_POST_DATA);
// require "./../lib/nusoap.php";
// $url = "http://localhost/soap/servidorSoap/service.php";
// $cliente = new nusoap_client($url."?wsdl",'Wsdl');

// $codigo =$_POST["idCurso"];

// $cursos = $cliente->call('insert',array("datosUsuario"=>$datosUsuario),'uri:'.$url, 'uri:'.$url.'/insert');

// if($cliente->fault){
//     echo "error";
//     print_r($cursos);
// }else{
//     if($cliente->getError()){
//         echo '<b>Error: '.$cliente->getError().'</b>';
 
//     }else{
//         print_r($cursos);
//     }
// }
?>