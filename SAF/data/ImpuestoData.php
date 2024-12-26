<?php

require_once "../domain/Impuestos.php";

require_once "Conexion.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Costa_Rica');

class ImpuestosData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }

    public function save(Impuestos $impuestos): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("INSERT INTO tbimpuesto (tbimpuestoid, tbimpuestoidentificador, tbimpuestonombre, tbimpuestodescripcion, tbimpuestovalor, tbimpuestovigencia, tbimpuestoestado) VALUES (:id, :ident, :name, :description, :value, :date, :state)");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $name = $impuestos->getName();
            $id = $impuestos->getId();
            $date = new DateTime();
            $ident = $impuestos->getIdentifier();
            $description = $impuestos->getDescription();
            $value = $impuestos->getValue();
            $date = $impuestos->getDate();
            $state = $impuestos->getState();
            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ident', $ident, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam('state', $state, PDO::PARAM_INT);
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

    public function getNextId() {
        $conn = self::connect();
        // Obtengo la conexión
        if ($conn === null) {
            throw new Exception("Error establishing a database connection.");
        }

        // Consulta para obtener el último ID insertado
        $stmt = $conn->prepare("SELECT tbimpuestoid FROM tbimpuesto ORDER BY tbimpuestoid DESC LIMIT 1;");
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbimpuestoid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll() {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los impuestos
        $stmt = $conn->query("SELECT * FROM `tbimpuesto` WHERE `tbimpuestoestado` != 0;");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete(Impuestos $impuestos): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("UPDATE `tbimpuesto` SET `tbimpuestoestado`= 0 WHERE `tbimpuestoidentificador` = :ident");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $ident = $impuestos->getIdentifier();
            // Coloco los parámetros
            $stmt->bindParam(':ident', $ident, PDO::PARAM_STR);
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

    public function eliminar(string $identificador): bool {
        try {
            // Preparo la sentencia
            $stmt = $this->conn->prepare("UPDATE `tbimpuesto` SET `tbimpuestoestado`= 0 WHERE `tbimpuestoidentificador` = :identificador");
            
            // Coloco los parámetros
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
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

    public function validateName(string $name): int {
        // Preparo la consulta
        $stmt = $this->conn->prepare("SELECT * FROM `tbimpuesto` WHERE `tbimpuestonombre` = :name AND `tbimpuestoestado` != 0;");
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
        $stmt = $this->conn->prepare("SELECT * FROM `tbimpuesto` WHERE (`tbimpuestodescripcion` LIKE :desc OR `tbimpuestonombre` LIKE :name OR `tbimpuestovalor` LIKE :value) AND `tbimpuestoestado` != 0;");
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

    public function buscarPorIdentificador(string $identificador){

        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbimpuesto` WHERE `tbimpuestoidentificador` = :identificador AND `tbimpuestoestado` != 0;");

        // Asigno los valores a los parámetros
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorno los resultados
        return $results;

    }

    public function obtenerNombres()
    {

        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("SELECT tbimpuestonombre
        FROM tbimpuesto
        WHERE (tbimpuestoidentificador, tbimpuestoid) IN (
            -- Selecciona el ID máximo para cada identificador con estado 1
            SELECT tbimpuestoidentificador, MAX(tbimpuestoid)
            FROM tbimpuesto
            WHERE tbimpuestoestado = 1
            GROUP BY tbimpuestoidentificador
        )
        OR (tbimpuestoidentificador, tbimpuestoid) IN (
            -- Selecciona el ID máximo para cada identificador con estado 0, solo si no hay estado 1
            SELECT tbimpuestoidentificador, MAX(tbimpuestoid)
            FROM tbimpuesto
            WHERE tbimpuestoestado = 0
            AND tbimpuestoidentificador NOT IN (
                SELECT DISTINCT tbimpuestoidentificador
                FROM tbimpuesto
                WHERE tbimpuestoestado = 1
            )
            GROUP BY tbimpuestoidentificador
        );");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function autocompletar(string $datos)
    {
        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("
        (
            SELECT * 
            FROM tbimpuesto AS p1
            WHERE p1.tbimpuestoestado = 0
                AND p1.tbimpuestoid = (
                    SELECT MAX(p3.tbimpuestoid)
                    FROM tbimpuesto AS p3
                    WHERE p3.tbimpuestoidentificador = p1.tbimpuestoidentificador
                    AND p3.tbimpuestoestado = 0
                )
                AND (p1.tbimpuestonombre LIKE :name)
                AND NOT EXISTS (
                    SELECT 1 
                    FROM tbimpuesto AS p2
                    WHERE p2.tbimpuestoidentificador = p1.tbimpuestoidentificador
                    AND p2.tbimpuestoestado = 1
                )
        )
        UNION ALL
        (
            SELECT * 
            FROM tbimpuesto AS p1
            WHERE p1.tbimpuestoestado = 1
                AND (p1.tbimpuestonombre LIKE :name)
        )
        ORDER BY tbimpuestonombre ASC
        LIMIT 10
    ");

        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        $likeData = "%{$datos}%";

        // Asigno los valores a los parámetros
        $stmt->bindParam(':name', $likeData, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Imprimo los resultados para depuración
        return $results;
    }

    public function getAllEliminated()
    {

        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("
        
            SELECT * FROM tbimpuesto AS p1 WHERE p1.tbimpuestoestado = 0
            AND NOT EXISTS (
                SELECT 1 FROM 
                tbimpuesto AS p2
                WHERE p2.tbimpuestoidentificador = p1.tbimpuestoidentificador
                AND p2.tbimpuestoestado = 1
            )
            AND p1.tbimpuestoid = (
                SELECT MAX(p3.tbimpuestoid)
                FROM tbimpuesto AS p3
                WHERE p3.tbimpuestoidentificador = p1.tbimpuestoidentificador
                AND p3.tbimpuestoestado = 0
            )
        ");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSearchEliminated(string $data)
    {
        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("
            SELECT * 
            FROM tbimpuesto AS p1
            WHERE p1.tbimpuestoestado = 0
                AND NOT EXISTS (
                    SELECT 1 
                    FROM tbimpuesto AS p2
                    WHERE p2.tbimpuestoidentificador = p1.tbimpuestoidentificador
                    AND p2.tbimpuestoestado = 1
                )
                AND p1.tbimpuestoid = (
                    SELECT MAX(p3.tbimpuestoid)
                    FROM tbimpuesto AS p3
                    WHERE p3.tbimpuestoidentificador = p1.tbimpuestoidentificador
                    AND p3.tbimpuestoestado = 0
                )
                AND (p1.tbimpuestodescripcion LIKE :desc OR p1.tbimpuestonombre LIKE :name)
        ");

        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        $likeData = "%{$data}%";

        // Asigno los valores a los parámetros
        $stmt->bindParam(':desc', $likeData, PDO::PARAM_STR);
        $stmt->bindParam(':name', $likeData, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Imprimo los resultados para depuración
        return $results;
    }

    private function obtenerUltimoId(string $identificador)
    {

        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                SELECT tbimpuestoid 
                FROM tbimpuesto 
                WHERE tbimpuestoidentificador = :identificador
                ORDER BY tbimpuestoid  DESC 
                LIMIT 1
            ");
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmt->execute();
            $lastIdentifier = $stmt->fetchColumn();

            return $lastIdentifier ?: false;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            // Cierre de la conexión
            $conn = null;
        }
    }

    public function recuperar(string $identificador): bool
    {   
        
        $lastIdentifier = $this->obtenerUltimoId($identificador);
        
        if ($lastIdentifier) {
            $conn = self::connect();
            try {

                $stmt = $conn->prepare("
                    UPDATE tbimpuesto 
                    SET tbimpuestoestado = 1 
                    WHERE tbimpuestoid = :lastIdentifier
                ");
                $stmt->bindParam(':lastIdentifier', $lastIdentifier, PDO::PARAM_STR);
                $result = $stmt->execute();
            } catch (PDOException $e) {
                // Manejo de errores
                echo "Error: " . $e->getMessage();
                $result = false;
            } finally {
                // Cierre de la conexión
                $conn = null;
            }
            return $result;
        } else {
            return false;
        }
    }
}
