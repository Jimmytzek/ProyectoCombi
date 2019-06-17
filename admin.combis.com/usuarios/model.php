<?php
    class Usuario{
        public function __construct()
        {
            $params = array("location" => "http://localhost/soap/usuariosSOAP.php", 
            "uri" => "localhost/soap/usuariosSOAP.php", 
            "trace" =>1);

            $this->instance = new SoapClient(NULL, $params);
        }

        public function getUsuarios(){
            return $this->instance->__soapCall("getUsuarios", array());
        }

        public function getByEmail($correo){
            return $this->instance->__soapCall("getByEmail", array($correo));
        }

        public function insert($datos){
            return $this->instance->__soapCall("insert", array($datos));
        }

        public function login($datos){
            return $this->instance->__soapCall("login", array($datos));
        }

        public function delete($id){
            return $this->instance->__soapCall("delete",array($id));
        }

        public function update($datos){
            return $this->instance->__soapCall("update",array($datos));
        }

        public function getUbicacionCombis(){
            return $this->instance->__soapCall("getUbicacionCombis",array());
        }
    }
?>