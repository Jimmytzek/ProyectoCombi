<?php
require_once('constants.php');
require_once('model.php');
require_once('view.php');
function handler()
{
    $event = VIEW_GET_COMBI;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_COMBI, GET_COMBI, DELETE_COMBI, EDIT_COMBI,
        VIEW_SET_COMBI, VIEW_GET_COMBI, VIEW_DELETE_COMBI,
        VIEW_EDIT_COMBI
    );
    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO_COMBI . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }
    $user_data = helper_user_data();
    $usuario = set_obj();
    switch ($event) {
        case SET_COMBI:
            $usuario->set($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_SET_COMBI, $data);
            break;
        case GET_COMBI:
            $usuario->get($user_data);
            $data = array(
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email
            );
            retornar_vista(VIEW_EDIT_COMBI, $data);
            break;
        case DELETE_COMBI:
            $usuario->delete($user_data['email']);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_DELETE_COMBI, $data);
            break;
        case EDIT_COMBI:
            $usuario->edit($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_GET_COMBI, $data);
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
        if (array_key_exists('nombre', $_POST)) {
            $user_data['nombre'] = $_POST['nombre'];
        }
        if (array_key_exists('apellido', $_POST)) {
            $user_data['apellido'] = $_POST['apellido'];
        }
        if (array_key_exists('email', $_POST)) {
            $user_data['email'] = $_POST['email'];
        }
        if (array_key_exists('clave', $_POST)) {
            $user_data['clave'] = $_POST['clave'];
        }
    } else if ($_GET) {
        if (array_key_exists('email', $_GET)) {
            $user_data = $_GET['email'];
        }
    }
    return $user_data;
}
if(isset($_SESSION['Usuario'])){
    handler();
}else{
    header('Location: http://localhost/mvc/admin.combis.com/login');
}
?>