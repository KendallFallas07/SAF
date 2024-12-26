<?php

require_once "../business/ControladoraDireccionProveedor.php";

include_once "../domain/Compra.php";
require_once 'Conexion.php';

/**
 * @author Kendall Fallas
 */
class CompraData extends Conexion {

    public function saveCompra(Compra $compra): bool {


        // Obtengo la conexión
        $conn = self::connect();

        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbcompra`(`tbcompraid`, `tbcompraidentificador`, `tbcompraidentificadorproveedor`, `tbcompratotal`, `tbcompranotas`, `tbcomprametodopago`, `tbcomprafecha`, `tbcompracreadoen`, `tbcompramodificadoen`, `tbcompraestado`) VALUES (:id, :identifier, :idproveedor, :cTotal, :cNotas, :cMetodoP, :cFecha, :createdAt, :updatedAt, :cState);");

            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $compra->getId();
            $identifier = $compra->getIdentifier();

            $idProveedor = $compra->getIdSupplier();
            $cTotal = $compra->getTotalBuy();
            $cNotas = $compra->getNotes();
            $cMetodoP = $compra->getPayMethod();

            // Convierte DateTime a string
            $createdAt = $compra->getCreatedAt();
            $updatedAt = $compra->getModifiedAt();
            $cFecha = $compra->getBuyDate();

            $cState = $compra->getBuyState();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':idproveedor', $idProveedor, PDO::PARAM_STR);
            $stmt->bindParam(':cTotal', $cTotal, PDO::PARAM_STR);
            $stmt->bindParam(':cNotas', $cNotas, PDO::PARAM_STR);
            $stmt->bindParam(':cMetodoP', $cMetodoP, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':cFecha', $cFecha, PDO::PARAM_STR);
            $stmt->bindParam(':cState', $cState, PDO::PARAM_INT);

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

    public function getNextId() {
        $conn = self::connect();
        // Obtengo la conexión
        if ($conn === null) {
            throw new Exception("Error establishing a database connection.");
        }

        // Consulta para obtener el último ID insertado
        $stmt = $conn->prepare("SELECT tbcompraid FROM tbcompra ORDER BY tbcompraid DESC LIMIT 1;");
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbcompraid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll() {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("SELECT * FROM tbcompra WHERE tbcompraestado != 0");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function obtenerIdentificadoresProveedoresPorFiltrado(string $datos) {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
                "
            SELECT tbproveedoridentificador
            FROM tbproveedor
            WHERE tbproveedornombre LIKE :datos
            ORDER BY `tbproveedornombre` ASC;"
        );
        $likeData = "%{$datos}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':datos', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function searchData(string $data) {

        // Obtener identificadores de clientes filtrados por nombre y apellido
        $identificadores = $this->obtenerIdentificadoresProveedoresPorFiltrado($data);

        // Si no se encontraron identificadores, retornar un array vacío
        if (empty($identificadores)) {
            return [];
        }

        // Extraer solo los identificadores en un array simple
        $ids = array_column($identificadores, 'tbproveedoridentificador');

        // Convertir los identificadores en una lista separada por comas para la consulta SQL
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $conn = self::connect();

        // Preparo la consulta con la cláusula IN en la tabla tbclientecredito
        $stmt = $conn->prepare("
        SELECT * 
        FROM `tbcompra` 
        WHERE `tbcompraidentificadorproveedor` IN ($placeholders)
        AND `tbcompraestado` != 0 
        ORDER BY `tbcompraidentificadorproveedor` ASC;
    ");

        // Asignar valores a los placeholders
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_STR);
        }

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function searchByIdentifier(string $identifier) {

        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbcompra` WHERE `tbcompraidentificador` = :identifier AND `tbcompraestado` != 0;");

        // Asigno los valores a los parámetros
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorno los resultados
        return $results;
    }

    public function update(Compra $compra): bool {
        $this->delete($compra->getIdentifier());
        $this->saveCompra($compra);
        return 1;
    }

    public function delete(string $identifier) {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbcompra SET tbcompraestado = 0 WHERE tbcompraidentificador = :identifier");
            // Coloco los parámetros
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
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

    public function getAllSuppliers() {
        $conn = self::connect();
        try {
            // Consulta para obtener todos los proveedores
            $stmt = $conn->query("SELECT * FROM tbproveedor WHERE tbproveedorestado = 1");

            $stmt->execute();
            // Obtener todos los resultados
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Contoladores necesarios
            $typeData = new TipoProveedorData();
            $phoneData = new ControladoraTelefonoProveedor();
            $emailData = new CorreoData();
            $directionData = new ControladoraDireccionProveedor();
            // Convertir el resultado a una lista de objetos Supplier
            $suppliers = [];
            foreach ($result as $row) {
                $typeSupplier = $typeData->findOneElementById($row['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($row['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($row['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($row['tbproveedorid']);
                $suppliers[] = new Proveedor(
                        $row['tbproveedorid'],
                        $row['tbproveedoridentificador'],
                        $row['tbproveedornombre'],
                        $TelefonoProveedor,
                        $CorreoProveedor,
                        $typeSupplier,
                        $directionSupplier,
                        new DateTime($row['tbproveedorcreadoen']),
                        new DateTime($row['tbproveedormodificadoen']),
                        (bool) $row['tbproveedorestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $suppliers = [];
        } finally {
            $conn = null;
        }
        return $suppliers;
    }

    public function autocompletado(string $datos) {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
                "
            SELECT *
            FROM tbproveedor
            WHERE tbproveedornombre LIKE :datos
            ORDER BY `tbproveedornombre` ASC"
        );
        $likeData = "%{$datos}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':datos', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function filtrarProveedores(string $identificador): bool {

        $conn = self::connect();

        $stmt = $conn->prepare(
                "
        SELECT COUNT(*)
        FROM tbcompra
        WHERE tbcompraidentificadorproveedor = :identificador AND tbcompraestado != 0;
        "
        );

        // Vincula el valor del identificador al parámetro
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el resultado
        $count = $stmt->fetchColumn();

        // Devuelve true si el conteo es mayor que cero, false en caso contrario
        return $count > 0;
    }
}
