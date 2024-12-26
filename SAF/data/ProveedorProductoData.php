<?php
include_once 'Conexion.php';
include_once "../domain/Producto.php";

class ProveedorProductoData extends Conexion {

    public function getNextId() {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbproveedorproductoid FROM tbproveedorproducto ORDER BY tbproveedorproductoid DESC LIMIT 1");
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbproveedorproductoid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = null;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }
    
    public function guardar($product) {
        $conn = self::connect();
        try {
            $sql = "INSERT INTO tbproveedorproducto (tbproveedorproductoid, tbproveedorproductoidentificador, tbproveedorproductoidentificadorproveedor, tbproveedorproductoidentificadorproducto, tbproveedorproductofechamodificacion, tbproveedorproductoultimacompra, tbproveedorproductofechacreacion, tbproveedorproductoestado) VALUES (:id, :identificador, :proveedor, :producto, :fechamodificado, :fechaultimacompra, :fechacreacion, :estado)";
            $stmt = $conn->prepare($sql);

            $newDate = new DateTime();
            $id = $this->getNextId();
            $identifier = "PROD-PROV-" . $product->getProveedor()->getName() . "-" . $product->getNombre() . $newDate->format('Y-m-dH:i:s');
            $proveedor = $product->getProveedor()->getIdentifier();
            $producto = $product->getIdentificador();
            $fechamodi = $newDate->format('Y-m-d');
            $fechaCre = $newDate->format('Y-m-d');
            $fechaultimacompra = $newDate->format('Y-m-d');
            $status = 1;

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identificador', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':fechamodificado', $fechamodi, PDO::PARAM_STR);
            $stmt->bindParam(':fechaultimacompra', $fechaultimacompra, PDO::PARAM_STR);
            $stmt->bindParam(':fechacreacion', $fechaCre, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $status, PDO::PARAM_INT);

            $result = $stmt->execute();
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function findSupplierByIdProduct($idProduct) {
        $conn = self::connect();
         try {
             $stmt = $conn->prepare("SELECT * FROM tbproveedorproducto WHERE tbproveedorproductoidentificadorproducto = :id");
             $stmt->bindParam(':id', $idProduct, PDO::PARAM_STR);
             $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             if ($result) {
                return $result['tbproveedorproductoidentificadorproveedor'];
             } else {
                return -1;
             }
         } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
             return -2;
         } finally {
             $conn = null;
         }
         return -3;
    }

    public function update(Producto $producto) {
        
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproveedorproducto SET tbproveedorproductoidentificadorproveedor = :proveedorid, tbproveedorproductofechamodificacion = :fechamodificacion WHERE tbproveedorproductoidentificadorproducto = :id");

            $id = $producto->getIdentificador();
            $proveedorId = $producto->getProveedor()->getIdentifier();
            $modifiedAt = $producto->getStrActuaizadoEn();
            


            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':proveedorid', $proveedorId, PDO::PARAM_STR);
            $stmt->bindParam(':fechamodificacion', $modifiedAt, PDO::PARAM_STR);

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