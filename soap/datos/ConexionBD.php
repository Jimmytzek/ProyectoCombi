<?php
class Db
{
    const ESTADO_CREACION_EXITOSA = 1;
    const ESTADO_CREACION_FALLIDA = 2;
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db   = "geodrive";
	private $mysql;

	public function __construct()
	{
		$this->mysql = mysqli_connect($this->host, $this->user, $this->pass);
		if (!$this->mysql) {
			die('Connect Error :' . mysql_error());
		} else {
			mysqli_select_db($this->mysql, $this->db);
		}
	}

	public function insert($datosUsuario)
	{
        $datosUsuario = json_decode($datosUsuario);
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

		$sqlIn = "INSERT INTO Usuario  (Nombre, Primer_Apellido, Segundo_Apellido, Correo, Contrasena, Fecha_Nacimiento, Estado, Localidad, Colonia, Calle, Numero_Domicilio, Numero_Afiliado, ClaveApi) 
        VALUES('$nombre','$apellido1','$apellido2', '$correo', '$contrasenaEncriptada', '$fechaNac', '$estado', '$localidad', '$colonia', '$calle', '$numCasa', '$numAfiliado', '$claveApi')";

		$insert = mysqli_query($this->mysql, $sqlIn);

		if ($insert) {
            mysqli_close($this->mysql);
			return
                [
                    "estado" => self::ESTADO_CREACION_EXITOSA,
                    "mensaje" => utf8_encode("¡Registro con éxito!")
                ];
		} else {
			// mysqli_close($this->mysql);
			return
                [
                    "estado" => self::ESTADO_CREACION_FALLIDA,
                    "mensaje" => utf8_encode(mysqli_error($this->mysql))
                ];
		}
    }
    
    public function login($datos)
    {
        $usuario = json_decode($datos);
        $correo = $usuario->Correo;
        $contrasena = $usuario->Contrasena;

        if (self::autenticar($correo, $contrasena)) {
            $usuarioBD = self::obtenerUsuarioPorCorreo($correo);

            if ($usuarioBD != NULL) {
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
                return ["estado" => 0, "usuario" => "null"];
            }
        } else {
            return ["estado" => 0, "mensaje" => "Datos incorrectos"];
        }
    }

	public function update($datosUsuario)
	{
        $datosUsuario = json_decode($datosUsuario);
        $id = $datosUsuario->Id;
        $nombre = $datosUsuario->Nombre;
        $apellido1 = $datosUsuario->PrimerApellido;
        $apellido2 = $datosUsuario->SegundoApellido;
        $contrasena = $datosUsuario->Contrasena;
        $contrasenaEncriptada = self::encriptarContrasena($contrasena);
        $correo = $datosUsuario->Correo;
        $fechaNac = $datosUsuario->FechaNacimiento;
        $estado = $datosUsuario->Estado;
        $localidad = $datosUsuario->Localidad;
        $colonia = $datosUsuario->Colonia;
        $calle = $datosUsuario->Calle;
        $numCasa = $datosUsuario->NumeroDomicilio;
        $numAfiliado = $datosUsuario->NumeroAfiliado;

		$sql = "UPDATE Usuario SET Nombre='$nombre', Primer_Apellido='$apellido1', Segundo_Apellido='$apellido2', Correo='$correo', Contrasena='$contrasenaEncriptada', Fecha_Nacimiento='$fechaNac',
                Estado='$estado', Localidad='$localidad', Colonia='$colonia', Calle='$calle', Numero_Domicilio='$numCasa', Numero_Afiliado='$numAfiliado' WHERE ID_Usuario=$id";
		$update = mysqli_query($this->mysql, $sql);

		if ($update) {
			mysqli_close($this->mysql);
            return
                [
                    "estado" => self::ESTADO_CREACION_EXITOSA,
                    "mensaje" => utf8_encode("¡Actualizado con éxito!")
                ];
		} else {
            return
                [
                    "estado" => self::ESTADO_CREACION_FALLIDA,
                    "mensaje" => utf8_encode(mysqli_error($this->mysql))
                ];
		}
	}

	public function delete($id)
	{
        $id = json_decode($id);
        $v = $id->ID_Usuario;
		$sql = "DELETE FROM Usuario  WHERE ID_Usuario=$v";

		if (mysqli_query($this->mysql, $sql)) {
			mysqli_close($this->mysql);
			return true;
		} else {
			mysqli_close($this->mysql);
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT * FROM articulos;";
		$q = mysqli_query($this->mysql, $sql);
		$result = array();
		while ($row = mysqli_fetch_array($q)) {
			$result[] = array(
				'id' => $row['id'],
				'CveArt' => $row['CveArt'],
				'Descripcion' => $row['Descripcion'],
				'Precio' => $row['Precio'],
				'IVA' => $row['IVA'],
				'Descuento' => $row['Descuento']
			);
		}
		mysqli_close($this->mysql);
		return $result;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM articulos WHERE id=$id";

		$q = mysqli_query($this->mysql, $sql);

		$result = array();

		while ($row = mysqli_fetch_array($q)) {

			$result[] = array(
				'id' => $row['id'],
				'CveArt' => $row['CveArt'],
				'Descripcion' => $row['Descripcion'],
				'Precio' => $row['Precio'],
				'IVA' => $row['IVA'],
				'Descuento' => $row['Descuento'],
			);
		}
		mysqli_close($this->mysql);
		return $result[0];
    }

    private function encriptarContrasena($contrasenaPlana) {
        if ($contrasenaPlana)
            return password_hash($contrasenaPlana, PASSWORD_DEFAULT);
        else return null;
    }

    private function generarClaveApi() {
        return md5(microtime().rand());
    }

    private function autenticar($correo, $contrasena)
    {
        $sql = "SELECT Contrasena FROM Usuario WHERE Correo = '$correo';";

        $sentencia = mysqli_query($this->mysql, $sql);
        if ($sentencia) {
            $resultado = mysqli_fetch_array($sentencia);
            if (self::validarContrasena($contrasena, $resultado['Contrasena'])) {
                return true;
            } else return false;
        } else {
            return false;
        }
    }

    private function validarContrasena($contrasenaPlana, $contrasenaHash)
    {
        return password_verify($contrasenaPlana, $contrasenaHash);
    }


    private function obtenerUsuarioPorCorreo($correo)
    {
        $comando = "SELECT * FROM Usuario WHERE Correo='$correo'";
        $sentencia = mysqli_query($this->mysql, $comando);
        if ($sentencia)
            return mysqli_fetch_array($sentencia);
        else
            return null;
    }
}

?>