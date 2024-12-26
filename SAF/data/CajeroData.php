<?php

require_once 'Conexion.php';

class CajeroData extends Conexion {

    private $conn;

    public function __construct() {
        $this->conn = self::connect();
    }

    public function obtenerDetallesVenta(string $ventaIdentificador): array {
        try {
            // Consulta para obtener productos de la venta
            $sqlProductos = "SELECT vp.tbventacantidadproducto, 
                            p.tbproductonombreproducto
                         FROM tbventaproducto vp
                         INNER JOIN tbproducto p 
                            ON BINARY vp.tbventaproductoidentificador = BINARY p.tbproductoidentificador
                         WHERE BINARY vp.tbventaidentificador = BINARY :ventaIdentificador";

            $stmtProductos = $this->conn->prepare($sqlProductos);
            $stmtProductos->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtProductos->execute();

            $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

            // Consulta para obtener datos del usuario
            $sqlUsuario = "SELECT u.tbusuarionombreusuario, 
                              u.tbusuarionombre, 
                              u.tbusuarioapellidos, 
                              u.tbusuariodireccion
                       FROM tbusuario u
                       INNER JOIN tbventa v 
                          ON BINARY v.tbventausuarioidentificador = BINARY u.tbusuarioidentificador
                       WHERE BINARY v.tbventaidentificador = BINARY :ventaIdentificador
                       AND u.tbusuarioestado = 1";

            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtUsuario->execute();

            $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

            // Consulta para obtener datos de la transacción de venta
            $sqlTransaccionVenta = "SELECT 
                                    tbtransaccionventasub,
                                    tbtransacciontipopago
                                FROM tbtrasaccionventa
                                WHERE tbidentificadorventa = :ventaIdentificador";

            $stmtTransaccionVenta = $this->conn->prepare($sqlTransaccionVenta);
            $stmtTransaccionVenta->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtTransaccionVenta->execute();

            $transaccion = $stmtTransaccionVenta->fetch(PDO::FETCH_ASSOC);

            return [
                'productos' => $productos,
                'usuario' => [
                    'nombreUsuario' => $usuario['tbusuarionombreusuario'] ?? 'Usuario no encontrado',
                    'nombre' => $usuario['tbusuarionombre'] ?? 'No disponible',
                    'apellidos' => $usuario['tbusuarioapellidos'] ?? 'No disponible',
                    'direccion' => $usuario['tbusuariodireccion'] ?? 'No disponible'
                ],
                'transaccion' => [
                    'subtotal' => $transaccion['tbtransaccionventasub'] ?? 'No disponible',
                    'tipoPago' => $transaccion['tbtransacciontipopago'] ?? 'No disponible'
                ]
            ];
        } catch (PDOException $e) {
            throw new Exception("Error al obtener detalles de la venta: " . $e->getMessage());
        }
    }

