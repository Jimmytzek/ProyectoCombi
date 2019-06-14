<?php
require_once('constants.php');
require_once('model.php');
require_once('view.php');
function handler()
{
    $event = VIEW_GET_LOGIN;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_LOGIN, GET_LOGIN, DELETE_LOGIN, EDIT_LOGIN,
        VIEW_SET_LOGIN, VIEW_GET_LOGIN, VIEW_DELETE_LOGIN,
        VIEW_EDIT_LOGIN
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
            $usuario->set($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_SET_LOGIN, $data);
            break;
        case GET_LOGIN:
            $usuario->get($user_data);
            $data = array(
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email
            );
            retornar_vista(VIEW_EDIT_LOGIN, $data);
            break;
        case DELETE_LOGIN:
            $usuario->delete($user_data['email']);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_DELETE_LOGIN, $data);
            break;
        case EDIT_LOGIN:
            $usuario->edit($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_GET_LOGIN, $data);
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
handler();
?>