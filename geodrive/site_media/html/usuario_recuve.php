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

<h1 class="center" >Recuperar Contraseña</h1>
<br>

<div class="container">

<form action="" class="form-horizontal">

<h3>
Se requiere el correo con el que ha registrado para poder proporcionar la contraseña.
</h3>

<br>

    <div class="form-group has-warning has-feedback" data-validate = "Valid email is required: ex@abc.xyz">
        <label class="col-sm-2 control-label">Correo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  id="Correo" placeholder="Correo" required>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
        </div>
    </div>

    <div class="container-login100-form-btn">
        <button type="button" class="btn btn-primary" onclick="registro()" >Registrar</button>
    </div>
</form>



    
</body>

<footer>
</footer>
</html>