<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
    .center{
        text-align: center;
    }
    </style>

	<link rel="stylesheet" type="text/css" href="./../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./../css/util.css">
<!--===============================================================================================-->
    
    <!--===============================================================================================-->	
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="../vendor/bootstrap/js/popper.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="../vendor/tilt/tilt.jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="../js/main.js"></script>
</head>
<body>


<?php

session_start();

if (!isset($_SESSION['sesion'])) {
    header('Location: usuario_login.php');
    exit();
}

?>

<h1 class="center">Registro de usuario</h1>
<br>

<div class="container">

    <form action="" class="form-horizontal">
    
        <div class="form-group has-warning has-feedback">   
        <label class="col-sm-2 control-label">ID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="id" placeholder="ID" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="container-login100-form-btn">
    <button type="button" class="btn btn-primary" onclick="del()" >borrar</button>
    </div>

    </form>

</div>

<br>


    <table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">correo</th>
    </tr>
  </thead>
    </table>


    <script>
function del(){

var from= {
    ID_Usuario: $('#id').val()
};

var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
                    alert('Usuario Eliminado');  
                    window.location="usuario_del.php";
				}
			};
			xhttp.open("DELETE", "http://localhost/api.combis.com/v1/usuarios/borrar", true);
			xhttp.send(JSON.stringify(from));


}


// $(document).ready(function() {
//         $('#refresh').click(function() {
//             // Recargo la página
//             location.reload();
//         });
//     });


</script>


<script>
    (function(){
        verCombis();
    })();
function verCombis(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText); 
                    var table = document.getElementById("table");

                    response.forEach(item=>{
                        var row = table.insertRow(1);

                        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);

                        // Add some text to the new cells:
                        cell1.innerHTML = item.ID_Usuario;
                        cell2.innerHTML = item.Nombre;
                        cell3.innerHTML = item.Correo;
                    });
				}
			};
			xhttp.open("GET", "http://localhost/api.combis.com/v1/usuarios/verUsuarios", true);
			xhttp.send();}
</script>


</body>
</html>