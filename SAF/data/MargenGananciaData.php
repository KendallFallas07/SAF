<?php

require_once 'Conexion.php';
require_once '../domain/MargenGanancia.php';
require_once '../domain/Lote.php';

class MargenGananciaData extends Conexion{

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }
    public function getNextId(): int {
        try {
        
            $stmt = $this->conn->query("SELECT tbmargengananciaid FROM tbmargenganancia ORDER BY tbmargengananciaid DESC LIMIT 1;");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? (int)$row['tbmargengananciaid'] : 0;
            return $lastId + 1;
        } catch (PDOException $e) {
            echo "Error al obtener el siguiente ID: " . $e->getMessage();
            return 0; // Retorna 0 en caso de error
        }
    }
    

   // public function getAllLotes(): array {
      //  $stmt = $this->conn->query("SELECT * FROM tblote WHERE tbloteestado != 0;");
     //   return $stmt->fetchAll(PDO::FETCH_ASSOC);
   // }

    public function getAllLotes()
    {
        //$conn = self::connect();
        $stmt = $this->conn->query("SELECT * FROM tblote WHERE tbloteestado != 0;");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lotes = [];

        foreach ($result as $dates) {
            $lote = new Lote(0, $dates['tbloteidentificador'], $dates['tbproductoidentificador'],'','','','','','','',0);
            
        $nameProduct=$this->findByIdentifier($lote->getTbProductoId());

        $nameProduct!=null? $nameProduct:'NoExist';

         $lote->setTbProductoName($nameProduct);
            
            
            $lotes[] = $lote;
        }

        return $lotes;
    }

    


    public function findByIdentifier($identifier)
    {
        $conn = self::connect();
        $product = null;

        try {
            $stmt = $conn->prepare("SELECT tbproductonombreproducto FROM tbproducto WHERE tbproductoestado = :estado AND tbproductoidentificador = :identifier");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            $stmt->bindValue(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

       

               return $result? $result['tbproductonombreproducto']:null;
            
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return null;
    }


    public function saveMargenGanancia(MargenGanancia $margenGanancia): bool {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO tbmargenganancia (
                    tbmargengananciaid, 
                    tbloteidentificador, 
                    tbmargengananciaidentificador, 
                    tbmargengananciaporcentaje, 
                    tbmargengananciafechacreacion, 
                    tbmargengananciafechamodificacion, 
                    tbmargengananciaestado
                ) 
                VALUES (:id, :loteIdentificador, :margenIdentificador, :porcentaje, :fechaCreacion, :fechaModificacion, :estado)
            ");
    
            // Obtener los valores de la clase MargenGanancia
            $id = $this->getNextId(); 
            $loteIdentificador = $margenGanancia->getIdentifierLote();
            $margenIdentificador = $margenGanancia->getIdentifierMargen();
            $porcentaje = $margenGanancia->getPorcentaje();
            $fechaCreacion = $margenGanancia->getCreatedAtMargen();
            $fechaModificacion = $margenGanancia->getModifiedAtMargen();
            $estado = $margenGanancia->getStatusMargen();
    

            if ($fechaCreacion instanceof DateTime) {
                $fechaCreacion = $fechaCreacion->format('Y-m-d H:i:s'); // Cambia el formato según sea necesario
            }
            
            if ($fechaModificacion instanceof DateTime) {
                $fechaModificacion = $fechaModificacion->format('Y-m-d H:i:s'); // Cambia el formato según sea necesario
            }
            // Asignar los valores a los parámetros de la consulta
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':loteIdentificador', $loteIdentificador, PDO::PARAM_STR);
            $stmt->bindParam(':margenIdentificador', $margenIdentificador, PDO::PARAM_STR);
            $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_STR);
            $stmt->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaModificacion', $fechaModificacion, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    
            // Ejecutar el INSERT
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getAllMargen()
    {
        $stmt = $this->conn->query("SELECT * FROM tbmargenganancia WHERE tbmargengananciaestado != 0;");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $margenes = [];
    
        foreach ($result as $dates) {
            $margen = new MargenGanancia(
                $dates['tbmargengananciaid'],
                $dates['tbmargengananciaidentificador'],
                $dates['tbmargengananciaporcentaje'],
                $dates['tbloteidentificador'],
                '', '', 1
            );
    
            $lote = $this->consultaSacarUnlote($margen->getIdentifierLote());
    
            if (is_object($lote) && method_exists($lote, 'getTbProductoId')) {
                $tbProductoId = $lote->getTbProductoId();
                $nameProduct = $this->findByIdentifier($tbProductoId);
                $margen->setNameProduct($nameProduct ?? 'producto no encontrado');
            } else {
                $margen->setNameProduct('Lote no encontrado');
            }
    
            $margenes[] = $margen;
        }
    
        return $margenes;
    }
    


    public function getMargenesByIdentifier($identifier)
{
    // Conexión a la base de datos
    //$conn = self::connect();
    
    // Preparar la consulta con un placeholder
    $stmt = $this->conn->prepare("SELECT * FROM tbmargenganancia WHERE tbmargengananciaestado != 0 AND tbloteidentificador  = :identifier;");
    
    // Asignar el valor del parámetro
    $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $margenes = [];
    
    foreach ($result as $dates) {
        $margen = new MargenGanancia(
            $dates['tbmargengananciaid'],
            $dates['tbmargengananciaidentificador'],
            $dates['tbmargengananciaporcentaje'],
            $dates['tbloteidentificador'], '', '', 1
        );
        
        // Obtener el lote
        $lote = $this->consultaSacarUnlote($margen->getIdentifierLote());
        
        // Obtener el nombre del producto
        $nameProduct = $this->findByIdentifier($lote->getTbProductoId());
        
        // Asignar el nombre del producto o 'NoExist'
        $margen->setNameProduct($nameProduct !== null ? $nameProduct : 'NoExist');
        
        $margenes[] = $margen;
    }
    
    return $margenes;
}



public function getMargenByIdentifier($identifier)
{
    // Conexión a la base de datos
    //$conn = self::connect();
    
    // Preparar la consulta con un placeholder
    $stmt = $this->conn->prepare("SELECT * FROM tbmargenganancia WHERE tbmargengananciaestado != 0 AND tbmargengananciaidentificador   = :identifier;");
    
    // Asignar el valor del parámetro
    $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $margen=null;
    
    foreach ($result as $dates) {
        $margen = new MargenGanancia(
            $dates['tbmargengananciaid'],
            $dates['tbmargengananciaidentificador'],
            $dates['tbmargengananciaporcentaje'],
            $dates['tbloteidentificador'], '', '', 1
        );
        
    }
    
    return $margen;
}

public function getMargenValidate($identifier)
{
    
    $stmt = $this->conn->prepare("SELECT * FROM tbmargenganancia WHERE tbmargengananciaestado != 0 AND tbloteidentificador = :identifier;");
    
    $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return !empty($result);
}


public function getAllDisableMargen()
{
    // Conexión a la base de datos
    //$conn = self::connect();
    
    $stmt = $this->conn->query("
        SELECT * 
        FROM tbmargenganancia AS m1
        WHERE m1.tbmargengananciaestado = 0
          AND NOT EXISTS (
              SELECT 1
              FROM tbmargenganancia AS m2
              WHERE m2.tbmargengananciaidentificador = m1.tbmargengananciaidentificador
                AND m2.tbmargengananciaestado = 1
          )
          AND m1.tbmargengananciaid = (
              SELECT MAX(m3.tbmargengananciaid)
              FROM tbmargenganancia AS m3
              WHERE m3.tbmargengananciaidentificador = m1.tbmargengananciaidentificador
                AND m3.tbmargengananciaestado = 0
          );
    ");

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $margenes = [];
    
    foreach ($result as $dates) {
        $margen = new MargenGanancia(
            $dates['tbmargengananciaid'],
            $dates['tbmargengananciaidentificador'],
            $dates['tbmargengananciaporcentaje'],
            $dates['tbloteidentificador'], '', '', 1
        );

        // Obtener el lote
        $lote = $this->consultaSacarUnlote($margen->getIdentifierLote());

        // Obtener el nombre del producto
        $nameProduct = $this->findByIdentifier($lote->getTbProductoId());

        // Asignar el nombre del producto o 'NoExist'
        $margen->setNameProduct($nameProduct !== null ? $nameProduct : 'NoExist');

        $margenes[] = $margen;
    }

    return $margenes;
}


 public function consultaSacarUnlote(string $identificador) {
    $stmt = $this->conn->prepare("SELECT * FROM tblote WHERE tbloteidentificador = :identificador AND tbloteestado != 0;");
    $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    $stmt->execute();

    $lotes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lotes= new Lote(
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




public function deleteMargen($id)
{
    // Obtengo la conexión
    $conn = self::connect();
    try {
        // Preparo la sentencia
        $stmt = $conn->prepare("UPDATE tbmargenganancia SET tbmargengananciaestado  = :estado WHERE tbmargengananciaidentificador  = :identifier");
        // Asigno los valores a variables antes de pasarlas a bindParam
        $estado = 0;
        // Coloco los parámetros
        $stmt->bindParam(':identifier', $id, PDO::PARAM_STR);
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

public function updateMargen(MargenGanancia $margen):bool{

$this->deleteMargen($margen->getIdentifierMargen());

return $this->saveMargenGanancia($margen);
}

}




