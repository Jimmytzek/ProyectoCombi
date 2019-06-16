<?php
$diccionario = array(
    'subtitle' => array(
        VIEW_SET_COMBI => 'Crear una nueva combi',
        VIEW_GET_COMBI => 'Buscar combi',
        VIEW_DELETE_COMBI => 'Eliminar una combi',
        VIEW_EDIT_COMBI => 'Modificar combi'
    ),
    'links_menu' => array(
        'VIEW_SET_COMBI' => MODULO_COMBI . VIEW_SET_COMBI . '/',
        'VIEW_GET_COMBI' => MODULO_COMBI . VIEW_GET_COMBI . '/',
        'VIEW_EDIT_COMBI' => MODULO_COMBI . VIEW_EDIT_COMBI . '/',
        'VIEW_DELETE_COMBI' => MODULO_COMBI . VIEW_DELETE_COMBI . '/'
    ),
    'form_actions' => array(
        'SET' => '/mvc/admin.combis.com/combis/' . MODULO_COMBI . SET_COMBI . '/',
        'GET' => '/mvc/admin.combis.com/combis/' . MODULO_COMBI . GET_COMBI . '/',
        'DELETE' => '/mvc/admin.combis.com/combis/' . MODULO_COMBI . DELETE_COMBI . '/',
        'EDIT' => '/mvc/admin.combis.com/' . MODULO_COMBI . EDIT_COMBI . '/'
    )
);
function get_template($form = 'get')
{
    $file = '../site_media/html/combis/combis_' . $form . '.html';
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
            $mensaje = 'Datos de la combi:';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}
?> 