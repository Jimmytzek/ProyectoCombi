<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 
    <title>Document</title> 

</head>

<?php
 
session_start();

if (!isset($_SESSION['sesion'])) {
    header('Location: usuario_login.php');
    exit();
}

 
include 'actu.php'; ?>

<body class="p-3 mb-2 bg-light text-dark" 
>
 
<h1 class="text-center"> Actualizar Usuario </h1>


<table class="table" id="table">
  <thead class="thead-dark">
      
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Primer Apellido</th>
      <th scope="col">Segundo Apellido</th>
      <th scope="col">Fecha nacimiento</th>
      <th scope="col">Estado</th>
      <th scope="col">Localidad</th>
      <th scope="col">Colonia</th>
      <th scope="col">Calle</th>
      <th scope="col">Numero de domicilio</th>
      <th scope="col">Correo</th>  
    </tr> 
  </thead>
</table>

<div class="container">
  <form id="table">

  <div class="form-group row has-success">
      <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-success" name="nombre" id="nombre"  value=""> 
      </div>
    </div>
    
    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Primer Apellido</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="PA" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Segundo Apellido</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="SA" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-warning" id="fecha" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Estado</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="estado" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Localidad</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="localidad" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Colonia</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="colonia" value="" > 
      </div>
    </div> 


  <div class="form-group row has-success">
      <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Calle</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-success" id="calle" value="" > 
      </div>
    </div>
    
    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Numero de domicilio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="nDomicilio" value="" > 
      </div>
    </div> 

    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Correo</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" id="correo" value=""  > 
      </div>
    </div> 

    <div class="form-group row has-success">
      <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Contraseña</label>
      <div class="col-sm-10">
        <input type="password" class="form-control form-control-success" id="pass" value=""> 
      </div>
    </div>
    <!-- <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-warning" name="id" id="id" value=""  > 
      </div>
    </div>  -->
 
    <div  class="container-login100-form-btn">
    <button type="button" class="btn btn-info btn-block my-4" onclick="registro()" >Registrar</button>
    </div>
 

  

     
    
  </form> 
</div>








    

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

            <script src="./../assets/js/jquery.min.js"></script>
			<script src="./../assets/js/jquery.scrollex.min.js"></script>
			<script src="./../assets/js/jquery.scrolly.min.js"></script>
			<script src="./../assets/js/skel.min.js"></script>  
			<script src="./../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
             <script src="./../assets/js/main.js"></script>
            <script src="p.js"></script>
</body>
</html>















