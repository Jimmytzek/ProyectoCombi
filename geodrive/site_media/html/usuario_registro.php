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

<h1 class="center">Registro de usuario</h1>
<br>

<div class="container">

    <form action="" class="form-horizontal">


    <div class="form-group has-warning has-feedback" data-validate = "es requerido">
        <label class="col-sm-2 control-label" >Nombre</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="Nombre" placeholder="nombre" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback" data-validate = "es requerido">
        <label class="col-sm-2 control-label" >Primer Apellido</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="PrimerApellido" placeholder="Primer Apellido" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Segundo Apellido</label>
        <div class="col-sm-10" >
            <input class="form-control" type="text" id="SegundoApellido" placeholder="Segundo Apellido">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Fecha de nacimiento</label>
        <div class="col-sm-10">
            <input type="date"  class="form-control" id="FechaNacimiento" placeholder="Fecha Nacimiento">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Estado</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="Estado" placeholder="Estado">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Localidad</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="Localidad" placeholder="Localidad">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Colonia</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="Colonia" placeholder="Colonia">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>       
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label" >Calle</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Calle" placeholder="Calle">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label">Numero domicilio</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="NumeroDomicilio" placeholder=" Numero Domicilio">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-warning has-feedback">
        <label class="col-sm-2 control-label">Numero afiliado</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="NumeroAfiliado" placeholder="Numero Afiliado">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

        <div class="form-group has-warning has-feedback" data-validate = "Valid email is required: ex@abc.xyz">
        <label class="col-sm-2 control-label">Correo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="Correo" placeholder="Correo" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

        <div class="form-group has-warning has-feedback" data-validate = "Password is required">   
        <label class="col-sm-2 control-label">Contraseña</label>
        <div class="col-sm-10">
            <input type="password" class="form-control"  id="Contrasena" placeholder="contrasena" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>


    <script>
function registro(){

var from= {
    Nombre: $('#Nombre').val(),
    PrimerApellido: $('#PrimerApellido').val(),
    SegundoApellido: $('#SegundoApellido').val(),
    FechaNacimiento: $('#FechaNacimiento').val(),
    Estado: $('#Estado').val(),
    Localidad: $('#Localidad').val(),
    Colonia: $('#Colonia').val(),
    Calle: $('#Calle').val(),
    NumeroDomicilio: $('#NumeroDomicilio').val(),
    NumeroAfiliado: $('#NumeroAfiliado').val(),
    Correo: $('#Correo').val(),
    Contrasena: $('#Contrasena').val()
};

var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				}
			};
			xhttp.open("POST", "http://192.168.1.67/api.combis.com/v1/usuarios/registro", true);
			xhttp.send(JSON.stringify(from));


}


</script>


    <div class="container-login100-form-btn">
    <button type="button" class="btn btn-primary" onclick="registro()" >Registrar</button>
    </div>

    </form>

</div>


<?php

	
	?>




</body>
</html>