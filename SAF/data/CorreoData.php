<?php
require_once 'Conexion.php';
require_once '../domain/CorreoProveedor.php';

/**
 * Clase que maneja las consultas que se realizan a la base de datos
 * 
 * @autor Daniel Briones
 * @since 1.0 2-08-24
 * @version 1.0
 */
class CorreoData extends Conexion
{
    /**
     * Guarda los datos del correo electrónico en la base de datos
     * 
     * @param CorreoProveedor $email Objeto con los datos necesarios para guardar el correo electrónico
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function save(CorreoProveedor $email)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("INSERT INTO tbcorreoproveedor (tbcorreoproveedorid, tbcorreoproveedoridentificador, tbcorreoproveedoridproveedor, tbcorreoproveedorcorreo, tbcorreoproveedorcreadoen, tbcorreoproveedormodificadoen, tbcorreoproveedorestado) VALUES (:id, :identifier, :idSupplier, :email, :createdAt, :modifiedAt, :status)");

            $id = $email->getId();
            $identifier = $email->getIdentifier();
            $idSupplier = $email->getIdSupplier();
            $emailAddress = $email->getEmail();
            $createdAt = $email->getStrCreatedAt();
            $modifiedAt = $email->getStrModifiedAt();
            $status = $email->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':idSupplier', $idSupplier, PDO::PARAM_INT);
            $stmt->bindParam(':email', $emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
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

    /**
     * Modifica los datos del correo electrónico (dirección de correo, fecha de modificación y estado) en la base de datos
     * 
     * @param CorreoProveedor $email Objeto con los datos necesarios para modificar el correo electrónico
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function update(CorreoProveedor $email)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbcorreoproveedor SET tbcorreoproveedorcorreo = :email, tbcorreoproveedormodificadoen = :modifiedAt, tbcorreoproveedorestado = :status WHERE tbcorreoproveedorid = :id");

            $id = $email->getId();
            $emailAddress = $email->getEmail();
            $modifiedAt = $email->getStrModifiedAt();
            $status = $email->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':email', $emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
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

    /**
     * Busca el correo electrónico por un identificador único (no es por id)
     * 
     * @param string $identifier Identificador único del correo electrónico
     * 
     * @return CorreoProveedor|null Correo electrónico si encuentra el registro o null en caso de fallo
     */
    public function findByIdentifier($identifier)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbcorreoproveedorid, tbcorreoproveedoridentificador, tbcorreoproveedoridproveedor, tbcorreoproveedorcorreo, tbcorreoproveedorcreadoen, tbcorreoproveedormodificadoen, tbcorreoproveedorestado FROM tbcorreoproveedor WHERE tbcorreoproveedoridentificador = :identifier");
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $email = new CorreoProveedor(
                    $result['tbcorreoproveedorid'],
                    $result['tbcorreoproveedoridentificador'],
                    $result['tbcorreoproveedoridproveedor'],
                    $result['tbcorreoproveedorcorreo'],
                    new DateTime($result['tbcorreoproveedorcreadoen']),
                    new DateTime($result['tbcorreoproveedormodificadoen']),
                    $result['tbcorreoproveedorestado']
                );
            } else {
                $email = null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $email = null;
        } finally {
            $conn = null;
        }
        return $email;
    }

    /**
     * Verifica si el correo electrónico ya existe en la base de datos
     * 
     * @param string $emailAddress Correo electrónico a verificar
     * 
     * @return bool TRUE si el correo electrónico existe, FALSE si no existe
     */
    public function findByEmail($emailAddress)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT 1 FROM tbcorreoproveedor WHERE tbcorreoproveedorcorreo = :emailAddress");
            $stmt->bindParam(':emailAddress', $emailAddress, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result !== false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conn = null;
        }
    }

    /**
     * Obtiene los datos del correo electrónico de un proveedor
     * 
     * @param int $supplierId Id del proveedor del cual se quiere obtener el correo electrónico
     * 
     * @return CorreoProveedor|null Correo electrónico si encuentra el registro o null en caso de fallo
     */
    public function findBySupplierId($supplierId)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbcorreoproveedorid, tbcorreoproveedoridentificador, tbcorreoproveedoridproveedor, tbcorreoproveedorcorreo, tbcorreoproveedorcreadoen, tbcorreoproveedormodificadoen, tbcorreoproveedorestado FROM tbcorreoproveedor WHERE tbcorreoproveedoridproveedor = :supplierId");

            $stmt->bindParam(':supplierId', $supplierId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = null;

            if ($result) {
                $email = new CorreoProveedor(
                    $result['tbcorreoproveedorid'],
                    $result['tbcorreoproveedoridentificador'],
                    $result['tbcorreoproveedoridproveedor'],
                    $result['tbcorreoproveedorcorreo'],
                    new DateTime($result['tbcorreoproveedorcreadoen']),
                    new DateTime($result['tbcorreoproveedormodificadoen']),
                    $result['tbcorreoproveedorestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        return $email;
    }

    /**
     * "Elimina" los datos del correo electrónico de un proveedor (cambia el estado a FALSE-Inactivo)
     * 
     * @param CorreoProveedor $email Objeto que contiene el id del correo electrónico que se desea "Eliminar" y la fecha de modificación
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function deleteById(CorreoProveedor $email)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbcorreoproveedor SET tbcorreoproveedormodificadoen = :modifiedAt, tbcorreoproveedorestado = :status WHERE tbcorreoproveedorid = :id");

            $id = $email->getId();
            $modifiedAt = $email->getStrModifiedAt();
            $status = $email->getStatus();
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
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

    /**
     * Obtiene el siguiente id disponible para la tabla correo electrónico
     * 
     * @return int $lastId Siguiente id disponible para la tabla correo electrónico, en caso de estar vacía, 1
     */
    public function getNextId()
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbcorreoproveedorid FROM tbcorreoproveedor ORDER BY tbcorreoproveedorid DESC LIMIT 1");
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbcorreoproveedorid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = null;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }
}
