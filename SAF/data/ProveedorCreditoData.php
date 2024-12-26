<?php

require_once "../domain/ProveedorCredito.php";
require_once '../domain/Proveedor.php';
require_once 'Conexion.php';

class ProveedorCreditoData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }

    public function obtenerUltimoId(): int {
        $stmt = $this->conn->query("SELECT tbproveedorcreditoid FROM tbproveedorcredito ORDER BY tbproveedorcreditoid DESC LIMIT 1;");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbproveedorcreditoid'] : 0;
        return $lastId + 1;
    }

    public function createProveedorCredito(ProveedorCredito $proveedorCredito): bool {
        try {
            // Preparar la consulta SQL para insertar un nuevo registro
            $stmt = $this->conn->prepare(
                    "INSERT INTO tbproveedorcredito (
                tbproveedorcreditoid,
                tbproveedorid,
                tbproveedorcreditoidentificador,
                tbproveedorcreditocantidadcredito,
                tbproveedorcreditoporcentaje,
                tbproveedorcreditoplazo,
                tbproveedorcreditofechainicio,
                tbproveedorcreditofechavencimiento,
                tbproveedorcreditofechacreacion,
                tbproveedorcreditofechamodificacion,
                tbproveedorcreditoestado
            ) VALUES (
                :id,
                :tbproveedorid,
                :identificador,
                :cantidadCredito,
                :porcentaje,
                :plazo,
                :fechaInicio,
                :fechaVencimiento,
                :fechaCreacion,
                :fechaEdicion,
                :estado
            )"
            );

            // Obtener los valores del objeto ProveedorCredito
            $id = $this->obtenerUltimoId();
            $tbproveedorid = $proveedorCredito->getTbproveedorid();
            $identificador = $proveedorCredito->getProveedorCIdentificador();
            $cantidadCredito = $proveedorCredito->getProveedorCCantidadCredito();
            $porcentaje = $proveedorCredito->getProveedorCPorcentaje();
            $plazo = $proveedorCredito->getProveedorCPlazo();
            $fechaInicio = $proveedorCredito->getProveedorCFechaInicio();
            $fechaVencimiento = $proveedorCredito->getProveedorCFechaVencimiento();
            $fechaCreacion = $proveedorCredito->getFechaCreacion();
            $fechaEdicion = $proveedorCredito->getFechaEdicion();
            $estado = $proveedorCredito->getProveedorCEstado();

            // Asignar los valores a los parámetros de la consulta SQL
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':tbproveedorid', $tbproveedorid, PDO::PARAM_STR);
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':cantidadCredito', $cantidadCredito, PDO::PARAM_STR);
            $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_STR);
            $stmt->bindParam(':plazo', $plazo, PDO::PARAM_INT);
            $stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(':fechaVencimiento', $fechaVencimiento, PDO::PARAM_STR);
            $stmt->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaEdicion', $fechaEdicion, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);

            // Ejecutar la consulta SQL y retornar el resultado
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }   

