<?php
session_start();
require_once('constants.php');
require_once('../usuarios/model.php');
require_once('view.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
function handler()
{
    $event = VIEW_GET_LOGIN;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_LOGIN, GET_LOGIN, DELETE_LOGIN, EDIT_LOGIN,
        VIEW_SET_LOGIN, VIEW_GET_LOGIN, VIEW_DELETE_LOGIN,
        VIEW_EDIT_LOGIN, VIEW_FORGOT_LOGIN, FORGOT_LOGIN
    );
    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO_LOGIN . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }
    $user_data = helper_user_data();
    $usuario = set_obj();
    switch ($event) {
        case SET_LOGIN:
            $res = $usuario->login(json_encode($user_data));
            $p = xml_parser_create();
            xml_parse_into_struct($p, $res, $vals, $in);
            xml_parser_free($p);
            // Compara el estado de la respuesta para saber si los datos fueron correctos
            if($vals[1]['value'] == 1){
                $data = array(
                    'Nombre' => $vals[3]['value'],
                    'PrimerApellido' => $vals[4]['value'],
                    'SegundoApellido' => $vals[5]['value'],
                    'FechaNacimiento' => $vals[7]['value'],
                    'Correo' => $vals[6]['value'],
                    'Localidad' => $vals[9]['value'],
                    'Estado' => $vals[8]['value'],
                    'Colonia' => $vals[10]['value'],
                    'NumeroDomicilio' => $vals[12]['value'],
                    'Calle' => $vals[11]['value'],
                    'NumeroAfiliado' => $vals[13]['value'],
                    'ClaveApi' => $vals[14]['value'],
                );
                session_start();
                $_SESSION['Usuario'] = $data;
                header('Location: http://localhost/mvc/admin.combis.com/Usuarios/agregar');
            }else{
                retornar_vista(VIEW_GET_LOGIN, array( 'Respuesta' => 'Datos incorrectos'));
            }
            break;
        case GET_LOGIN:
            $usuario->get($user_data);
            retornar_vista(VIEW_GET_LOGIN, array());
            break;
        case FORGOT_LOGIN:
            if(!isset($user_data['Correo'])){
                retornar_vista(VIEW_FORGOT_LOGIN, array());   
            }else{
                sendMail();
                $msg = sendMail();
                echo '<script>alert("'. $msg .'");</script>';
                retornar_vista(VIEW_GET_LOGIN);
            }
            break;
        default:
            retornar_vista($event);
    }
}
function set_obj()
{
    $obj = new Usuario();
    return $obj;
}
function helper_user_data()
{
    $user_data = array();
    if ($_POST) {
        if (array_key_exists('Correo', $_POST)) {
            $user_data['Correo'] = $_POST['Correo'];
        }
        if (array_key_exists('Contrasena', $_POST)) {
            $user_data['Contrasena'] = $_POST['Contrasena'];
        }
    } else if ($_GET) {
        if (array_key_exists('email', $_GET)) {
            $user_data = $_GET['email'];
        }
    }
    return $user_data;
}
function sendMail(){

    require 'PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'user@example.com';                 // SMTP username
    $mail->Password = 'secret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

    $mail->From = 'from@example.com';
    $mail->FromName = 'Mailer';
    $mail->addAddress('charly19.cn@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

if(isset($_SESSION['Usuario'])){
    header('Location: http://localhost/mvc/admin.combis.com/usuarios');
}else{
    handler();
}
?>