    public function obtenerImpuestos() {
        $sql = "SELECT tbimpuestoid,tbimpuestoidentificador,tbimpuestonombre, tbimpuestovalor 
            FROM tbimpuesto 
            WHERE tbimpuestoestado = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDetallesFactura(string $ventaIdentificador): array {
        try {
            // Consulta principal para obtener detalles de factura, venta y usuario
            $sqlDetalles = "SELECT
            tbf.tbfacturaidentificador,
            tbf.tbfacturacreadoen,
            tbu.tbusuarionombreusuario,
            tbu.tbusuarioemail,
            tbu.tbusuarionombre,
            tbu.tbusuarioapellidos,
            tbu.tbusuariodireccion,
            tbv.tbventausuarioidentificador,
            tbv.tbventaidentificador
        FROM
            tbfactura AS tbf
        LEFT JOIN tbventa AS tbv ON
            tbv.tbventaidentificador = tbf.tbfacturaidventa
        LEFT JOIN tbusuario tbu ON
            tbu.tbusuarioidentificador = tbv.tbventausuarioidentificador
        WHERE
            tbv.tbventaidentificador = :ventaIdentificador";

            $stmtDetalles = $this->conn->prepare($sqlDetalles);
            $stmtDetalles->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtDetalles->execute();

            $detalles = $stmtDetalles->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontraron resultados
            if (!$detalles) {
                throw new Exception("No se encontraron detalles para la venta especificada");
            }

            // Consulta para obtener los productos de la venta
            $sqlProductos = "SELECT
    vp.tbventacantidadproducto,
    p.tbproductonombreproducto,
    t.tblotepreciocompra
FROM
    tbventaproducto AS vp
INNER JOIN tbproducto AS p
ON
    p.tbproductoidentificador = vp.tbventaproductoidentificador
INNER JOIN tblote AS t
ON
t.tbproductoidentificador=p.tbproductoidentificador
WHERE
    vp.tbventaidentificador = :ventaIdentificador;";

            $stmtProductos = $this->conn->prepare($sqlProductos);
            $stmtProductos->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtProductos->execute();

            $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

            // Obtener el identificador del usuario de la venta
            $sqlUsuarioVenta = "SELECT tbventausuarioidentificador 
            FROM tbventa 
            WHERE tbventaidentificador = :ventaIdentificador";

            $stmtUsuarioVenta = $this->conn->prepare($sqlUsuarioVenta);
            $stmtUsuarioVenta->bindParam(':ventaIdentificador', $ventaIdentificador);
            $stmtUsuarioVenta->execute();

            $usuarioVenta = $stmtUsuarioVenta->fetch(PDO::FETCH_ASSOC);

            // Estructurar la respuesta
            return [
                'factura' => [
                    'identificador' => $detalles['tbfacturaidentificador'] ?? 'No disponible',
                    'fechaCreacion' => $detalles['tbfacturacreadoen'] ?? 'No disponible'
                ],
                'venta' => [
                    'identificador' => $detalles['tbventaidentificador'] ?? 'No disponible',
                    'usuarioIdentificador' => $detalles['tbventausuarioidentificador'] ?? 'No disponible'
                ],
                'usuario' => [
                    'nombreUsuario' => $detalles['tbusuarionombreusuario'] ?? 'No disponible',
                    'email' => $detalles['tbusuarioemail'] ?? 'No disponible',
                    'nombre' => $detalles['tbusuarionombre'] ?? 'No disponible',
                    'apellidos' => $detalles['tbusuarioapellidos'] ?? 'No disponible',
                    'direccion' => $detalles['tbusuariodireccion'] ?? 'No disponible'
                ],
                'productos' => array_map(function ($producto) {
                    return [
                'nombre' => $producto['tbproductonombreproducto'] ?? 'No disponible',
                'cantidad' => $producto['tbventacantidadproducto'] ?? 0,
                'precio' => $producto['tblotepreciocompra'] ?? 0
                    ];
                }, $productos),
                'impuesto_valor' => isset($_POST['impuesto']) ? $_POST['impuesto'] : 0,
                'total' => isset($_POST['total']) ? $_POST['total'] : 0
            ];
        } catch (PDOException $e) {
            throw new Exception("Error al obtener detalles de la factura: " . $e->getMessage());
        }
    }

    public function obtenerVentas(string $identificadorUsuario) {
        try {
            $sql = "SELECT
                    tbf.tbfacturaidentificador,
                    tbf.tbfacturacreadoen,
                    tbu.tbusuarionombreusuario,
                    tbu.tbusuarioemail,
                    tbu.tbusuarionombre,
                    tbu.tbusuarioapellidos,
                    tbu.tbusuariodireccion,
                    tbv.tbventausuarioidentificador,
                    tbv.tbventaidentificador
                FROM
                    tbfactura AS tbf
                LEFT JOIN tbventa AS tbv
                    ON tbv.tbventaidentificador = tbf.tbfacturaidventa
                LEFT JOIN tbusuario AS tbu
                    ON tbu.tbusuarioidentificador = tbv.tbventausuarioidentificador
                WHERE
                    tbv.tbventausuarioidentificador = :identificadorUsuario 
                    AND tbv.tbventaestado = 0
                ORDER BY
                    tbv.tbventafechacreacion ASC;";

            $stmtDetalles = $this->conn->prepare($sql);
            $stmtDetalles->bindParam(':identificadorUsuario', $identificadorUsuario, PDO::PARAM_STR);
            $stmtDetalles->execute();

            // Usar fetchAll en lugar de fetch para múltiples resultados
            $result = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $exc) {
            $exc->getTraceAsString();
            return null;
        }
    }

    public function obtenerUsuario(String $ventaIdentificador) {
        try {
            $sql = "SELECT
                    `tbventausuarioidentificador` 
                FROM
                    `tbventa`
                WHERE
                    tbventaidentificador = :ventaIdentificador;";

            $stmtDetalles = $this->conn->prepare($sql);
            $stmtDetalles->bindParam(':ventaIdentificador', $ventaIdentificador, PDO::PARAM_STR);
            $stmtDetalles->execute();
            $result = $stmtDetalles->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $exc) {
            $exc->getTraceAsString();
            return null;
        }
    }

    public function obtenerVentasPorfecha($identificadorUsuario) {
        try {
            $sql = "SELECT
    *
FROM
    `tbventa`
WHERE
    `tbventausuarioidentificador` = :identificadorUsuario AND `tbventaestado` = 0
ORDER BY
`tbventafechacreacion` asc;";

            $stmtDetalles = $this->conn->prepare($sql);
            $stmtDetalles->bindParam(':identificadorUsuario', $identificadorUsuario, PDO::PARAM_STR);
            $stmtDetalles->execute();

            // Usar fetchAll en lugar de fetch para múltiples resultados
            $result = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $exc) {
            $exc->getTraceAsString();
            return null;
        }
    }

    public function pagarVenta(String $ventaIdentificador, $impuesto) {

        try {
            $sql2 = "SELECT
    `tbventaestado`
FROM
    tbventa
WHERE
    `tbventaidentificador` = :ventaIdentificador;";
            $stmtDetalles2 = $this->conn->prepare($sql2);
            $stmtDetalles2->bindParam(':ventaIdentificador', $ventaIdentificador, PDO::PARAM_STR);
            $stmtDetalles2->execute();
            $result = $stmtDetalles2->fetch(PDO::FETCH_ASSOC);
            if($result["tbventaestado"]==1){
                return false;
            }
            $sql = "UPDATE `tbventa` SET `tbventaestado` = 1 WHERE `tbventaidentificador` = :ventaIdentificador ";
            $stmtDetalles = $this->conn->prepare($sql);
            $stmtDetalles->bindParam(':ventaIdentificador', $ventaIdentificador, PDO::PARAM_STR);
            $stmtDetalles->execute();
            $this->agregarImpuesto($ventaIdentificador, $impuesto);
            return true;
        } catch (PDOException $exc) {
            echo $exc->getCode();
            echo $exc->getMessage();
            return false;
        }
    }

    public function agregarImpuesto(String $ventaIdentificador, String $impuesto) {
        try {
            $sql = "UPDATE `tbtrasaccionventa` SET `tbtransaccionimpuestoid`= :impuesto WHERE `tbidentificadorventa` = :ventaIdentificador";
            $stmtDetalles = $this->conn->prepare($sql);
            $stmtDetalles->bindParam(':ventaIdentificador', $ventaIdentificador, PDO::PARAM_STR);
            $stmtDetalles->bindParam(':impuesto', $impuesto, PDO::PARAM_STR);
            $stmtDetalles->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getCode();
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            echo $exc->getTraceAsString();

            return false;
        }
    }
   
}