public function obtenerTodosLosProveedores() {
          $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbproveedor WHERE tbproveedorestado = 1");
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

 public function obetenerTodosLosProveedoresCredito(): array {
        $stmt = $this->conn->query("SELECT * FROM tbproveedorcredito WHERE tbproveedorcreditoestado = 1;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
 public function buscarNombreProveedorPorIdentificador($identificador) {
        $conn = self::connect();
        try {
            // Preparar la consulta SQL para obtener el nombre del proveedor
            $stmt = $conn->prepare("SELECT tbproveedornombre FROM tbproveedor WHERE tbproveedoridentificador = :identificador AND tbproveedorestado = 1");
            
            // Enlazar el parámetro
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Obtener el resultado
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Retornar el nombre del proveedor o una cadena vacía si no se encuentra
            return $row['tbproveedornombre'] ?? '';
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return '';
        } finally {
            // Cerrar la conexión
            $conn = null;
        }
    } 
    
 public function obtenerProveedorCreditoPorIdentificador(string $identificador): ?ProveedorCredito
{
    $conn = self::connect();
    try {
        // Preparo la sentencia con la validación del estado
        $stmt = $conn->prepare("SELECT * FROM tbproveedorcredito 
                                WHERE tbproveedorcreditoidentificador = :identificador 
                                AND tbproveedorcreditoestado = 1");
        
        // Asigno el valor al parámetro
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
        
        // Ejecuto
        $stmt->execute();
        
        // Obtengo el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            // Si se encuentra el registro y el estado es 1, creo un objeto ProveedorCredito
            return new ProveedorCredito(
                (int)$row['tbproveedorcreditoid'],
                $row['tbproveedorid'],
                $row['tbproveedorcreditoidentificador'],
                (int)$row['tbproveedorcreditocantidadcredito'],
                (float)$row['tbproveedorcreditoporcentaje'],
                (int)$row['tbproveedorcreditoplazo'],
                new DateTime($row['tbproveedorcreditofechainicio']),
                new DateTime($row['tbproveedorcreditofechavencimiento']),
                new DateTime($row['tbproveedorcreditofechacreacion']),
                new DateTime($row['tbproveedorcreditofechamodificacion']),
                (bool)$row['tbproveedorcreditoestado']
            );
        } else {
            // Retorna null si no se encuentra el registro o el estado no es 1
            return null;
        }
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Cierro la conexión siempre
        $conn = null;
    }
}

    
    
    public function borrarPorIdentificador(string $identificador): bool
{
    // Obtengo la conexión
    $conn = self::connect();
    try {
        // Preparo la sentencia para actualizar el estado
        $stmt = $conn->prepare("UPDATE tbproveedorcredito SET tbproveedorcreditoestado = :estado WHERE tbproveedorcreditoidentificador = :identificador");
        
        // Asigno los valores a variables antes de pasarlas a bindParam
        $estado = 0; // El valor que representa el estado 'borrado'
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
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
public function editar(ProveedorCredito $proCre): bool {
        
        $this->borrarPorIdentificador($proCre->getProveedorCIdentificador());
        return $this->createProveedorCredito($proCre);
    }
public function encontrarPorPlazo(String $plazo) {
    // Preparo la consulta con los parámetros de enlace correctos
    $stmt = $this->conn->prepare("SELECT * FROM `tbproveedorcredito` 
        WHERE `tbproveedorcreditoplazo` = :plazo
        AND `tbproveedorcreditoestado` = 1;");
    
    // Asigno el valor de búsqueda del plazo
    $stmt->bindParam(':plazo', $plazo, PDO::PARAM_STR);
    
    // Ejecuto la consulta
    $stmt->execute();
    
    // Obtengo los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Creo un array de objetos ProveedorCredito
    $proveedoresCredito = [];
    foreach ($results as $result) {
        // Asegúrate de que las fechas están bien formateadas y los valores booleanos son correctos
        $proCre= new ProveedorCredito(
            $result['tbproveedorcreditoid'],
            $result['tbproveedorid'],
            $result['tbproveedorcreditoidentificador'],
            $result['tbproveedorcreditocantidadcredito'],
            $result['tbproveedorcreditoporcentaje'],
            $result['tbproveedorcreditoplazo'],
            $result['tbproveedorcreditofechainicio'],
            $result['tbproveedorcreditofechavencimiento'],
            $result['tbproveedorcreditofechacreacion'],
            $result['tbproveedorcreditofechamodificacion'],
            $result['tbproveedorcreditoestado']
                
        );
        $proCre->setTbproveedorid($this->buscarNombreProveedorPorIdentificador($proCre->getTbproveedorid()));
        $proveedoresCredito[] = $proCre;
    }
    
    // Retorno el array de objetos ProveedorCredito
    return $proveedoresCredito;
}


public function obtenerIdentificadoresProveedoresPorFiltrado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT tbproveedoridentificador
            FROM tbproveedor
            WHERE tbproveedoridentificador LIKE :datos
            ORDER BY `tbproveedornombre` ASC 
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
        $identificadores = $this->obtenerIdentificadoresProveedoresPorFiltrado($data);
        // Si no se encontraron identificadores, retornar un array vacío
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
        FROM `tbproveedorcredito` 
        WHERE `tbproveedorid` IN ($placeholders)
        AND `tbproveedorcreditoestado` != 0 
        ORDER BY `tbproveedorid` ASC 
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
public function autocompletado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT *
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

    public function filtrarProveedores(string $identificador): bool
    {

        $conn = self::connect();

        $stmt = $conn->prepare(
            "
        SELECT COUNT(*)
        FROM tbproveedorcredito
        WHERE tbproveedorid = :identificador AND tbproveedorcreditoestado != 0;
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
