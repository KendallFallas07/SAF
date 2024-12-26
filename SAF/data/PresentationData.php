<?php

include_once "Conexion.php";

require_once '../domain/Presentacion.php';

/**
 * @author Kendall Fallas
 */
class PresentationData extends Conexion
{

    public function savePresentation(Presentacion $presentacion): bool
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbpresentacion`(`tbpresentacionid`, `tbpresentacionidentificador`, `tbpresentacionombre`, `tbpresentaciondescripcion`, `tbpresentacioncreadoen`, `tbpresentacionmodificadoen`, `tbpresentacionestado`) VALUES (:id, :identifier, :pName, :pDescription, :createdAt, :updatedAt, :pState);");

            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $presentacion->getId();
            $identifier = $presentacion->getIdentifier();
            $pName = $presentacion->getName();
            $pDescription = $presentacion->getDescription();

            // Convierte DateTime a string
            $createdAt = $presentacion->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $presentacion->getUpdatedAt()->format('Y-m-d H:i:s');

            $pState = $presentacion->getStatus();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':pName', $pName, PDO::PARAM_STR);
            $stmt->bindParam(':pDescription', $pDescription, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':pState', $pState, PDO::PARAM_INT);

            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }

    public function getNextId()
    {
        $conn = self::connect();
        // Obtengo la conexión
        if ($conn === null) {
            throw new Exception("Error establishing a database connection.");
        }

        // Consulta para obtener el último ID insertado
        $stmt = $conn->prepare("SELECT tbpresentacionid FROM tbpresentacion ORDER BY tbpresentacionid DESC LIMIT 1;");
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbpresentacionid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll()
    {
        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("SELECT * FROM tbpresentacion WHERE tbpresentacionestado != 0");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllEliminated()
    {

        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("
        
            SELECT * FROM tbpresentacion AS p1 WHERE p1.tbpresentacionestado = 0
            AND NOT EXISTS (
                SELECT 1 FROM 
                tbpresentacion AS p2
                WHERE p2.tbpresentacionidentificador = p1.tbpresentacionidentificador
                AND p2.tbpresentacionestado = 1
            )
            AND p1.tbpresentacionid = (
                SELECT MAX(p3.tbpresentacionid)
                FROM tbpresentacion AS p3
                WHERE p3.tbpresentacionidentificador = p1.tbpresentacionidentificador
                AND p3.tbpresentacionestado = 0
            )
        ");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update(Presentacion $presentacion): bool
    {
        $this->delete($presentacion->getIdentifier());
        $this->savePresentation($presentacion);
        return 1;
    }

    public function delete(string $identificador)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbpresentacion SET tbpresentacionestado = 0 WHERE tbpresentacionidentificador = :identificador");

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
            $conn = null;
        }
        return $result;
    }

    public function searchData(string $data)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbpresentacion` WHERE (`tbpresentaciondescripcion` LIKE :desc OR `tbpresentacionombre` LIKE :name ) AND `tbpresentacionestado` != 0;");
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

