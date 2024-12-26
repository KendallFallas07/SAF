<?php
require_once 'Conexion.php';
require_once '../domain/Factura.php';
require_once "../business/ControladoraQR.php";

class FacturaData extends Conexion
{
    public function guardarFactura(Factura $factura)
    {
        $conn = self::connect();
        try {
            $nombreDirectorio = "../images/facturaQr/";

            $stmt = $conn->prepare("INSERT INTO tbfactura (tbfacturaid, tbfacturaidentificador, tbfacturaidventa, tbfacturacreadoen, tbfacturamodificadoen, tbfacturaurlqr, tbfacturaestado) VALUES (:id, :identifier, :idventa, :createdAt, :modifiedAt, :url, :status)");

            $id = $factura->getIdFactura();
            $idVenta = $factura->getVenta();
            $identificador = $factura->getIdentificadorFactura();
            $creadoEn = $factura->getStrCreadoEn();
            $modificadoEn = $factura->getStrModificadoEn();
            $estado = $factura->getEstado();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':idventa', $idVenta, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $creadoEn, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modificadoEn, PDO::PARAM_STR);
            $stmt->bindParam(':url', $nombreDirectorio, PDO::PARAM_STR);
            $stmt->bindParam(':status', $estado, PDO::PARAM_INT);


            $result = $stmt->execute();
            if ($result) {
                $controladora = new ControladoraQR();
                $controladora->generateImgQRPNG($nombreDirectorio, $identificador . ".png", $identificador);
                $result = json_encode(array('status' => 200, 'Message' => 'Factura y QR generado correctamente.'));
            } else {
                $result = json_encode(array('status' => 400, 'Message' => 'No se puedo registrar la factura'));
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = json_encode(array('status' => 400, 'Message' => 'No se puedo registrar la factura'));
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function obtenerNuevoId()
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbfacturaid FROM tbfactura ORDER BY tbfacturaid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbfacturaid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }

    public function eliminarFactura($identificador)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbfactura SET tbfacturaestado = :status, tbfacturamodificadoen = :modifiedAt WHERE tbfacturaidentificador = :identifier");

            $status = 0;
            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d');

            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $strModifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function habilitarFactura($identificador)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbfactura SET tbfacturaestado = :status, tbfacturamodificadoen = :modifiedAt WHERE tbfacturaidentificador = :identifier");

            $status = 1;
            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d');

            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $strModifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function modificarFactura($identificador)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbfactura SET tbfacturamodificadoen = :modifiedAt WHERE tbfacturaidentificador = :identifier");

            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d');

            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $strModifiedAt, PDO::PARAM_STR);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function obtenerFacturaXIdentificador($identificador)
    {
        $conn = self::connect();
        try {
            //Obtener la factura usando el identificador de la factura
            $stmtFactura = $conn->prepare("SELECT * FROM tbfactura WHERE tbfacturaidentificador = :identificador");
            $stmtFactura->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmtFactura->execute();
            $factura = $stmtFactura->fetch(PDO::FETCH_ASSOC);

            if ($factura) {
                // Obtener la venta asociada a la factura
                $stmtVenta = $conn->prepare("SELECT * FROM tbventa WHERE tbventaid = :ventaId");
                $stmtVenta->bindParam(':ventaId', $factura['tbfacturaidventa'], PDO::PARAM_STR);
                $stmtVenta->execute();
                $venta = $stmtVenta->fetch(PDO::FETCH_ASSOC);
                var_dump($venta);
                if ($venta) {
                    // Obtener los productos asociados a la venta
                    $stmtProductos = $conn->prepare("SELECT * FROM tbventaproducto WHERE tbventaidentificador = :ventaIdentificador");
                    $stmtProductos->bindParam(':ventaIdentificador', $venta['tbventaidentificador'], PDO::PARAM_STR);
                    $stmtProductos->execute();
                    $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

                    // Combinar los datos en un solo array
                    $venta['productos'] = $productos;
                    $factura['venta'] = $venta;

                    // Convertir los datos a JSON
                    $result = json_encode(array('status' => 200, 'data' => $factura));
                } else {
                    $result = json_encode(array('status' => 404, 'message' => 'Venta no encontrada.'));
                }
            } else {
                $result = json_encode(array('status' => 404, 'message' => 'Factura no encontrada.'));
            }
        } catch (PDOException $e) {
            $result = json_encode(array('status' => 404, 'message' => 'Error al traer datos de la factura.'));
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function modificarVenta(array $datosVenta, array $datosVentaProducto, $identificador)
    {
        $conn = self::connect();
        try {
            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d H:i:s');

            $stmt = $conn->prepare("SELECT * FROM tbventa WHERE tbventaidentificador = :identificadorventa LIMIT 1");
            $stmt->bindParam(':identificadorventa', $identificador, PDO::PARAM_STR);
            $stmt->execute();
            $venta = $stmt->fetch(PDO::FETCH_ASSOC);

            $venta['tbventafechamodificacion'] = $strModifiedAt;

            $stmt = $conn->prepare("SELECT * FROM tbventaproducto WHERE tbventaidentificador = :identificadorventa");
            $stmt->bindParam(':identificadorventa', $identificador, PDO::PARAM_STR);
            $stmt->execute();
            $detallesVenta = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //Elimina los registros
            if ($venta && $detallesVenta) {
                $stmt = $conn->prepare("DELETE FROM tbventa WHERE tbventaidentificador = :identificadorventa");
                $stmt->bindParam(':identificadorventa', $identificador, PDO::PARAM_STR);
                $ventaEliminada = $stmt->execute();
                if ($ventaEliminada) {
                    $stmt = $conn->prepare("DELETE FROM tbventaproducto WHERE tbventaidentificador = :identificadorventa");
                    $stmt->bindParam(':identificadorventa', $identificador, PDO::PARAM_STR);
                    $detallesVentaEliminada = $stmt->execute();
                }
            }

            //Los vuelve agregar la venta con las modificaciones
            $stmt = $conn->prepare("INSERT INTO `tbventa`(`tbventaid`, `tbventaidentificador`, `tbventausuarioidentificador`, `tbventafechacreacion`, `tbventafechamodificacion`, `tbventaestado`) VALUES (:id, :identifier, :userIdentifier, :createdAt, :updatedAt, :pState);");
            $id = $venta['tbventaid'];
            $identifier = $venta['tbventaidentificador'];
            $userIdentifier = isset($datosVenta['identificadorUsuario']) && !empty(trim($datosVenta['identificadorUsuario']))
                ? $datosVenta['identificadorUsuario']
                : $venta['tbventausuarioidentificador'];

            $createdAt = $venta['tbventafechacreacion'];
            $updatedAt = $venta['tbventafechamodificacion'];
            $pState = trim($datosVenta['estado']) ? $datosVenta['estado'] : $venta['tbventaestado'];


            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':userIdentifier', $userIdentifier, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':pState', $pState, PDO::PARAM_INT);
            $stmt->execute();

            //Agrega los detalles de la venta con las modificaciones
            foreach ($detallesVenta as $item) {
                $id = $item['tbventaproductoid'];
                $ventaIdentifier = $item['tbventaidentificador'];
                $productoIdentifier = $item['tbventaproductoidentificador'];
                $cantidad = $item['tbventacantidadproducto'];

                // Busca los productos enviados para modificar la cantidad si es cero no lo registra
                foreach ($datosVentaProducto as $dvProductos) {
                    if ($item['tbventaproductoidentificador'] === $dvProductos['identificadorProducto']) {
                        $cantidad = $dvProductos['cantidad'] ? $dvProductos['cantidad'] : 0;
                    }
                }

                if (is_numeric($cantidad) && $cantidad > 0) {
                    $stmt = $conn->prepare("INSERT INTO `tbventaproducto`(`tbventaproductoid`, `tbventaidentificador`, `tbventaproductoidentificador`, `tbventacantidadproducto`) VALUES (:id, :ventaIdentifier, :productoIdentifier, :cantidad);");
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':ventaIdentifier', $ventaIdentifier, PDO::PARAM_STR);
                    $stmt->bindParam(':productoIdentifier', $productoIdentifier, PDO::PARAM_STR);
                    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
}
