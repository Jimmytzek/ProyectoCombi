<?php
require_once('constants.php');
require_once('model.php');
require_once('view.php');

function handler()
{
    $event = VIEW_LOGIN_USER;
    $uri = $_SERVER['REQUEST_URI'];
    echo $uri."<br>";
    $peticiones = array(SET_USER, GET_USER, DELETE_USER, EDIT_USER,
        VIEW_SET_USER, VIEW_GET_USER, VIEW_DELETE_USER,
        VIEW_EDIT_USER,VIEW_LOGIN_USER,VIEW_FORMULARIO_USER,ADD_USER);
    
    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO . $peticion . '/';
        echo $uri_peticion."<br>";
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
            echo $event;
        }
    }

    $user_data = helper_user_data();
    $usuario = set_obj();

    switch ($event) {
        case ADD_USER:
            //cho var_dump($user_data);
            $resultado = $usuario->set($user_data);
            $data = array('mensaje' =>$resultado);
            retornar_vista(VIEW_FORMULARIO_USER);
        break;
        case VIEW_FORMULARIO_USER:
            echo VIEW_FORMULARIO_USER;
            $data = array('mensaje' => 'FORMULARIO REGISTRO');
            retornar_vista(VIEW_FORMULARIO_USER, $data);
            break;
        case SET_USER:
            $usuario->set($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_SET_USER, $data);
            break;
        case GET_USER:
            $usuario->get($user_data);
            $data = array(
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email
            );
            retornar_vista(VIEW_EDIT_USER, $data);
            break;
        case DELETE_USER:
            $usuario->delete($user_data['email']);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_DELETE_USER, $data);
            break;
        case EDIT_USER:
            $usuario->edit($user_data);
            $data = array('mensaje' => $usuario->mensaje);
            retornar_vista(VIEW_GET_USER, $data);
            break;
        default:
            retornar_vista($event);
    }
}
function set_obj() {
    $obj = new Usuario();
    return $obj;
}

function helper_user_data(){
    $user_data = array();
    if ($_POST) {
        if (array_key_exists('nombre', $_POST)) {
            $user_data['nombre'] = $_POST['nombre'];
        }
        if (array_key_exists('contrasena', $_POST)) {
            $user_data['contrasena'] = $_POST['contrasena'];
        }
        if (array_key_exists('correo', $_POST)) {
            $user_data['correo'] = $_POST['correo'];
        }
        if (array_key_exists('sexo', $_POST)) {
            $user_data['sexo'] = $_POST['sexo'];
        }

        if (array_key_exists('fechaNacimiento', $_POST)) {
            $user_data['fechaNacimiento'] = $_POST['fechaNacimiento'];
        }
    } 
    return $user_data;
}

handler();

?>