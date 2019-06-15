<?php

include_once 'datos/ConexionBD.php';
class usuarios
{

  public function getUsuarios()
  {
    $db = new Db();

    $res = $db->getAll();
    return $res;
  }

  public function insert($datos)
  {
    $db = new Db();

    $res = $db->insert($datos);
    return $res;
  }

  public function login($datos)
  {
    $db = new Db();

    $res = $db->login($datos);
    return $res;
  }
  public function delete($id){

    $db = new DB();

    $res = $db->delete($id);

    return $res;
  }

  public function update($datos){
    $db = new DB();
    $res= $db->update($datos);
    return $res;
  }
  
  
}

$params = array("uri" => "http://localhost/soap/usuariosSOAP.php");
$server = new SoapServer(NULL, $params);
$server->setClass("usuarios");
$server->handle();
?>