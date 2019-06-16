<?php

include_once 'datos/ConexionBD.php';
class usuarios
{

  public function getUsuarios()
  {
    $db = new Db();

    $res = $db->getAll();
    $xml = new SimpleXMLElement('<usuarios/>');
    $this->toXml($xml, $res);
    return $xml->asXML();
  }
  
  public function getByEmail($email)
  {
    $db = new Db();

    $res = $db->getByEmail($email);
    $xml = new SimpleXMLElement('<usuario/>');
    $this->toXml($xml, $res);
    return $xml->asXML();
    // return $res;
  }

  public function insert($datos)
  {
    $db = new Db();

    $res = $db->insert($datos);
    $xml = new SimpleXMLElement('<data/>');
    $this->toXml($xml, $res);
    return $xml->asXML();
  }

  public function login($datos)
  {
    $db = new Db();

    $res = $db->login($datos);
    $xml = new SimpleXMLElement('<data/>');
    $this->toXml($xml, $res);
    return $xml->asXML();
  }

  public function getUbicacionCombis()
  {
    $db = new Db();

    $res = $db->getUbicacionCombis();
    $xml = new SimpleXMLElement('<data/>');
    $this->toXml($xml, $res);
    return $xml->asXML();
  }

  public function delete($id)
  {

    $db = new DB();

    $res = $db->delete($id);

    return $res;
  }

  public function update($datos)
  {
    $db = new DB();
    $res = $db->update($datos);
    return $res;
  }

  private function toXml(SimpleXMLElement $object, array $data)
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        if ($key == (int)$key) {
          $key = "i_$key";
        }
        $new_object = $object->addChild($key);
        $this->toXml($new_object, $value);
      } else {
        if ($key == (int)$key) {
          $key = "$key";
        }

        $object->addChild($key, $value);
      }
    }
  }
}

$params = array("uri" => "http://localhost/soap/usuariosSOAP.php");
$server = new SoapServer(NULL, $params);
$server->setClass("usuarios");
$server->handle();
?>