<?php
    include_once("./consumeSOAP.php");

    
    $datos = array(
        "Contrasena"=> "1234",
        "Correo"=> "carlos@gmail.com"
    );
    $id= array(
        "ID_Usuario"=> "1"

    );

    $datosUsuario= array(

        "Id"=>"9",
        "Nombre"=>"Felipi",
        "PrimerApellido"=>"Tun",
        "SegundoApellido"=>"cox",
        "Contrasena"=>"123",  
        "Correo"=>"felipe@gmail.com",
        "FechaNacimiento"=>"2019-05-06",
        "Estado"=>"Quintana Roo",
        "Localidad"=>"Chetumal",
        "Colonia"=>"16 de septiembre",
        "Calle"=>"rio verde",
        "NumeroDomicilio"=>"233",
        "NumeroAfiliado"=>"123456g"

      
    );

    
    //print_r( $cliente->login(json_encode($datos)));
   print_r($cliente->update(json_encode($datosUsuario)));
    
    
?>