<?php
class usuarios
{
    // Datos de la tabla "usuario"
    const NOMBRE_TABLA = "usuario";
    const ID_USUARIO = "ID_Usuario";
    const TIPO_USUARIO = "Tipo_Usuario";
    const NOMBRE = "nombre";
    const PRIMER_APELLIDO = "Primer_Apellido";
    const SEGUNDO_APELLIDO = "Segundo_Apellido";
    const FECHA_NACIMIENTO = "Fecha_Nacimiento";
    const ESTADO = "Estado";
    const LOCALIDAD = "Localidad";
    const COLONIA = "Colonia";
    const CALLE = "Calle";
    const NUMERO_DOMICILIO = "Numero_Domicilio";
    const NUMERO_AFILIADO = "Numero_Afiliado";
    const CONTRASENA = "Contrasena";
    const CORREO = "Correo";
    const CLAVE_API = "claveApi";
    const ESTADO_CREACION_EXITOSA = "Creación exitosa";
    const ESTADO_URL_INCORRECTA = "Ruta incorrecta";
    const ESTADO_CREACION_FALLIDA = "Creación fallida";
    const ESTADO_FALLA_DESCONOCIDA = "Falla desconocida";
    const ESTADO_ERROR_BD = "Error de Base de Datos";
    
    public static function post($peticion) {
        if ($peticion[0] == 'registro') {
            return self::registrar();
        } else if ($peticion[0] == 'login') {
            return self::loguear();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }    
   
    private function registrar() {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);
        $resultado = self::crear($usuario);

        switch ($resultado) {
            case self::ESTADO_CREACION_EXITOSA:
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => utf8_encode("¡Registro con éxito!")
                    ];
                break;
            case self::ESTADO_CREACION_FALLIDA:
                throw new ExcepcionApi(self::ESTADO_CREACION_FALLIDA, "Ha ocurrido un error");
                break;
            default:
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA, "Falla desconocida", 400);
        }
    }

    private function crear($datosUsuario) {
        $nombre = $datosUsuario->Nombre;
        $apellido1 = $datosUsuario->PrimerApellido;
        $apellido2 = $datosUsuario->SegundoApellido;
        $contrasena = $datosUsuario->Contrasena;
        $contrasenaEncriptada = self::encriptarContrasena($contrasena);
        $correo = $datosUsuario->Correo;
        $claveApi = self::generarClaveApi();
        $fechaNac = $datosUsuario->FechaNacimiento;
        $estado = $datosUsuario->Estado;
        $localidad = $datosUsuario->Localidad;
        $colonia = $datosUsuario->Colonia;
        $calle = $datosUsuario->Calle;
        $numCasa = $datosUsuario->NumeroDomicilio;
        $numAfiliado = $datosUsuario->NumeroAfiliado;

        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::NOMBRE . "," .
                self::CONTRASENA . "," .
                self::CLAVE_API . "," .
                self::CORREO . ")" .
                " VALUES(?,?,?,?)";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $contrasenaEncriptada);
            $sentencia->bindParam(3, $claveApi);
            $sentencia->bindParam(4, $correo);

            $resultado = $sentencia->execute();

            if ($resultado) {
                return self::ESTADO_CREACION_EXITOSA;
            } else {
                return self::ESTADO_CREACION_FALLIDA;
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    private function encriptarContrasena($contrasenaPlana) {
        if ($contrasenaPlana)
            return password_hash($contrasenaPlana, PASSWORD_DEFAULT);
        else return null;
    }

    private function generarClaveApi() {
        return md5(microtime().rand());
    }

}

?>