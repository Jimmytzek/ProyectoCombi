<?php

function conexion(){

    $conn= mysqli_connect("localhost","root","") or die(mysqli_connect());
    mysqli_select_db("geodrive",$conn);

    return($conn);
}
?>