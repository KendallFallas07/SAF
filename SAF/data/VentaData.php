<?php
require_once 'Conexion.php';
class VentaData extends Conexion {
    private $conn;
    public function __construct() {
        $this->conn = self::connect();
    }
    
    public function obtenerDatosUsuario(string $identificador): array {
        $datosUsuario = [];
        try {
            // Primera consulta: Datos del usuario
            $sqlUsuario = "SELECT tbusuariofotoperfil, tbusuarionombreusuario, tbusuarionombre, 
                                 tbusuarioapellidos, tbusuariorol, tbusuariodireccion
                          FROM tbusuario
                          WHERE tbusuarioidentificador = :identificador
                          AND tbusuarioestado != 0";
            
            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':identificador', $identificador);
            $stmtUsuario->execute();
            
            if ($stmtUsuario->rowCount() > 0) {
                $datosUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
                
                // Segunda consulta: Obtener el nombre del rol
                $sqlRol = "SELECT tbrolnombre 
                          FROM tbrol 
                          WHERE tbrolidentificador = :rolIdentificador 
                          AND tbrolestado != 0";
                          
                $stmtRol = $this->conn->prepare($sqlRol);
                $stmtRol->bindParam(':rolIdentificador', $datosUsuario['tbusuariorol']);
                $stmtRol->execute();
                
                if ($stmtRol->rowCount() > 0) {
                    $datosRol = $stmtRol->fetch(PDO::FETCH_ASSOC);
                    // Agregamos el nombre del rol a los datos del usuario
                    $datosUsuario['tbusuariorol'] = $datosRol['tbrolnombre'];
                } else {
                    $datosUsuario['tbusuariorol'] = 'Rol no encontrado';
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $datosUsuario;
    }

    public function GuardarVenta(array $datosVenta): bool
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbventa`(`tbventaid`, `tbventaidentificador`, `tbventausuarioidentificador`, `tbventafechacreacion`, `tbventafechamodificacion`, `tbventaestado`) VALUES (:id, :identifier, :userIdentifier, :createdAt, :updatedAt, :pState);");
    
           
            $id = $this->getNextIdVenta(); 
            $identifier = $datosVenta['identifier'];
            $userIdentifier = $datosVenta['userIdentifier'];
            $createdAt =$datosVenta['createdAt'];
            $updatedAt = $datosVenta['updatedAt'];
            $pState = $datosVenta['state'];
    
    
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':userIdentifier', $userIdentifier, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':pState', $pState, PDO::PARAM_INT);
    
    
            $result = $stmt->execute();
        } catch (PDOException $e) {
    
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
    
            $conn = null;
        }
        return $result;
    }
    
    public function GuardarVentaProducto(array $datosVentaProducto,$identifier): bool
    {
        $conn = self::connect();
        try {
          
            $stmt = $conn->prepare("INSERT INTO `tbventaproducto`(`tbventaproductoid`, `tbventaidentificador`, `tbventaproductoidentificador`, `tbventacantidadproducto`) VALUES (:id, :ventaIdentifier, :productoIdentifier, :cantidad);");
    
            $id = $this->getNextIdVentaProducto(); 
            $ventaIdentifier = $identifier;
            $productoIdentifier = $datosVentaProducto['identificador'];
            $cantidad = $datosVentaProducto['cantidad'];
    
    
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ventaIdentifier', $ventaIdentifier, PDO::PARAM_STR);
            $stmt->bindParam(':productoIdentifier', $productoIdentifier, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    
     
            $result = $stmt->execute();
        } catch (PDOException $e) {
    
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
    
            $conn = null;
        }
        return $result;
    }
    
    private function getNextIdVenta(): int
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbventaid FROM tbventa ORDER BY tbventaid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbventaid'] + 1 : 1;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId;
    }
    
    private function getNextIdVentaProducto(): int
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbventaproductoid FROM tbventaproducto ORDER BY tbventaproductoid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbventaproductoid'] + 1 : 1;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId;
    }

    public function GuardarTransaccionVenta($identificador, $subTotal, $tipoPago,$impuesto): bool
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare(
                "INSERT INTO `tbtrasaccionventa` (
                    `tbidentificadorventa`, 
                    `tbtransaccionventasub`, 
                    `tbtransacciontipopago`, 
                    `tbtransaccionimpuestoid`) VALUES (:ventaId,:subTotal,:tipoPago,:impuestoId);");
    
            $stmt->bindParam(':ventaId', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':subTotal', $subTotal, PDO::PARAM_STR);
            $stmt->bindParam(':tipoPago', $tipoPago, PDO::PARAM_INT);
            $stmt->bindParam(':impuestoId', $impuesto, PDO::PARAM_STR);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
    
        return $result;
    }
    

}