<?php

include_once 'datos/ConexionBD.php';

class combis
{
    // Datos de la tabla "combi"
    const NOMBRE_TABLA = "combi";
    // Campos de la tabla
    const ID_COMBI = "ID_Combi";
    const NUMERO_COMBI = "Numero_Combi";
    const PLACAS = "Placas";
    

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
        if ($peticion[0] == 'registrarCombis') {
            return self::regcombi();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function put($peticion){
        if($peticion[0] == 'actualizarCombi'){
            return self::actuCombi();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function delete($peticion){
        if($peticion[0] == 'borrarCombi'){
            return self::delCombi();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function get($peticion){
        if($peticion[0] == 'verCombis'){
            return self::obtenerCombis();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    /**
     * Crea una nueva combi en la base de datos
     */
    private function regcombi()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::crearC($usuario);

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
    private function actuCombi()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::updateC($usuario);

        switch ($resultado) {
            case self::ESTADO_CREACION_EXITOSA:
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => utf8_encode("Se ha actualizado")
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
    private function delCombi()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::deleteUserC($usuario);

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
     * Crea una nueva combi en la tabla "combi"
     */
    private function crearC($datosCombi)
    {
        $numeroCombi = $datosCombi->Numero_Combi;
        $placas = $datosCombi->Placas;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::NUMERO_COMBI . "," .
                self::PLACAS . ")" .
                " VALUES(?,?)";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $numeroCombi);
            $sentencia->bindParam(2, $placas);

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

  
    private function obtenerCombis()
    {
        $comando = "SELECT *" .
            " FROM " . self::NOMBRE_TABLA ;

        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

        if ($sentencia->execute()) {
            $resultado = $sentencia->fetch();
            return $resultado;
        } else
            return null;
    }

    private function updateC($datosCombi){
        $id = $datosCombi->ID_Combi;
        $numeroCombi = $datosCombi->Numero_Combi;
        $placas = $datosCombi->Placas;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "UPDATE " . self::NOMBRE_TABLA . " SET " .
                self::NUMERO_COMBI . "=?," .
                self::PLACAS . "=? WHERE " . 
                self::ID_COMBI . " = ?";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $numeroCombi);
            $sentencia->bindParam(2, $placas);
            $sentencia->bindParam(3, $id);

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

    private function deleteUserC($datosCombi){
        $combiId = $datosCombi->ID_Combi;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "DELETE FROM " . self::NOMBRE_TABLA . " WHERE " . 
                self::ID_COMBI . " = ?";

            $sentencia = $pdo->prepare($comando);
            $sentencia->bindParam(1, $combiId);

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