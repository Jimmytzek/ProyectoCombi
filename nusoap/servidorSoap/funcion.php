<?php

require_once('conexion.php');

function insert($codigo)
 {

    $conn=conectarse();
     
        $nombre = $codigo->Nombre; 
        $primerA = $codigo->PrimerApellido;
        $segundoA = $codigo->SegundoApellido;
        $inicio = $codigo->FechaInicio;
        $termino = $codigo->FechaTermino;
        $estatus = $codigo->Estatus; 

		$sql = "INSERT INTO histochofer  (Nombre, PrimerApellido, SegundoApellido, FechaInicio, FechaTermino, Estatus) 
        VALUES( '$nombre','$primerA','$segundoA', '$inicio', '$termino', '$estatus')";

    $rs = mysqli_query($sql,$conn);
    $i=0;
    $cadena = "<?xml version='1.0' enconding='utf-8'?>";
    if($rs != null){
        $cadena.="<curso>";
        if(mysqli_num_rows($rs)>0){
            while($row = mysqli_fetch_row($rs))
            {
 
            $cadena.="<curso>";
            $cadena.="<br>";
            $cadena.="<Nombre>".$row[1]."</nombre>";
            $cadena.="<br>";
            $cadena.="<PrimerApellido>".$row[2]."</PrimerApellido>";
            $cadena.="<br>";
            $cadena.="<SegundoApellido>".$row[3]."</SegundoApellido>";
            $cadena.="<br>";
            $cadena.="<FechaInicio>".$row[4]."</FechaInicio>";
            $cadena.="<br>";
            $cadena.="<FechaTermino>".$row[5]."</FechaTermino>";
            $cadena.="<br>";
            $cadena.="<Estatus>".$row[6]."</Estatus>"; 
            $cadena.="<br>";
            $cadena.="<curso>"; 
            $i++;

            } 
                

        } else{
            $cadena.="<error>No hay datos</erro>"; 
        }
            $cadena.="</curso>";
    }  
    $respuesta= new soapval('return','xsd:string',$cadena);
    return $respuesta; 
} 

?>