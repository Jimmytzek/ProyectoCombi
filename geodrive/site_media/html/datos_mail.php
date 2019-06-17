 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Formulario</title> <!-- Aquí va el título de la página -->

</head>

<body>


<?php

$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Mensaje = $_POST['Mensaje'];

if ($Nombre=='' || $Email=='' || $Mensaje==''){ // Si falta un dato en el formulario mandara una alerta al usuario.

echo "<script>alert('Los campos marcados con * son obligatorios');location.href ='javascript:history.back()';</script>";

}else{


    require("archivosformulario/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
    $mail = new PHPMailer();

    $mail->From     = $Email;
    $mail->FromName = $Nombre; 
    $mail->AddAddress($Email); // Dirección a la que llegaran los mensajes.

// Aquí van los datos que apareceran en el correo que reciba

    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Contacto"; // Asunto del mensaje.
    $mail->Body     =  "Nombre: $Nombre \n<br />". // Nombre del usuario
    "Email: $Email \n<br />".    // Email del usuario
    "Mensaje: $Mensaje \n<br />"; // Mensaje del usuario

// Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...

    $mail->IsSMTP(); 
    $mail->Host = "ssl://smtp.gmail.com:465";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP
    $mail->SMTPAuth = true; 
    $mail->Username = "felipecox01@gmail.com";  // Correo Electrónico
    $mail->Password = "todos2002"; // Contraseña del correo

    if ($mail->Send())
    echo "<script>alert('Mensaje Enviado');location.href ='javascript:history.back()';</script>";
   
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>
