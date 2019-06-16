<?php

include_once 'datos/ConexionBD.php';

class usuarios
{
    // Datos de la tabla "usuario"
    const NOMBRE_TABLA = "usuario";
    // Campos de la tabla
    const ID_USUARIO = "ID_Usuario";
    const TIPO_USUARIO = "Tipo_Usuario";
    const NOMBRE = "Nombre";
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

    const ESTADO_CREACION_EXITOSA = 1;
    const ESTADO_CREACION_FALLIDA = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_AUSENCIA_CLAVE_API = 4;
    const ESTADO_CLAVE_NO_AUTORIZADA = 5;
    const ESTADO_URL_INCORRECTA = 6;
    const ESTADO_FALLA_DESCONOCIDA = 7;
    const ESTADO_PARAMETROS_INCORRECTOS = 8;

    public static function post($peticion)
    {
        if ($peticion[0] == 'registro') {
            return self::registrar();
        } else if ($peticion[0] == 'login') {
            return self::loguear();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function put($peticion){
        if($peticion[0] == 'update'){
            return self::actualizar();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function delete($peticion){
        if($peticion[0] == 'borrar'){
            return self::borrar();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function get($peticion){
        if($peticion[0] == 'verUsuarios'){
            return self::obtenerUsuarios();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }


    private function obtenerUsuarios()
    {
        $comando = "SELECT *" .
            " FROM " . self::NOMBRE_TABLA ;

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        if ($sentencia->execute()) {
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } else
            return null;
    }


    /**
     * Crea un nuevo usuario en la base de datos
     */
    private function registrar()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::crear($usuario);

        switch ($resultado) {
            case self::ESTADO_CREACION_EXITOSA:
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => utf8_encode("Registro con éxito!")
                    ];
                break;
            case self::ESTADO_CREACION_FALLIDA:
                throw new ExcepcionApi(self::ESTADO_CREACION_FALLIDA, "Ha ocurrido un error");
                break;
            default:
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA, "Falla desconocida", 400);
        }
    }

    /**
     * Actualiza un registro de la tabla Usuarios
     */
    private function actualizar()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::update($usuario);

        switch ($resultado) {
            case self::ESTADO_CREACION_EXITOSA:
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => utf8_encode("Se ha actualizado el usuario")
                    ];
                break;
            case self::ESTADO_CREACION_FALLIDA:
                throw new ExcepcionApi(self::ESTADO_CREACION_FALLIDA, "Ha ocurrido un error");
                break;
            default:
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA, "Falla desconocida", 400);
        }
    }

    /**
     * Borra un registro de la tabla Usuarios
     */
    private function borrar()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::deleteUser($usuario);

        switch ($resultado) {
            case self::ESTADO_CREACION_EXITOSA:
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => utf8_encode("Se ha borrado el usuario")
                    ];
                break;
            case self::ESTADO_CREACION_FALLIDA:
                throw new ExcepcionApi(self::ESTADO_CREACION_FALLIDA, "Ha ocurrido un error");
                break;
            default:
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA, "Falla desconocida", 400);
        }
    }

    /**
     * Crea un nuevo usuario en la tabla "usuario"
     * @param mixed $datosUsuario columnas del registro
     * @return int codigo para determinar si la inserción fue exitosa
     */
    private function crear($datosUsuario)
    {
        $nombre = $datosUsuario->Nombre;
        $apellido1 = $datosUsuario->Primer_Apellido;
        $apellido2 = $datosUsuario->Segundo_Apellido;
        $contrasena = $datosUsuario->Contrasena;
        $contrasenaEncriptada = self::encriptarContrasena($contrasena);
        $correo = $datosUsuario->Correo;
        $claveApi = self::generarClaveApi();
        $fechaNac = $datosUsuario->Fecha_Nacimiento;
        $estado = $datosUsuario->Estado;
        $localidad = $datosUsuario->Localidad;
        $colonia = $datosUsuario->Colonia;
        $calle = $datosUsuario->Calle;
        $numCasa = $datosUsuario->Numero_Domicilio;

        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::NOMBRE . "," .
                self::PRIMER_APELLIDO . "," .
                self::SEGUNDO_APELLIDO . "," .
                self::CORREO . "," .
                self::CONTRASENA . "," .
                self::FECHA_NACIMIENTO . "," .
                self::ESTADO . "," .
                self::LOCALIDAD . "," .
                self::COLONIA . "," .
                self::CALLE . "," .
                self::NUMERO_DOMICILIO . "," . 
                self::CLAVE_API . ")" .
                " VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $apellido1);
            $sentencia->bindParam(3, $apellido2);
            $sentencia->bindParam(4, $correo);
            $sentencia->bindParam(5, $contrasenaEncriptada);
            $sentencia->bindParam(6, $fechaNac);
            $sentencia->bindParam(7, $estado);
            $sentencia->bindParam(8, $localidad);
            $sentencia->bindParam(9, $colonia);
            $sentencia->bindParam(10, $calle);
            $sentencia->bindParam(11, $numCasa); 
            $sentencia->bindParam(12, $claveApi);

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

    /**
     * Protege la contrase�a con un algoritmo de encriptado
     * @param $contrasenaPlana
     * @return bool|null|string
     */
    private function encriptarContrasena($contrasenaPlana)
    {
        if ($contrasenaPlana)
            return password_hash($contrasenaPlana, PASSWORD_DEFAULT);
        else return null;
    }

    private function generarClaveApi()
    {
        return md5(microtime() . rand());
    }

    private function loguear()
    {
        $respuesta = array();

        $body = file_get_contents('php://input');
        $usuario = json_decode($body);
        $correo = $usuario->Correo;
        $contrasena = $usuario->Contrasena;


        if (self::autenticar($correo, $contrasena)) {
            $usuarioBD = self::obtenerUsuarioPorCorreo($correo);

            if ($usuarioBD != NULL) {
                http_response_code(200);
                $respuesta["Nombre"] = $usuarioBD["Nombre"];
                $respuesta["PrimerApellido"] = $usuarioBD["Primer_Apellido"];
                $respuesta["SegundoApellido"] = $usuarioBD["Segundo_Apellido"];
                $respuesta["Correo"] = $usuarioBD["Correo"];
                $respuesta["FechaNacimiento"] = $usuarioBD["Fecha_Nacimiento"];
                $respuesta["Estado"] = $usuarioBD["Estado"];
                $respuesta["Localidad"] = $usuarioBD["Localidad"];
                $respuesta["Colonia"] = $usuarioBD["Colonia"];
                $respuesta["Calle"] = $usuarioBD["Calle"];
                $respuesta["NumeroDomicilio"] = $usuarioBD["Numero_Domicilio"];
                $respuesta["NumeroAfiliado"] = $usuarioBD["Numero_Afiliado"];
                $respuesta["ClaveApi"] = $usuarioBD["claveApi"];
                return ["estado" => 1, "usuario" => $respuesta];
            } else {
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA,
                    "Ha ocurrido un error");
            }
        } else {
            throw new ExcepcionApi(self::ESTADO_PARAMETROS_INCORRECTOS,
                utf8_encode("Correo o contraseña inválidos"));
        }
    }

    private function autenticar($correo, $contrasena)
    {
        $comando = "SELECT Contrasena FROM " . self::NOMBRE_TABLA .
            " WHERE " . self::CORREO . "=?";

        try {

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            $sentencia->bindParam(1, $correo);

            $sentencia->execute();

            if ($sentencia) {
                $resultado = $sentencia->fetch();
                if (self::validarContrasena($contrasena, $resultado['Contrasena'])) {
                    return true;
                } else return false;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    private function validarContrasena($contrasenaPlana, $contrasenaHash)
    {
        return password_verify($contrasenaPlana, $contrasenaHash);
    }


    private function obtenerUsuarioPorCorreo($correo)
    {
        $comando = "SELECT *" .
            // self::NOMBRE . "," .
            // self::CONTRASENA . "," .
            // self::CORREO . "," .
            // self::CLAVE_API .
            " FROM " . self::NOMBRE_TABLA .
            " WHERE " . self::CORREO . "=?";

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        $sentencia->bindParam(1, $correo);

        if ($sentencia->execute())
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        else
            return null;
    }

    /**
     * Otorga los permisos a un usuario para que acceda a los recursos
     * @return null o el id del usuario autorizado
     * @throws Exception
     */
    public static function autorizar()
    {
        $cabeceras = apache_request_headers();

        if (isset($cabeceras["authorization"])) {

            $claveApi = $cabeceras["authorization"];

            if (usuarios::validarClaveApi($claveApi)) {
                return usuarios::obtenerIdUsuario($claveApi);
            } else {
                throw new ExcepcionApi(
                    self::ESTADO_CLAVE_NO_AUTORIZADA, "Clave de API no autorizada", 401);
            }

        } else {
            throw new ExcepcionApi(
                self::ESTADO_AUSENCIA_CLAVE_API,
                utf8_encode("Se requiere Clave del API para autenticaci�n"));
        }
    }

    /**
     * Comprueba la existencia de la clave para la api
     * @param $claveApi
     * @return bool true si existe o false en caso contrario
     */
    private function validarClaveApi($claveApi)
    {
        $comando = "SELECT COUNT(" . self::ID_USUARIO . ")" .
            " FROM " . self::NOMBRE_TABLA .
            " WHERE " . self::CLAVE_API . "=?";

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        $sentencia->bindParam(1, $claveApi);

        $sentencia->execute();

        return $sentencia->fetchColumn(0) > 0;
    }

    /**
     * Obtiene el valor de la columna "idUsuario" basado en la clave de api
     * @param $claveApi
     * @return null si este no fue encontrado
     */
    private function obtenerIdUsuario($claveApi)
    {
        $comando = "SELECT " . self::ID_USUARIO .
            " FROM " . self::NOMBRE_TABLA .
            " WHERE " . self::CLAVE_API . "=?";

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        $sentencia->bindParam(1, $claveApi);

        if ($sentencia->execute()) {
            $resultado = $sentencia->fetch();
            return $resultado['idUsuario'];
        } else
            return null;
    }

    private function update($datosUsuario){
        
        $nombre = $datosUsuario->Nombre;
        $apellido1 = $datosUsuario->Primer_Apellido;
        $apellido2 = $datosUsuario->Segundo_Apellido; 
        $fechaNac = $datosUsuario->Fecha_Nacimiento;
        $estado = $datosUsuario->Estado;
        $localidad = $datosUsuario->Localidad;
        $colonia = $datosUsuario->Colonia;
        $calle = $datosUsuario->Calle;
        $numCasa = $datosUsuario->Numero_Domicilio;
        $contrasena = $datosUsuario->Contrasena;
        $contrasenaEncriptada = self::encriptarContrasena($contrasena);
        $correo = $datosUsuario->Correo; 
        $id = $datosUsuario->ID_Usuario;

        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "UPDATE " . self::NOMBRE_TABLA . " SET " .
                self::NOMBRE . "=?," .
                self::PRIMER_APELLIDO . "=?," .
                self::SEGUNDO_APELLIDO . "=?," .
                self::FECHA_NACIMIENTO . "=?," .
                self::ESTADO . "=?," .
                self::LOCALIDAD . "=?," .
                self::COLONIA . "=?," .
                self::CALLE . "=?," .
                self::NUMERO_DOMICILIO . "=?," .
                self::CORREO . "=?," .
                self::CONTRASENA . "=?  WHERE " . 
                self::ID_USUARIO . " = ? ";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $apellido1);
            $sentencia->bindParam(3, $apellido2); 
            $sentencia->bindParam(4, $fechaNac);
            $sentencia->bindParam(5, $estado);
            $sentencia->bindParam(6, $localidad);
            $sentencia->bindParam(7, $colonia);
            $sentencia->bindParam(8, $calle);
            $sentencia->bindParam(9, $numCasa);
            $sentencia->bindParam(10, $correo);
            $sentencia->bindParam(11, $contrasenaEncriptada); 
            $sentencia->bindParam(12, $id);

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

    private function deleteUser($datosUsuario){
        $userId = $datosUsuario->ID_Usuario;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "DELETE FROM " . self::NOMBRE_TABLA . " WHERE " . 
                self::ID_USUARIO . " = ?";

            $sentencia = $pdo->prepare($comando);
            $sentencia->bindParam(1, $userId);

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
}