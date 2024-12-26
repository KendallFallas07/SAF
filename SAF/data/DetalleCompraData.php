<?php

require_once './Conexion.php';

class DetalleCompraData extends Conexion
{

    public function guardarDetallesDeCompra($detail)
    {
        $conn = self::connect();
        try {
            $sql = "INSERT INTO tbdetallesdecompra (tbdetallesdecompraid, tbdetallesdecompraidentificador, tbdetallesdecompracompra_id, tbdetallesdecompraproducto_id, tbdetallesdecompralote_id, tbdetallesdecompracantidadUnidades, tbdetallesdecomprafecha_creacion, tbdetallesdecomprafecha_modificacion) 
                VALUES (:id, :identificador, :compraId, :productoId, :loteId, :cantidadUnidades, :fechaCreacion, :fechaModificacion)";
            $stmt = $conn->prepare($sql);

            $id = $detail->getId();
            $identifier = $detail->getIdentifier();
            $compraId = $detail->getCompraId();
            $productoId = $detail->getProductoId();
            $loteId = $detail->getLoteId();
            $cantidadUnidades = $detail->getCantidadComprada();
            $fechaCreacion = $detail->getFechaCreacion()->format('Y-m-d H:i:s');
            $fechaModificacion = $detail->getFechaModificacion()->format('Y-m-d H:i:s');

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identificador', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':compraId', $compraId, PDO::PARAM_INT);
            $stmt->bindParam(':productoId', $productoId, PDO::PARAM_INT);
            $stmt->bindParam(':loteId', $loteId, PDO::PARAM_INT);
            $stmt->bindParam(':cantidadUnidades', $cantidadUnidades, PDO::PARAM_INT);
            $stmt->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $stmt->bindParam(':fechaModificacion', $fechaModificacion, PDO::PARAM_STR);

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
