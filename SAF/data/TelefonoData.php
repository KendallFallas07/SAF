<?php


/**
 * Clase que maneja las consultas que se realizan a base de datos
 * 
 * @author Daniel Briones
 * @since 31-07-24
 * @version 1.0
 */
class TelefonoData extends Conexion
{
    /**
     * Guarda los datos del teléfono en la base de datos
     * 
     * @param TelefonoProveedor $phone Objeto con los datos necesarios para guardar el teléfono
     * 
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function save(TelefonoProveedor $phone)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("INSERT INTO tbtelefono (tbtelefonoid ,tbtelefonoidentificador, tbtelefonoidproveedor, tbtelefonotelefono, tbtelefonocreadoen, tbtelefonomodificadoen, tbtelefonoestado) VALUES (:id, :identifier, :idSupplier, :phoneNumber, :createdAt, :modifiedAt, :Supplierstatus)");

            $id = $phone->getId();
            $identifier = $phone->getIdentifier();
            $idSupplier = $phone->getIdSupplier();
            $phoneNumber = $phone->getPhone();
            $createdAt = $phone->getStrCreatedAt();
            $modifiedAt = $phone->getStrModifiedAt();
            $Supplierstatus = $phone->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':idSupplier', $idSupplier, PDO::PARAM_INT);
            $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam('Supplierstatus', $Supplierstatus, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * Modifica los datos del teléfono (Número de teléfono, fecha de modificación y estado) en base de datos
     * 
     * @param TelefonoProveedor $phone Objeto con los datos necesarios para modificar el teléfono
     * 
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function update(TelefonoProveedor $phone)
    {
        $conn = self::connect();
        try {

            $stmt = $conn->prepare("
                UPDATE tbtelefono
                SET
                    tbtelefonotelefono = :phoneNumber,
                    tbtelefonomodificadoen = :modifiedAt,
                    tbtelefonoestado = :Supplierstatus
                WHERE tbtelefonoid = :id
            ");

            $id = $phone->getId();
            $phoneNumber = $phone->getPhone();
            $modifiedAt = $phone->getStrModifiedAt();
            $Supplierstatus = $phone->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':Supplierstatus', $Supplierstatus, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * Busca el teléfono por un identificador único (no es por id)
     * 
     * @param string $identifier Identificador único del teléfono
     * 
     * @return TelefonoProveedor|null Teléfono si encuentra el registro o null en caso de fallo
     */
    public function findByIdentifier($identifier)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                SELECT 
                    tbtelefonoid, 
                    tbtelefonoidentificador, 
                    tbtelefonoidproveedor, 
                    tbtelefonotelefono, 
                    tbtelefonocreadoen, 
                    tbtelefonomodificadoen, 
                    tbtelefonoestado
                FROM tbtelefono
                WHERE tbtelefonoidentificador = :identifier
            ");
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $phone = new TelefonoProveedor(
                    $result['tbtelefonoid'],
                    $result['tbtelefonoidentificador'],
                    $result['tbtelefonoidproveedor'],
                    $result['tbtelefonotelefono'],
                    new DateTime($result['tbtelefonocreadoen']),
                    new DateTime($result['tbtelefonomodificadoen']),
                    $result['tbtelefonoestado']
                );
            } else {
                $phone = null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $phone = null;
        } finally {
            $conn = null;
        }
        return $phone;
    }

    /**
     * Obtiene los datos del teléfono de un proveedor
     * 
     * @param int $supplierId Id del proveedor del cual se quiere obtener el teléfono
     * 
     * 
     * @return TelefonoProveedor|null Teléfono si encuentra el registro o null en caso de fallo
     */
    public function findBySupplierId($supplierId)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                SELECT 
                    tbtelefonoid, 
                    tbtelefonoidentificador, 
                    tbtelefonoidproveedor, 
                    tbtelefonotelefono, 
                    tbtelefonocreadoen, 
                    tbtelefonomodificadoen, 
                    tbtelefonoestado
                FROM tbtelefono
                WHERE tbtelefonoidproveedor = :supplierId
            ");

            $stmt->bindParam(':supplierId', $supplierId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $phone = null;

            if ($result) {
                $phone = new TelefonoProveedor(
                    $result['tbtelefonoid'],
                    $result['tbtelefonoidentificador'],
                    $result['tbtelefonoidproveedor'],
                    $result['tbtelefonotelefono'],
                    new DateTime($result['tbtelefonocreadoen']),
                    new DateTime($result['tbtelefonomodificadoen']),
                    $result['tbtelefonoestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        return $phone;
    }

    /**
     * "Elimina" los datos del teléfono de un proveedor (cambia el status por FALSE-Inactivo)
     * 
     * @param TelefonoProveedor $phone Objeto que contiene el id del teléfono el cual se desea "Eliminar" y la fecha de modificación
     * 
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function deleteById(TelefonoProveedor $phone)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                UPDATE tbtelefono
                SET
                    tbtelefonomodificadoen = :modifiedAt,
                    tbtelefonoestado = :Supplierstatus
                WHERE tbtelefonoid = :id
            ");

            $id = $phone->getId();
            $modifiedAt = $phone->getStrModifiedAt();
            $supplierStatus = $phone->getStatus();
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':Supplierstatus', $supplierStatus, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }


    /**
     * Obtiene el siguiente id disponible para la tabla teléfono
     * 
     * @return int $lastId Siguiente id disponible para la tabla teléfono, en caso de estar vacía, 1
     */
    public function getNextId()
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbtelefonoid FROM tbtelefono ORDER BY tbtelefonoid DESC LIMIT 1");
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbtelefonoid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = null;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }

    /**
     * Busca un teléfono por su número en la base de datos
     * 
     * @param string $phoneNumber Número de teléfono a buscar
     * 
     * @return bool|null TRUE si encuentra el registro o FALSE si no existe
     */
    public function findByPhoneNumber($phoneNumber)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT 1 FROM tbtelefono WHERE tbtelefonotelefono = :phoneNumber");
            $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            $conn = null;
        }
    }
}
