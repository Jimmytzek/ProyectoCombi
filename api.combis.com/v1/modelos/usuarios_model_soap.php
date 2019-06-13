<?php

  include_once 'datos/ConexionBD.php';
  class usuarios{

    public function getUsuarios(){
      $comando = "SELECT *" .
            " FROM Usuario" ;

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        // $sentencia->bindParam(1, $correo);

        if ($sentencia->execute())
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        else
            return null;
    }
  }

  $params = array( "uri" => "api.combis.com/v1/usuarios_model_soap.php");
  $server = new SoapServer(NULL, $params);
  $server->setClass("usuarios");
  $server->handle();
?>