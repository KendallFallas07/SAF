<?php
require_once 'Conexion.php';
class VentaHistorialData extends Conexion {
    private $conn;
    public function __construct() {
        $this->conn = self::connect();
    }
    public function obtenerHistorialVentasUsuario(string $identificador): array {
    $historialVentas = [];
    try {
        // Usamos BINARY para comparación exacta
        $sqlVentas = "SELECT tbventaidentificador, tbventafechacreacion 
                      FROM tbventa 
                      WHERE BINARY tbventausuarioidentificador = BINARY :identificador 
                      AND tbventaestado = 1 
                      ORDER BY tbventafechacreacion DESC";
        
        $stmtVentas = $this->conn->prepare($sqlVentas);
        $stmtVentas->bindParam(':identificador', $identificador);
        $stmtVentas->execute();
        
        if ($stmtVentas->rowCount() > 0) {
            while ($venta = $stmtVentas->fetch(PDO::FETCH_ASSOC)) {
                // Consulta de productos también con BINARY
                $sqlProductos = "SELECT p.tbproductonombreproducto, vp.tbventacantidadproducto 
                               FROM tbventaproducto vp
                               INNER JOIN tbproducto p 
                               ON BINARY p.tbproductoidentificador = BINARY vp.tbventaproductoidentificador
                               WHERE BINARY vp.tbventaidentificador = BINARY :ventaIdentificador
                               AND p.tbproductoestado = 1";
                
                $stmtProductos = $this->conn->prepare($sqlProductos);
                $stmtProductos->bindParam(':ventaIdentificador', $venta['tbventaidentificador']);
                $stmtProductos->execute();
                
                $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
                
                $historialVentas[] = [
                    'fecha' => $venta['tbventafechacreacion'],
                    'productos' => $productos
                ];
            }
        }
    } catch (PDOException $e) {
        throw new Exception("Error al obtener el historial de ventas: " . $e->getMessage());
    }
    
    return $historialVentas;
}
}
