<?php

include_once "../domain/TelefonoProveedor.php";
include_once "../data/TelefonoData.php";

/**
 * Controlador de teléfonos de proveedores
 * 
 * @author Daniel Briones 
 * @version 1.0
 * @since 05-08-24
 */
class ControladoraTelefonoProveedor
{

    private $phoneData;

    public function __construct()
    {
        $this->phoneData = new TelefonoData();
    }

    /**
     * Guarda un nuevo teléfono de proveedor en la base de datos.
     * 
     * @param TelefonoProveedor $phone Objeto teléfono con todos los datos necesarios
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function savePhone(TelefonoProveedor $phone)
    {
        return $this->phoneData->save($phone);
    }

    /**
     * Actualiza la información de un teléfono de proveedor existente en la base de datos.
     * 
     * Cambía la fecha de ultima modificación en base de datos
     * 
     * @param TelefonoProveedor $phone Objeto teléfono con los datos actualizados
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function updatePhone(TelefonoProveedor $phone)
    {
        return $this->phoneData->update($phone);
    }

    /**
     * Elimina un teléfono de proveedor de la base de datos.
     * Cambia el estado por FALSE-inactivo y la fecha de modificación.
     * 
     * @param TelefonoProveedor $phone Objeto teléfono a ser eliminado
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function deletePhone(TelefonoProveedor $phone)
    {
        return $this->phoneData->deleteById($phone);
    }

    /**
     * Busca un teléfono de proveedor por su identificador.
     * 
     * @param string $identifier Identificador del teléfono
     * @return TelefonoProveedor|null Objeto teléfono si se encuentra, NULL en caso contrario
     */
    public function findPhoneByIdentifier($identifier)
    {
        return $this->phoneData->findByIdentifier($identifier);
    }

    /**
     * Busca el teléfono asociado a un proveedor por el id del proveedor.
     * 
     * @param int $providerId Id del proveedor
     * @return TelefonoProveedor Objeto TelefonoProveedor asociado al proveedor
     */
    public function findBySupplierId($providerId)
    {
        return $this->phoneData->findBySupplierId($providerId);
    }

    /**
     * Obtiene el siguiente id disponible para un nuevo teléfono de proveedor.
     * 
     * @return int El siguiente id disponible
     */
    public function getNextId()
    {
        return $this->phoneData->getNextId();
    }

    /**
     * Encargado de verificar si un teléfono ya se encuentra registrado en BD
     * @param string $phone Teléfono que se desea verificar su existencia.
     * @return bool TRUE en caso de existir, FALSE en caso contrario
     */
    public function findByPhoneNumber($phone){
        return $this->phoneData->findByPhoneNumber($phone);
    }


    /**
     * Crea un objeto pho con los datos suministrados para guardar en base de datos
     * 
     * @param string $phone El número de teléfono del proveedor
     * @param DateTime $createdAt el la fecha de creación de los objetos
     * 
     * @return TelefonoProveedor|null Objeto con los datos asignados o null
     */
    public function createPhone(string $phone, DateTime $createdAt): TelefonoProveedor
    {
        $strCreatedAt = $createdAt->format('Y-m-dH:i:s');
        $phoneIdentifier = "CEL-SUP-" . $phone . "-" . $strCreatedAt;
        $idPhone = $this->getNextId();

        return new TelefonoProveedor($idPhone, $phoneIdentifier, 0, $phone, $createdAt, $createdAt, true);
    }
}