    public function searchDataEliminated(string $data)
    {
        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("
            SELECT * 
            FROM tbpresentacion AS p1
            WHERE p1.tbpresentacionestado = 0
                AND NOT EXISTS (
                    SELECT 1 
                    FROM tbpresentacion AS p2
                    WHERE p2.tbpresentacionidentificador = p1.tbpresentacionidentificador
                    AND p2.tbpresentacionestado = 1
                )
                AND p1.tbpresentacionid = (
                    SELECT MAX(p3.tbpresentacionid)
                    FROM tbpresentacion AS p3
                    WHERE p3.tbpresentacionidentificador = p1.tbpresentacionidentificador
                    AND p3.tbpresentacionestado = 0
                )
                AND (p1.tbpresentaciondescripcion LIKE :desc OR p1.tbpresentacionombre LIKE :name)
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

    public function autocompletar(string $datos)
    {
        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("
        (
            SELECT * 
            FROM tbpresentacion AS p1
            WHERE p1.tbpresentacionestado = 0
                AND p1.tbpresentacionid = (
                    SELECT MAX(p3.tbpresentacionid)
                    FROM tbpresentacion AS p3
                    WHERE p3.tbpresentacionidentificador = p1.tbpresentacionidentificador
                    AND p3.tbpresentacionestado = 0
                )
                AND (p1.tbpresentacionombre LIKE :name)
                AND NOT EXISTS (
                    SELECT 1 
                    FROM tbpresentacion AS p2
                    WHERE p2.tbpresentacionidentificador = p1.tbpresentacionidentificador
                    AND p2.tbpresentacionestado = 1
                )
        )
        UNION ALL
        (
            SELECT * 
            FROM tbpresentacion AS p1
            WHERE p1.tbpresentacionestado = 1
                AND (p1.tbpresentacionombre LIKE :name)
        )
        ORDER BY tbpresentacionombre ASC
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

    public function obtenerNombres()
    {

        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("SELECT tbpresentacionombre
        FROM tbpresentacion
        WHERE (tbpresentacionidentificador, tbpresentacionid) IN (
            -- Selecciona el ID máximo para cada identificador con estado 1
            SELECT tbpresentacionidentificador, MAX(tbpresentacionid)
            FROM tbpresentacion
            WHERE tbpresentacionestado = 1
            GROUP BY tbpresentacionidentificador
        )
        OR (tbpresentacionidentificador, tbpresentacionid) IN (
            -- Selecciona el ID máximo para cada identificador con estado 0, solo si no hay estado 1
            SELECT tbpresentacionidentificador, MAX(tbpresentacionid)
            FROM tbpresentacion
            WHERE tbpresentacionestado = 0
            AND tbpresentacionidentificador NOT IN (
                SELECT DISTINCT tbpresentacionidentificador
                FROM tbpresentacion
                WHERE tbpresentacionestado = 1
            )
            GROUP BY tbpresentacionidentificador
        );");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function nombresSimples()
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT tbpresentacionombre FROM `tbpresentacion` WHERE `tbpresentacionestado` = 0;");
        
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function searchOneData(string $data)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbpresentacion` WHERE `tbpresentacionidentificador` LIKE :desc  AND `tbpresentacionestado` != 0;");
        // Asigno el valor de la búsqueda con los caracteres de porcentaje
        $likeData = "%{$data}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':desc', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function validateIdentifier(string $identifier): int
    {

        $conn = self::connect();
        // Preparo la consulta
        $stmt = $conn->prepare("SELECT * FROM `tbpresentacion` WHERE `tbpresentacionidentificador` = :identifier AND `tbpresentacionestado` != 0;");

        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return count($results);
    }


    public function findById($id): Presentacion
    {
        $conn = self::connect();
        $presentacion = null;

        try {
            $stmt = $conn->prepare("SELECT * FROM tbpresentacion WHERE tbpresentacionestado = :estado AND tbpresentacionidentificador = :identifier");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            $stmt->bindValue(':identifier', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $presentacion = new Presentacion(
                    (int)$result['tbpresentacionid'],
                    $result['tbpresentacionidentificador'],
                    $result['tbpresentacionombre'],
                    $result['tbpresentaciondescripcion'],
                    new DateTime($result['tbpresentacioncreadoen']),
                    new DateTime($result['tbpresentacionmodificadoen']),
                    (int)$result['tbpresentacionestado']
                );
                return $presentacion;
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $presentacion;
    }

    public function findByIdentifier(string $identifier)
    {
        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbpresentacion` WHERE `tbpresentacionidentificador` = :identifier AND `tbpresentacionestado` != 0;");

        // Asigno los valores a los parámetros
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorno los resultados
        return $results;
    }

    private function obtenerUltimoId(string $identificador)
    {

        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                SELECT tbpresentacionid 
                FROM tbpresentacion 
                WHERE tbpresentacionidentificador = :identificador
                ORDER BY tbpresentacionid  DESC 
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
                    UPDATE tbpresentacion 
                    SET tbpresentacionestado = 1 
                    WHERE tbpresentacionid = :lastIdentifier
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
