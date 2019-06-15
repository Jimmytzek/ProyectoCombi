<?php
$diccionario = array(
    'subtitle'=>array(
        VIEW_FORMULARIO_USER=>'Registro de usuario',
        VIEW_SET_USER=>'Crear un nuevo usuario',
        VIEW_GET_USER=>'Buscar usuario',
        VIEW_DELETE_USER=>'Eliminar un usuario',
        VIEW_EDIT_USER=>'Modificar usuario'
    ),

    'links_menu'=>array(
        'VIEW_SET_USER'=>MODULO.VIEW_SET_USER.'/',
        'VIEW_GET_USER'=>MODULO.VIEW_GET_USER.'/',
        'VIEW_EDIT_USER'=>MODULO.VIEW_EDIT_USER.'/',
        'VIEW_DELETE_USER'=>MODULO.VIEW_DELETE_USER.'/',
        'ADD_USER'=>MODULO.ADD_USER.'/'
    ),

    'form_actions'=>array(
        'SET'=>'/'.MODULO.SET_USER.'/',
        'GET'=>'/'.MODULO.GET_USER.'/',
        'DELETE'=>'/'.MODULO.DELETE_USER.'/',
        'EDIT'=>'/'.MODULO.EDIT_USER.'/',
        'ADD_USR'=>'/api.peopleapp.com/express/'.MODULO.ADD_USER.'/'
    )
);

    function get_template($form='get') {
        $file = '../site_media/html/usuario_'.$form.'.php';
        $template = file_get_contents($file);
        return $template;
    }

    function render_dinamic_data($html, $data) {
        foreach ($data as $clave=>$valor) {
            $html = str_replace('{'.$clave.'}', $valor, $html);
        }
        return $html;
    }

    function retornar_vista($vista, $data=array()) {
        global $diccionario;
        $html = get_template($vista);
        

        print $html;
    }
?>


