<?php
$diccionario = array(
    'subtitle' => array(
        VIEW_SET_USER => 'Crear un nuevo usuario',
        VIEW_GET_USER => 'Buscar usuario',
        VIEW_DELETE_USER => 'Eliminar un usuario',
        VIEW_EDIT_USER => 'Modificar usuario',
        VIEW_REPORT_USER => 'Obtener reporte',
        VIEW_LOGOUT_USER => 'Cerrar sesión'
    ),
    'links_menu' => array(
        'VIEW_SET_USER' => MODULO . VIEW_SET_USER . '/',
        'VIEW_GET_USER' => MODULO . VIEW_GET_USER . '/',
        'VIEW_EDIT_USER' => MODULO . VIEW_EDIT_USER . '/',
        'VIEW_DELETE_USER' => MODULO . VIEW_DELETE_USER . '/',
        'VIEW_REPORT_USER' => MODULO . VIEW_REPORT_USER . '/',
        'VIEW_LOGOUT_USER' => MODULO . VIEW_LOGOUT_USER . '/',
    ),
    'form_actions' => array(
        'SET' => '/mvc/admin.combis.com/' . MODULO . SET_USER . '/',
        'GET' => '/mvc/admin.combis.com/' . MODULO . GET_USER . '/',
        'DELETE' => '/mvc/admin.combis.com/' . MODULO . DELETE_USER . '/',
        'EDIT' => '/mvc/admin.combis.com/' . MODULO . EDIT_USER . '/',
        'REPORT' => '/mvc/admin.combis.com/' . MODULO . REPORT_USER . '/',
        'LOGOUT' => '/mvc/admin.combis.com/' . MODULO . LOGOUT_USER . '/'
    )
);
function get_template($form = 'get')
{
    $file = '../site_media/html/usuarios/usuario_' . $form . '.html';
    $template = file_get_contents($file);
    return $template;
}
function render_dinamic_data($html, $data)
{
    foreach ($data as $clave => $valor) {
        $html = str_replace('{' . $clave . '}', $valor, $html);
    }
    return $html;
}
function retornar_vista($vista, $data = array())
{
    global $diccionario;
    $html = get_template('template');
    $html = str_replace(
        '{subtitulo}',
        $diccionario['subtitle'][$vista],
        $html
    );
    $html = str_replace('{formulario}', get_template($vista), $html);
    $html = render_dinamic_data($html, $diccionario['form_actions']);
    $html = render_dinamic_data($html, $diccionario['links_menu']);
    $html = render_dinamic_data($html, $data);
    // render {mensaje}
    if (
        array_key_exists('Nombre', $data) &&
        array_key_exists('Id', $data) &&
        $vista == VIEW_EDIT_USER
    ) {
        $mensaje = 'Editar usuario "' . $data['Nombre'] . ' ' . $data['PrimerApellido']. '"';
    } else if( $vista == VIEW_REPORT_USER){
        $mensaje = 'Reporte';
    } else if ( $vista == VIEW_GET_USER ){
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Introduzca el email para buscar al usuario';
        }
    }else{
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Datos del usuario:';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}
?> 