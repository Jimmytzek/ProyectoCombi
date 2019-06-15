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

<?php

session_start();

      if (isset($_SESSION['sesion'])) {
        header('Location: usuario_login.php');
        echo $_SESSION['sesion'];
        exit();

      }

      function cerrar(){
        session_abort();

      }
?>

<ul>
  <li><a class="active">Usuarios</a></li>
  <li><a href="usuario_del.php">Eliminar</a></li>
  <li><a class="active" href="usuario_reporte.php">reporte</a></li>
  <li><a class="active" onclick="cerrar()" >cerrar sesion</a></li>

</ul>

<script>

  function cerrar(){

    var variable="<? echo cerrar() ?>";
					document.write(variable);
					window.location="usuario_login.php";
				}

</script>

<div id="map"></div>
<script src="./../js/script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
    
</body>
<footer>
  <h6>&copy; NO a la copia de esta API</h6>
</footer>
</html>