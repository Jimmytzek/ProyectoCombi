<?php

    class cliente{

        private $client;


        public function getClient(){
            if($this->client == null){
                $params = array("location" => "http://localhost/soap/usuariosSOAP.php", 
                "uri" => "localhost/soap/usuariosSOAP.php", 
                "trace" =>1);

                $this->client = new SoapClient(NULL, $params);
            }
            return $this->client;

        }
        
        
    }
?>