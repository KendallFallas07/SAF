<?php

require_once "../domain/Lote.php";
require_once "../domain/Producto.php";
require_once "../domain/UnidadMedida.php";
require_once "../domain/Presentacion.php";
//require_once "../business/ControladoraCategoria.php";
require_once 'Conexion.php';

/**
 * Clase para manejar las operaciones CRUD de la tabla 'tblote'
 */
class LoteData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }

    public function getNextId(): int {
        $stmt = $this->conn->query("SELECT tbloteid FROM tblote ORDER BY tbloteid DESC LIMIT 1;");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbloteid'] : 0;
        return $lastId + 1;
    }

    public function saveLote(Lote $lote): bool {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tblote(tbloteid, tbloteidentificador, tbproductoidentificador, tblotecantidadadquirida, tblotecantidadactual, tblotepreciocompra, tblotefechaadquisicion, tblotefechaexpiracion, tblotefechacreacion, tblotefechamodificacion, tbloteestado) VALUES (:id, :identificador, :productoId, :cantidadAdquirida, :cantidadActual, :precioCompra, :fechaAdquisicion, :fechaExpiracion, :fechaCreacion, :fechaModificacion, :estado)");

            $id = $this->getNextId();
            $identificador = $lote->getIdentificador();
            $productoId = $lote->getTbProductoId();
            $cantidadAdquirida = $lote->getCantidadAdquirida();
            $cantidadActual = $lote->getCantidadActual();
            $precioCompra = $lote->getPrecioCompra();
            $fechaAdquisicion = $lote->getFechaAdquisicion();
            $fechaExpiracion = $lote->getFechaExpiracion();
            $fechaCreacion = $lote->getFechaCreacion();
            $fechaModificacion = $lote->getFechaModificacion();
            $estado = $lote->getEstado();
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':productoId', $productoId, PDO::PARAM_STR);
            $stmt->bindParam(':cantidadAdquirida', $cantidadAdquirida, PDO::PARAM_INT);
            $stmt->bindParam(':cantidadActual', $cantidadActual, PDO::PARAM_INT);
            $stmt->bindParam(':precioCompra', $precioCompra, PDO::PARAM_STR);
            $stmt->bindParam(':fechaAdquisicion', $fechaAdquisicion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaExpiracion', $fechaExpiracion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaModificacion', $fechaModificacion, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
         
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        return false;
    }

    public function getAll(): array {
        $stmt = $this->conn->query("SELECT * FROM tblote WHERE tbloteestado != 0;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function obtenerIdentificadoresLotesPorFiltrado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT tbproductoidentificador
            FROM tbproducto
            WHERE tbproductonombreproducto LIKE :datos
            ORDER BY `tbproductonombreproducto` ASC 
            LIMIT 0, 10;"
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

    public function searchData(string $data): array
    {
        // Obtener identificadores de clientes filtrados por nombre y apellido
        $identificadores = $this->obtenerIdentificadoresLotesPorFiltrado($data);
        // Si no se encontraron identificadores, retornar un array vacío
        // Si no se encontraron identificadores, retornar un array vacío
        if (empty($identificadores)) {
            return [];
        }

        // Extraer solo los identificadores en un array simple
        $ids = array_column($identificadores, 'tbproductoidentificador');

        // Convertir los identificadores en una lista separada por comas para la consulta SQL
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $conn = self::connect();

        // Preparo la consulta con la cláusula IN en la tabla tbclientecredito
        $stmt = $conn->prepare("
        SELECT * 
        FROM `tblote` 
        WHERE `tbproductoidentificador` IN ($placeholders)
        AND `tbloteestado` != 0 
        ORDER BY `tbproductoidentificador` ASC 
        LIMIT 0, 10;
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

    public function consultaSacarUnlote(string $identificador): array {
    $stmt = $this->conn->prepare("SELECT * FROM tblote WHERE tbloteidentificador = :identificador AND tbloteestado != 0;");
    $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    $stmt->execute();

    $lotes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lotes[] = new Lote(
            $row['tbloteid'],
            $row['tbloteidentificador'],
            $row['tbproductoidentificador'],
            $row['tblotecantidadadquirida'],
            $row['tblotecantidadactual'],
            $row['tblotepreciocompra'],
            new DateTime($row['tblotefechaadquisicion']),
            new DateTime($row['tblotefechaexpiracion']),
            new DateTime($row['tblotefechacreacion']),
            new DateTime($row['tblotefechamodificacion']),
            $row['tbloteestado']
        );
    }
    return $lotes;
}


    public function searchByIdentifier(string $identificador){
        $stmt = $this->conn->prepare("SELECT * FROM tblote WHERE tbloteidentificador = :identificador AND tbloteestado != 0;");
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(Lote $lote): bool {
        
//       $Lote=$this->consultaSacarUnlote($lote->getIdentificador());
//       $this->delete($Lote->getIdentificador());
        $identificador=$lote->getIdentificador();
        $this->delete($identificador);
        return $this->saveLote($lote);
    }

    /*
    public function delete($identificador): bool {
        try {
            $stmt = $this->conn->prepare("UPDATE tblote SET tbloteestado = 0 WHERE tbloteidentificador = :identificador");
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }*/

    public function delete(string $identificador)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tblote SET tbloteestado = :estado WHERE tbloteidentificador = :identifier");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $estado = 0;
            // Coloco los parámetros
            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
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


    public function getLote(Lote $lote) {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT tbloteid, tbloteidentificador, tbproductoidentificador, tblotecantidadadquirida, tblotecantidadactual, tblotepreciocompra, tblotefechaadquisicion, tblotefechaexpiracion, tblotefechacreacion, tblotefechamodificacion, tbloteestado FROM tblote WHERE tbloteidentificador = :identifier AND tbloteestado != 0;");
        $identifier = $lote->getIdentificador();
    
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
        if ($result) {
            $lote = new Lote(
                $result['tbloteid'],
                $result['tbloteidentificador'],
                $result['tbproductoidentificador'],
                $result['tblotecantidadadquirida'],
                $result['tblotecantidadactual'],
                $result['tblotepreciocompra'],
                $result['tblotefechaadquisicion'],
                $result['tblotefechaexpiracion'],
                $result['tblotefechacreacion'],
                $result['tblotefechamodificacion'],
                $result['tbloteestado']
            );
        } else {
            $lote = null;
        }
        return $lote;
    }
    

    function getIdProductByIdentificador($identificador) {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT tbproductoidentificador FROM tbproducto WHERE tbproductoidentificador = :identificador AND tbproductoestado != 0;");
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['tbproductoid'] ?? 0;
    }

    function getIdProductById($id) {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT tbproductonombreproducto FROM tbproducto WHERE tbproductoidentificador = :identificador AND tbproductoestado != 0;");
        $stmt->bindParam(':identificador', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['tbproductonombreproducto'] ?? 'N/A';
    }

    public function findById($id) {
        $conn = self::connect();
        $product = null;

        try {
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado AND tbproductoidentificador = :identifier");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            $stmt->bindValue(':identifier', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            //$categoryController = new ControladoraCategoria();
            if ($result) {
                $product = new Producto();
                $product->constructorComplete(
                        (int) $result['tbproductoid'],
                        $result['tbproductoidentificador'],
                        $result['tbproductonombreproducto'],
                        $result['tbproductodescripcionproducto'],
                        null,
                        null,
                        null,
                        new DateTime($result['tbproductofechacreacion']),
                        new DateTime($result['tbproductofechamodificacion']),
                        (bool) $result['tbproductoestado']
                );
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $product;
    }
    
    public function getAllProducts() {
          $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado != 0 ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conn = null;
        }
        return false;
    }
    
    public function buscarNombreProductoPorIdentificador($identificador) {
    $conn = self::connect();
    try {
        // Preparar la consulta SQL para obtener el nombre del producto
        $stmt = $conn->prepare("SELECT tbproductonombreproducto FROM tbproducto WHERE tbproductoidentificador = :identificador AND tbproductoestado = 1");
        
        // Enlazar el parámetro
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retornar el nombre del producto o una cadena vacía si no se encuentra
        return $row['tbproductonombreproducto'] ?? '';
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return '';
    } finally {
        // Cerrar la conexión
        $conn = null;
    }
}

public function autocompletado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT *
            FROM tbproducto
            WHERE tbproductonombreproducto LIKE :datos
            ORDER BY `tbproductonombreproducto` ASC;"
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

    public function filtrarProductos(string $identificador): bool
    {

        $conn = self::connect();

        $stmt = $conn->prepare(
            "
        SELECT COUNT(*)
        FROM tblote
        WHERE tbproductoidentificador = :identificador AND tbloteestado != 0;
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
