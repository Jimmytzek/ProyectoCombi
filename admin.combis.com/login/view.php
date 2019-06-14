<?php
$diccionario = array(
    'subtitle' => array(
        VIEW_SET_LOGIN => 'Crear una nueva combi',
        VIEW_GET_LOGIN => 'Buscar combi',
        VIEW_DELETE_LOGIN => 'Eliminar una combi',
        VIEW_EDIT_LOGIN => 'Modificar combi'
    ),
    'links_menu' => array(
        'VIEW_SET_LOGIN' => MODULO_LOGIN . VIEW_SET_LOGIN . '/',
        'VIEW_GET_LOGIN' => MODULO_LOGIN . VIEW_GET_LOGIN . '/',
        'VIEW_EDIT_LOGIN' => MODULO_LOGIN . VIEW_EDIT_LOGIN . '/',
        'VIEW_DELETE_LOGIN' => MODULO_LOGIN . VIEW_DELETE_LOGIN . '/'
    ),
    'form_actions' => array(
        'SET' => '/mvc/poo/' . MODULO_LOGIN . SET_LOGIN . '/',
        'GET' => '/mvc/poo/' . MODULO_LOGIN . GET_LOGIN . '/',
        'DELETE' => '/mvc/poo/' . MODULO_LOGIN . DELETE_LOGIN . '/',
        'EDIT' => '/mvc/poo/' . MODULO_LOGIN . EDIT_LOGIN . '/'
    )
);
function get_template($form = 'get')
{
    $file = '../site_media/html/login/login_' . $form . '.html';
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
        array_key_exists('nombre', $data) &&
        array_key_exists('apellido', $data) &&
        $vista == VIEW_EDIT_USER
    ) {
        $mensaje = 'Editar usuario ' . $data['nombre'] . ' ' . $data['apellido'];
    } else {
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Introduzca sus datos para iniciar sesión';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}
?> 