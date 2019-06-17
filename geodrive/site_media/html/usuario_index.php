<?php

session_start();
 

      if (!isset($_SESSION['sesion'])) {
        header('Location: usuario_login.php');
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./../css/base_template.css">
    <title>Document</title>
</head>
<body> 
  
<ul>
  <li><a class="active">Usuarios</a></li>
  <li><a href="usuario_del.php">Eliminar usuario</a></li>
  <li><a class="active" href="usuario_reporte.php">reporte</a></li> 
  <li ><a class="active" href="usuario_update.php">Actualizar usuario</a></li>
  <li ><a class="active" href="usuario_singnOut.php">cerrar sesion</a></li>
 
  
  <!-- href="usuario_singnOut.php" -->
</ul>

<div id="map"></div>
<script src="./../js/script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
    
</body>
<footer>
  <h6>&copy; NO a la copia de esta API</h6>
</footer>
</html>