<?php

include_once 'datos/ConexionBD.php';

class historialChofer
{
    // Datos de la tabla "combi"
    const NOMBRE_TABLA = "histochofer";
    // Campos de la tabla
    const ID_USUARIO = "ID_Usuario";
    const NOMBRE = "Nombre";
    const PRIMER_APELLIDO = "PrimerApellido";
    const SEGUNDO_APELLIDO = "SegundoApellido";
    const FECHA_INICIO = "FechaInicio";
    const FECHA_TERMINO = "FechaTermino";
    const ESTATUS = "Estatus";
    

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
        if ($peticion[0] == 'registrar') {
            return self::regHistoChofer();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function put($peticion){
        if($peticion[0] == 'actualizar'){
            return self::actuHistoChofer();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function delete($peticion){
        if($peticion[0] == 'borrar'){
            return self::delHistoChofer();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    public static function get($peticion){
        if($peticion[0] == 'verHistorial'){
            return self::obtenerHistoChofer();
        }else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
        }
    }

    /**
     * Crea una nueva combi en la base de datos
     */
    private function regHistoChofer()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::crearHistoChofer($usuario);

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
    private function actuHistoChofer()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::updateHC($usuario);

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
    private function delHistoChofer()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        $resultado = self::deleteCH($usuario);

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
    private function crearHistoChofer($datosHC)
    {

        $nombre = $datosHC->Nombre;
        $primerApellido = $datosHC->PrimerApellido;
        $segundoApellido = $datosHC->SegundoApellido;
        $fechainicio = $datosHC->FechaInicio;
        $fechatermino = $datosHC->FechaTermino;
        $estatus = $datosHC->Estatus;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::NOMBRE . "," .
                self::PRIMER_APELLIDO . "," .
                self::SEGUNDO_APELLIDO . "," .
                self::FECHA_INICIO . "," .
                self::FECHA_TERMINO . "," .
                self::ESTATUS . ")" .
                " VALUES(?,?,?,?,?,?)";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $primerApellido);
            $sentencia->bindParam(3, $segundoApellido);
            $sentencia->bindParam(4, $fechainicio);
            $sentencia->bindParam(5, $fechatermino);
            $sentencia->bindParam(6, $estatus);

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

  
    private function obtenerHistoChofer()
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

    private function updateHC($datosHC){

        $nombre = $datosHC->Nombre;
        $primerApellido = $datosHC->PrimerApellido;
        $segundoApellido = $datosHC->SegundoApellido;
        $fechaincio = $datosHC->FechaInicio;
        $fechatermino = $datosHC->FechaTermino;
        $estatus = $datosHC->Estatus;
        $usuarioID= $datosHC->ID_Usuario;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "UPDATE " . self::NOMBRE_TABLA . " SET " .
                self::NOMBRE . "=?," .
                self::PRIMER_APELLIDO . "=?," .
                self::SEGUNDO_APELLIDO . "=?," .
                self::FECHA_INICIO . "=?," .
                self::FECHA_TERMINO . "=?," .
                self::ESTATUS . "=? WHERE " . 
                self::ID_USUARIO . " = ?";

            $sentencia = $pdo->prepare($comando);


            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $primerApellido);
            $sentencia->bindParam(3, $segundoApellido);
            $sentencia->bindParam(4, $fechaincio);
            $sentencia->bindParam(5, $fechatermino);
            $sentencia->bindParam(6, $estatus);
            $sentencia->bindParam(7, $usuarioID);

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

    private function deleteCH($datosHC){
        $usuarioId = $datosHC->ID_Usuario;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia UPDATE
            $comando = "DELETE FROM " . self::NOMBRE_TABLA . " WHERE " . 
                self::ID_USUARIO . " = ?";

            $sentencia = $pdo->prepare($comando);
            $sentencia->bindParam(1, $usuarioId);

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