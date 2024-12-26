<?php

require_once '../domain/UnidadMedida.php';
require_once 'Conexion.php';

/**
 * Description of UnitMeasurementData
 *
 * @author BrayRPGs
 */
class UnidadMedidaData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }

    public function saveData(UnidadMedida $data): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("INSERT INTO `tbunidadmedida`(`tbunidadmedidaid`, `"
                    . "tbunidadmedidaidentificador`, `tbunidadmedidanombreunidad`, `tbunidadmedidaabreviatura`, `tbunidadmedidasistemamedida`," .
                    " `tbunidadmedidatipounidad`, `tbunidadmedidafechacreacion`, `tbunidadmedidafechamodificacion`, `tbunidadmedidaestado`) " .
                    "VALUES (:id,:identifier,:nameUnit,:abbreviation,:systemMeasurement,"
                    . ":typeUnit,:dateCreated,:dateUpdated,:state)");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = self::getNextId($data->getIdentifier());
            $identifier = $data->getIdentifier();
            $nameUnit = strtoupper($data->getNameUnit());
            $abbreviation = strtoupper($data->getAbbreviation());
            $systemMeasurement = strtoupper($data->getSystemMeasurement());
            $typeUnit = $data->getTypeUnit();
            $dateCreated = $data->getDateCreated();
            $dateUpdated = $data->getDateUpdated();
            $state = $data->getState();
            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':nameUnit', $nameUnit, PDO::PARAM_STR);
            $stmt->bindParam(':abbreviation', $abbreviation, PDO::PARAM_STR);
            $stmt->bindParam(':systemMeasurement', $systemMeasurement, PDO::PARAM_STR);
            $stmt->bindParam(':typeUnit', $typeUnit, PDO::PARAM_STR);
            $stmt->bindParam(':dateCreated', $dateCreated, PDO::PARAM_STR);
            $stmt->bindParam(':dateUpdated', $dateUpdated, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);
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
        return true;
    }

    public function getNextId($name) {
        // Obtengo la conexión
        if ($this->conn === null) {
            throw new Exception("Error establishing a database connection.");
        }
        // Consulta para obtener el último ID insertado
        $stmt = $this->conn->prepare("SELECT tbunidadmedidaid FROM tbunidadmedida WHERE tbunidadmedidaidentificador = :name ORDER BY tbunidadmedidaid DESC LIMIT 1;");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR); // Uso de bindParam para evitar errores de sintaxis
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbunidadmedidaid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll(): array {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los impuestos
        $stmt = $conn->query("SELECT * FROM `tbunidadmedida` WHERE `tbunidadmedidaestado` != 0;");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete(UnidadMedida $data): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("UPDATE `tbunidadmedida` SET `tbunidadmedidaestado`= 0 WHERE `tbunidadmedidaidentificador` = :identificador");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $identifier = $data->getIdentifier();
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

    public function findByIdentifier($id): UnidadMedida {
        $conn = self::connect();
        $unidadMedida = null;

        try {
            // Consulta para seleccionar los datos de la unidad de medida por ID
            $stmt = $conn->prepare("SELECT * FROM tbunidadmedida WHERE tbunidadmedidaidentificador = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Crear el objeto UnidadMedida con los datos obtenidos
                $unidadMedida = new UnidadMedida(
                        (int) $result['tbunidadmedidaid'],
                        $result['tbunidadmedidaidentificador'],
                        $result['tbunidadmedidanombreunidad'],
                        $result['tbunidadmedidaabreviatura'],
                        $result['tbunidadmedidasistemamedida'] ?: null,
                        $result['tbunidadmedidatipounidad'] ?: null,
                        new DateTime($result['tbunidadmedidafechacreacion']),
                        new DateTime($result['tbunidadmedidafechamodificacion']),
                        (bool) $result['tbunidadmedidaestado']
                );
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $unidadMedida;
    }

    public function validateName(string $name): int {
        // Preparo la consulta
        $stmt = $this->conn->prepare("SELECT * FROM `tbunidadmedida` WHERE `tbunidadmedidanombreunidad` = :name AND `tbunidadmedidaestado` != 0;");
        // Asigno el valor del nombre
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return count($results);
    }

    public function searchData(string $data) {
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $this->conn->prepare("SELECT * FROM `tbunidadmedida` WHERE (`tbunidadmedidanombreunidad` LIKE :desc OR `tbunidadmedidaabreviatura` LIKE :name OR `tbunidadmedidasistemamedida` LIKE :value) AND `tbunidadmedidaestado` != 0;");
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

    public function findById($id): UnidadMedida {
        $conn = self::connect();
        $unidadMedida = null;

        try {
            // Consulta para seleccionar los datos de la unidad de medida por ID
            $stmt = $conn->prepare("SELECT * FROM tbunidadmedida WHERE tbunidadmedidaid = :id AND tbunidadmedidaestado != 0");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Crear el objeto UnidadMedida con los datos obtenidos
                $unidadMedida = new UnidadMedida(
                        (int) $result['tbunidadmedidaid'],
                        $result['tbunidadmedidaidentificador'],
                        $result['tbunidadmedidanombreunidad'],
                        $result['tbunidadmedidaabreviatura'],
                        $result['tbunidadmedidasistemamedida'] ?: null,
                        $result['tbunidadmedidatipounidad'] ?: null,
                        new DateTime($result['tbunidadmedidafechacreacion']),
                        new DateTime($result['tbunidadmedidafechamodificacion']),
                        (bool) $result['tbunidadmedidaestado']
                );
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $unidadMedida;
    }

    public function getAllUnitTypes() {
        $conn = self::connect();
        $stmt = $conn->query("SELECT * FROM tbtipounidad WHERE tbtipounidadestado = 1");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUnitTypeByIdentifier(string $identifier) {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT `tbtipounidadnombre` FROM `tbtipounidad` WHERE `tbtipounidadidentificador` = :identifier;");
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    /* @autor Brayan rosales perez 21/09/24
     * esta es la funcion que ayuda a editar */

    public function getByIdentifier(string $identifier): array {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM `tbunidadmedida` WHERE `tbunidadmedidaidentificador` = :identifier AND `tbunidadmedidaestado` != 0;");
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
