<?php
# Importar modelo de abstracción de base de datos

require_once('../core/db_abstract_model.php');

class Usuario extends DBAbstractModel {
############################### PROPIEDADES ################################
    public $nombre;
    public $apellido;
    public $email;
    private $clave;
    protected $id;

    ################################# MÉTODOS ################################## # Traer datos de un usuario
    public function get($user_email = '') {
        if ($user_email != '') {
            $this->query = "SELECT id, nombre, apellido, email, clave
            FROM usuarios
            WHERE email = '$user_email'
            ";

            $this->get_results_from_query();

        }

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
    }

    # Crear un nuevo usuario
    public function set($user_data = array())
    {
     
        $json = json_encode (
            array(
                'nombre' => $user_data['nombre'],
                'contrasena' => $user_data['contrasena'],
                'correo' => $user_data['correo'],
                'sexo' => $user_data['sexo'],
                'fechaNacimiento' => $user_data['fechaNacimiento']
            )
         );

         echo $json;
         $opciones = array ('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json; charset=utf8',
                'content' => $json
            )
            );

        $url = "http://localhost/api.peopleapp.com/v1/usuarios/insertar";


        $context=stream_context_create($opciones);
        $data = file_get_contents($url,false,$context);
        $mensaje = json_decode($data);
        echo $mensaje->datos;
    }
    # Modificar un usuario
    public function edit($user_data = array())
    {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "UPDATE usuarios
            SET nombre='$nombre',
                apellido='$apellido'
            WHERE email = '$email'
            ";
        $this->execute_single_query();
        $this->mensaje = 'Usuario modificado';
    }

    # Eliminar un usuario
    public function delete($user_email = ''){
        $this->query = "
                DELETE FROM     usuarios
                WHERE           email = '$user_email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'Usuario eliminado';
    }

    # Método constructor
    function __construct()
    {
        $this->db_name = 'mvc';
    }

    # Método destructor del objeto
    function __destruct()
    {
        //unset($this);
    }
}
?>