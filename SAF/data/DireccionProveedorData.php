<?php

require_once "Conexion.php";

require_once "../domain/DireccionProveedor.php";

class DireccionProveedorData extends Conexion {

    public function saveDirection(DireccionProveedor $supplierDirection) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("INSERT INTO tbdireccionproveedor (tbdireccionproveedorid, tbdireccionproveedoridentificador, tbproveedorid, tbdistritoid, tbdireccionproveedorfechacreacion, tbdireccionproveedorfechamodificacion, tbdireccionproveedorestado,tbdireccionporsenha) 
                                    VALUES (:id, :identifier, :supplierId, :districtId, :createdAt, :modifiedAt, :status,:signalDirection)");

            $id = $supplierDirection->getIdDirection();
            $identifier = $supplierDirection->getIdentifier();
            $supplierId = $supplierDirection->getIdSupplier();
            $districtId = $supplierDirection->getDistrict()->getId();
            $createdAt = $supplierDirection->getStrCreatedAt();
            $modifiedAt = $supplierDirection->getStrModifiedAt();
            $status = $supplierDirection->getStatus();
            $signalDirection = $supplierDirection->getSignalDirection();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':supplierId', $supplierId, PDO::PARAM_INT);
            $stmt->bindParam(':districtId', $districtId, PDO::PARAM_INT);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':signalDirection', $signalDirection, PDO::PARAM_STR);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function getNextId() {
        $conn = self::connect();
        $stmt = $conn->query("SELECT tbdireccionproveedorid FROM tbdireccionproveedor ORDER BY tbdireccionproveedorid DESC LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbdireccionproveedorid'] : 0;
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll() {
        $conn = self::connect();
        $stmt = $conn->query("SELECT * FROM tbdireccionproveedor");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update(DireccionProveedor $supplierDirection) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbdireccionproveedor SET tbdistritoid = :districtId, tbdireccionproveedorfechamodificacion = :modifiedAt, tbdireccionproveedorestado = :status,
            tbdireccionporsenha = :signalDirection WHERE tbdireccionproveedorid = :id");

            $id = $supplierDirection->getIdDirection();
            $districtId = $supplierDirection->getDistrict()->getId();
            $modifiedAt = $supplierDirection->getStrModifiedAt();
            $status = $supplierDirection->getStatus();
            $signalDirection = $supplierDirection->getSignalDirection();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':districtId', $districtId, PDO::PARAM_INT);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':signalDirection', $signalDirection, PDO::PARAM_STR);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function delete(DireccionProveedor $supplierDirection) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbdireccionproveedor SET tbdireccionproveedorestado = :status WHERE tbdireccionproveedorid = :id");

            $id = $supplierDirection->getIdDirection();
            $status = $supplierDirection->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function findOneElementByIdSupplier($id) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbdireccionproveedor WHERE tbproveedorid = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result === false) {
                return null;
            }

            $id = $result['tbdireccionproveedorid'];
            $identifier = $result['tbdireccionproveedoridentificador'];
            $supplierId = $result['tbproveedorid'];

            $districtController = new ControladoraPaisLocalizacion();
            $district = $districtController->getDistrictById($result['tbdistritoid']);

            $direction = $result['tbdireccionporsenha'];
            $createdAt = new DateTime($result['tbdireccionproveedorfechacreacion']);
            $modifiedAt = new DateTime($result['tbdireccionproveedorfechamodificacion']);
            $status = (bool) $result['tbdireccionproveedorestado'];
            return new DireccionProveedor($id, $supplierId, $identifier, $district, $status, $direction, $createdAt, $modifiedAt);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            $conn = null;
        }
    }
}
