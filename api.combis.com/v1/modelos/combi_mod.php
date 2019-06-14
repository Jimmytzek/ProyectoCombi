<?php
class combi
{
    // Datos de la tabla "usuario"
    const NOMBRE_TABLA = "combi";
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
    
    public static function post($peticion) {
        if ($peticion[0] == 'registrarCombi') {
            return self::regcombi();
        } else {
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada",400);
        }
    }    
   
        private function regcombi(){
        
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
                throw new ExcepcionApi(self::ESTADO_FALLA_DESCONOCIDA, "Falla desconocida",400);
        }
    }

    private function crear($datosCombi) {
        $numeroCobi = $datosCombi->Numero_Combi;
        $placas = $datosCombi->Placas;
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::NUMERO_COMBI . "," .
                self::PLACAS . ")" .
                " VALUES(?,?)";

            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $numeroCobi);
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
}

    
