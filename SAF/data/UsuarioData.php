<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Conexion.php';

/**
 * Description of usuarioData
 *
 * @author brayan
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UsuarioData extends Conexion {

    private ?PDO $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    function save(array $data): bool {
        //asignar el id
        $sql = "INSERT INTO `tbusuario`(`tbusuarioid`, `tbusuarioidentificador`,"
                . " `tbusuarionombreusuario`, `tbusuarioemail`, "
                . "`tbusuariocontrasena`, `tbusuarionombre`, `tbusuarioapellidos`,"
                . " `tbusuariofechacreacion`, `tbusuariofechamodificacion`,"
                . " `tbusuarioultimoingreso`, `tbusuarioestado`, `tbusuariorol`,"
                . " `tbusuariofotoperfil`, `tbusuarioidentificadortelefono`, "
                . "`tbusuariodireccion`) VALUES(";

        try {
            foreach ($data as $key => $value) {
                $sql .= ":$key, ";
            }

            // Eliminar la última coma y agregar cierre de paréntesis
            $sql = rtrim($sql, ', ') . ')';
            $stmt = $this->conn->prepare($sql);

            foreach ($data as $key => $value) {
                if (is_int($value)) {
                    $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
                }
            }

            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getCode();
            echo $exc->getMessage();
            return false;
        } finally {
            $this->conn = null;
        }
    }

    function getAll(): mixed {
        $sql = "SELECT `tbusuarioid` AS 'ID', `tbusuarioidentificador` AS "
                . "'IDENTIFICADOR', `tbusuarionombreusuario` AS 'NOMBRE USUARIO',"
                . " `tbusuarioemail` AS 'EMAIL', `tbusuariocontrasena` AS 'CONTRASENA',"
                . " `tbusuarionombre` AS 'NOMBRE', `tbusuarioapellidos` AS 'APELLIDOS"
                . "', `tbusuariofechacreacion` AS 'FECHAS DE CREACION',"
                . " `tbusuariofechamodificacion` AS 'FECHA DE MODIFICACION',"
                . " `tbusuarioultimoingreso` AS 'ULTIMO INGRESO',"
                . " `tbusuarioestado` AS 'ESTADO', `tbusuariorol` AS 'ROL',"
                . " `tbusuariofotoperfil` AS 'FOTO PERFIL',"
                . " `tbusuarioidentificadortelefono` AS 'IDENTIFICADOR DE TELEFONO',"
                . " `tbusuariodireccion` AS 'DIRECCION' FROM `tbusuario` WHERE `tbusuarioestado` != 0 ";
        try {
            $conn = self::connect();
            $stmt = $conn->query($sql);
            // Obtener todos los resultados
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return null;
        } finally {
            $stmt = null;
        }
    }

    public function getAllRol(): array {
        try {
            $sql = "SELECT * FROM `tbrol` WHERE `tbrolestado` != 0;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            return null;
        } finally {
            $stmt = null;
        }
    }

    public function verifyUser(string $data, string $psw): bool {
        try {
            $sql = "SELECT `tbusuarionombreusuario`,`tbusuarioemail`,"
                    . "`tbusuariocontrasena`, `tbusuarioidentificador`, `tbusuariorol`"
                    . " FROM `tbusuario` WHERE"
                    . " ( `tbusuarionombreusuario`  = '$data' OR"
                    . " `tbusuarioemail` = '$data' ) AND `tbusuarioestado` != 0;";
            $stmt = $this->conn->query($sql);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!isset($result) || empty($result)) {
                return false;
            } elseif (password_verify($psw, $result[0]["tbusuariocontrasena"])) {
                $_SESSION["identificador"] = $result[0]["tbusuarioidentificador"];
                $_SESSION["rol"] = $result[0]["tbusuariorol"];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getCode();
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
            return false;
        } finally {
            $stmt = null;
        }
    }

    public function getNextId($name) {
        // Obtengo la conexión
        if ($this->conn === null) {
            throw new Exception("Error establishing a database connection.");
        }
        // Consulta para obtener el último ID insertado
        $stmt = $this->conn->prepare("SELECT tbusuarioid FROM tbusuario WHERE tbusuarioidentificador = :name ORDER BY tbusuarioid DESC LIMIT 1;");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR); // Uso de bindParam para evitar errores de sintaxis
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbusuarioid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function delete(string $identificador): bool {
        try {
            $sql = "UPDATE `tbusuario` SET `tbusuarioestado`= '0' WHERE `tbusuarioidentificador` = '$identificador' ";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $exc) {
            return false;
        } finally {
            $this->conn = null;
        }
    }

    public function getRolByIdentifier($identificador): array {
        try {
            $sql = "SELECT `tbrolnombre` FROM `tbrol` WHERE `tbrolestado` = 1 AND `tbrolidentificador` = '$identificador';";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            return null;
        } finally {
            $stmt = null;
        }
    }

    public function getUserByIdentifier($identificador): array {
        try {
            $sql = "SELECT * FROM `tbusuario` WHERE `tbusuarioidentificador` = '$identificador' AND  tbusuarioestado != 0;";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            return null;
        } finally {
            $this->conn = null;
        }
    }

    public function getUserByName($name) {
        try {
            $sql = "SELECT * FROM `tbusuario` WHERE `tbusuarionombreusuario` = '$name' AND `tbusuarioestado` != 0;";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            return null;
        } finally {
            $this->conn = null;
        }
    }

    public function search(string $data) {

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $this->conn->prepare("SELECT * FROM `tbusuario` WHERE (`tbusuarionombreusuario` LIKE :desc OR `tbusuarioemail` LIKE :name OR `tbusuarionombre` LIKE :value) AND `tbusuarioestado` != 0;");
        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        $likeData = "%{$data}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':desc', $likeData, PDO::PARAM_STR);
        $stmt->bindParam(':name', $likeData, PDO::PARAM_STR);
        $stmt->bindParam(':value', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function searchByNameUser(string $data) {

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $this->conn->query("SELECT `tbusuarionombreusuario` FROM `tbusuario` WHERE `tbusuarionombreusuario` = '$data' AND `tbusuarioestado` != 0;");
        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        //$likeData = "%{$data}%";
        // Asigno los valores a los parámetros
        //$stmt->bindParam(':name', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function searchByEmailUser(string $data) {

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $this->conn->query("SELECT `tbusuarioemail` FROM `tbusuario` WHERE `tbusuarioemail` = '$data' AND `tbusuarioestado` != 0;");
        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        // $likeData = "%{$data}%";
        // Asigno los valores a los parámetros
        //$stmt->bindParam(':name', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }
}
