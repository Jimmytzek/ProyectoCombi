<?php
require_once('constants.php');
require_once('model.php');
require_once('view.php');
function handler()
{
    $event = VIEW_GET_USER;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_USER, GET_USER, DELETE_USER, EDIT_USER,
        VIEW_SET_USER, VIEW_GET_USER, VIEW_DELETE_USER,
        VIEW_EDIT_USER, VIEW_REPORT_USER
    );
    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }
    $user_data = helper_user_data();
    $usuario = set_obj();
    switch ($event) {
        case SET_USER:
            $res = $usuario->insert(json_encode($user_data));
            $data = array('mensaje' => $res);
            retornar_vista(VIEW_SET_USER, $data);
            break;
        case GET_USER:
            $res = $usuario->getByEmail(json_encode($user_data));
            $p = xml_parser_create();
            xml_parse_into_struct($p, $res, $vals, $in);
            xml_parser_free($p);
            $data = array(
                'Id' => $vals[1]['value'],
                'Nombre' => $vals[2]['value'],
                'PrimerApellido' => $vals[3]['value'],
                'SegundoApellido' => $vals[4]['value'],
                'FechaNacimiento' => $vals[6]['value'],
                'Correo' => $vals[5]['value'],
                'Contrasena' => $vals[]['value'],
                'Localidad' => $vals[1]['value'],
                'Estado' => $vals[1]['value'],
                'Colonia' => $vals[1]['value'],
                'NumeroDomicilio' => $vals[1]['value'],
                'Calle' => $vals[1]['value'],
                'NumeroAfiliado' => $vals[1]['value']
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
function set_obj()
{
    $obj = new Usuario();
    return $obj;
}
function helper_user_data()
{
    $user_data = array();
    if ($_POST) {
        if (array_key_exists('Id', $_POST)) {
            $user_data['Id'] = $_POST['Id'];
        }
        if (array_key_exists('Nombre', $_POST)) {
            $user_data['Nombre'] = $_POST['Nombre'];
        }
        if (array_key_exists('PrimerApellido', $_POST)) {
            $user_data['PrimerApellido'] = $_POST['PrimerApellido'];
        }
        if (array_key_exists('SegundoApellido', $_POST)) {
            $user_data['SegundoApellido'] = $_POST['SegundoApellido'];
        }
        if (array_key_exists('FechaNacimiento', $_POST)) {
            $user_data['FechaNacimiento'] = $_POST['FechaNacimiento'];
        }
        if (array_key_exists('Estado', $_POST)) {
            $user_data['Estado'] = $_POST['Estado'];
        }
        if (array_key_exists('Localidad', $_POST)) {
            $user_data['Localidad'] = $_POST['Localidad'];
        }
        if (array_key_exists('Colonia', $_POST)) {
            $user_data['Colonia'] = $_POST['Colonia'];
        }
        if (array_key_exists('Calle', $_POST)) {
            $user_data['Calle'] = $_POST['Calle'];
        }
        if (array_key_exists('NumeroDomicilio', $_POST)) {
            $user_data['NumeroDomicilio'] = $_POST['NumeroDomicilio'];
        }
        if (array_key_exists('NumeroAfiliado', $_POST)) {
            $user_data['NumeroAfiliado'] = $_POST['NumeroAfiliado'];
        }
        if (array_key_exists('Correo', $_POST)) {
            $user_data['Correo'] = $_POST['Correo'];
        }
        if (array_key_exists('Contrasena', $_POST)) {
            $user_data['Contrasena'] = $_POST['Contrasena'];
        }
    } else if ($_GET) {
        if (array_key_exists('Correo', $_GET)) {
            $user_data['Correo'] = $_GET['Correo'];
        }
    }
    return $user_data;
}
handler();
?>