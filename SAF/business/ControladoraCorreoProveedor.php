<?php

include_once "../domain/CorreoProveedor.php";

include_once "../data/CorreoData.php";

/**
 * Controlador de correos electrónicos de proveedores
 * 
 * @author Daniel Briones
 * @version 1.0
 * @since 05-08-24
 */
class ControladoraCorreoProveedor {

    private $emailData;

    public function __construct() {
        $this->emailData = new CorreoData();
    }

    /**
     * Guarda un nuevo correo electrónico de proveedor en la base de datos.
     * 
     * @param CorreoProveedor $email Objeto correo con todos los datos necesarios
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function saveEmail(CorreoProveedor $email) {
        return $this->emailData->save($email);
    }

    /**
     * Actualiza la información de un correo electrónico de proveedor existente en la base de datos.
     * 
     * @param CorreoProveedor $email Objeto correo con los datos actualizados
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function updateEmail(CorreoProveedor $email) {
        return $this->emailData->update($email);
    }

    /**
     * Elimina un correo electrónico de proveedor de la base de datos.
     * Cambia el estado por FALSE-inactivo y la fecha de modificación.
     * 
     * @param CorreoProveedor $email Objeto correo a ser eliminado
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function deleteEmail(CorreoProveedor $email) {
        return $this->emailData->deleteById($email);
    }

    /**
     * Busca un correo electrónico de proveedor por su identificador único.
     * 
     * @param string $identifier Identificador único del correo electrónico
     * @return CorreoProveedor|null Objeto correo si se encuentra, NULL en caso contrario
     */
    public function findEmailByIdentifier($identifier) {
        return $this->emailData->findByIdentifier($identifier);
    }

    /**
     * Encargado de verificar si un correo electrónico ya se encuentra registrado en BD
     * @param string $email Correo electrónico que se desea verificar su existencia.
     * @return bool TRUE en caso de existir, FALSE en caso contrario
     */
    public function findByEmail($email){
        return $this->emailData->findByEmail($email);
    }

    /**
     * Busca el correo electrónico asociado a un proveedor por el id del proveedor.
     * 
     * @param int $supplierId Id del proveedor
     * @return CorreoProveedor Objeto CorreoProveedor asociado al proveedor
     */
    public function findBySupplierId($supplierId) {
        return $this->emailData->findBySupplierId($supplierId);
    }

    /**
     * Obtiene el siguiente id disponible para un nuevo correo electrónico de proveedor.
     * 
     * @return int El siguiente id disponible
     */
    public function getNextId(){
        return $this->emailData->getNextId();
    }


    /**
     * Crea un objeto email con los datos suministrados para guardar en base de datos
     * 
     * @param string $email La dirección de correo del proveedor
     * @param DateTime $createdAt el la fecha de creación de los objetos
     * 
     * @return CorreoProveedor|null Objeto con los datos asignados o null
     */
    public function createEmail(string $email, DateTime $createdAt) :CorreoProveedor {
        $strCreatedAt = $createdAt->format('Y-m-dH:i:s');
        $emailIdentifier = "EMA-SUP-" . $email . "-" . $strCreatedAt;
        $idEmail = $this->getNextId();

        return new CorreoProveedor($idEmail, $emailIdentifier, 0, $email, $createdAt, $createdAt, true);
    }
}

?>
