<?php

require_once 'Conexion.php';

class RolData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    public function closeConnection() {
        $this->conn = null;
    }

    public function save(array $data): bool {
        try {
            $sql = "INSERT INTO `tbrol`(`tbrolid`, `tbrolidentificador`, "
                    . "`tbrolnombre`, `tbroldescripcion`, `tbrolfechacreacion`,"
                    . " `tbrolfechamodificacion`, `tbrolestado`) VALUES "
                    . "(:id, :identificador, :nombre,:descripcion,"
                    . ":fechacreacion,:fechamodificacion,:estado)";
            $stmt = $this->conn->prepare($sql);
            $id = $this->getNextId($data["identificador"]);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identificador', $data["identificador"], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(':fechacreacion', $data["fechacreacion"], PDO::PARAM_STR);
            $stmt->bindParam(':fechamodificacion', $data["fechamodificacion"], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $data["estado"], PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo $exc->getCode();
            return false;
        } finally {
            $this->closeConnection();
        }
    }

    public function getNextId($name) {
        // Obtengo la conexión
        if ($this->conn === null) {
            throw new Exception("Error establishing a database connection.");
        }
        // Consulta para obtener el último ID insertado
        $stmt = $this->conn->prepare("SELECT tbrolid FROM tbrol WHERE tbrolidentificador = :name ORDER BY tbrolid DESC LIMIT 1;");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR); // Uso de bindParam para evitar errores de sintaxis
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbrolid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll(): array {
        try {
            $sql = "SELECT * FROM `tbrol` WHERE `tbrolestado` != 0;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            return null;
        } finally {
            $this->closeConnection();
        }
    }

    public function delete($identifier): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("UPDATE `tbrol` SET `tbrolestado`='0' WHERE `tbrolidentificador` = :identificador");
            // Coloco los parámetros
            $stmt->bindParam(':identificador', $identifier, PDO::PARAM_STR);
            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $this->conn = null;
        }
        return $result;
    }

    public function searchData(string $data) {
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $this->conn->prepare("SELECT * FROM `tbrol` WHERE (`tbrolnombre` LIKE :name OR `tbroldescripcion` LIKE :id ) AND `tbrolestado` != 0;");
        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        $likeData = "%{$data}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':name', $likeData, PDO::PARAM_STR);
        $stmt->bindParam(':id', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function getByIdentifier(string $identifier): array {
        try {
            $sql = "SELECT  `tbrolidentificador`, `tbrolnombre`, `tbroldescripcion` FROM `tbrol` WHERE `tbrolidentificador` = '$identifier' AND `tbrolestado` = 1";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            return null;
        } finally {
            $this->closeConnection();
        }
    }
    
    public function getByIdentifierFull(string $identifier): array {
        try {
            $sql = "SELECT  * FROM `tbrol` WHERE `tbrolidentificador` = '$identifier' AND `tbrolestado` = 1";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            return null;
        } finally {
            $this->closeConnection();
        }
    }
}
