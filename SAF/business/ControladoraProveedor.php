<?php

require_once "../domain/Proveedor.php";

require_once "../domain/DireccionProveedor.php";

require_once "ControladoraDireccionProveedor.php";
require_once "ControladoraPaisLocalizacion.php";

require_once "ControladoraTipoProveedor.php";

require_once "ControladoraCorreoProveedor.php";

require_once "ControladoraTelefonoProveedor.php";

require_once "../data/ProveedorData.php";

date_default_timezone_set('America/Costa_Rica');

/**
 * Controller de proveedores
 * 
 * @author Daniel Briones 
 * @version 1.0
 * @since 03-08-24
 */
class ControladoraProveedor {

    private $proveedorData;

    public function __construct() {
        $this->proveedorData = new ProveedorData();
    }

    /**
     * Se encarga de hacer el llamado correspondiente para agregar el proveedor a la base de datos
     * 
     * @param Proveedor $Supplier Proveedor con todos los datos necesarios
     * @return bool TRUE en caso de éxito, FALSE en caso contrario
     */
    public function insert(Proveedor $supplier) {
        return $this->proveedorData->save($supplier);
    }

    /**
     * Se encarga de hacer el llamado correspondiente para obtener el siguiente id en la tabla de proveedores en BD
     * 
     * @return int Obtiene el siguiente id para la tabla de proveedores
     */
    public function getNextId(): int {
        return $this->proveedorData->getNextId();
    }

    /**
     * Se encarga de obtener todos los proveedores 
     * 
     * @return array Arreglo con todos los registros de proveedores
     */
    public function getAllSuppliers() {
        return $this->proveedorData->getAll();
    }

    /**
     * Se encarga de obtener todos los proveedores que coincidan con un nombre
     * 
     * @param string $name Nombre (no necesariamente exacto) del proveedor que se desean obtener los datos
     * 
     * @return array Arreglo con todos los registros de proveedores
     */
    public function getSuppliersByName($name) {
        return ($this->proveedorData->getSupplierByName($name));
    }

    /**
     * Se encarga de obtener todos del proveedor que coincida con el identificador suministrado
     * @param string $identifier Identificador del proveedor que se desea buscar
     * @return Proveedor|null Un objeto con los datos del proveedor o NULL si no existe el identificador
     */
    public function findByIdentifier($identifier) {
        return $this->proveedorData->findByIdentifier($identifier);
    }

    public function findBySupplierId(int $supplierId) {
        return $this->proveedorData->findById($supplierId);
    }

    /**
     * Encargado de eliminar un proveedor por identificador
     * @param string $identifier Identificador del proveedor que se desea eliminar
     * @return bool TRUE si se logró eliminar, FALSE en caso contrario.
     */
    public function deleteSupplierByidentifier($identifier) {
        return $this->proveedorData->delete($identifier);
    }

    /**
     * Encargado de eliminar un proveedor por identificador
     * @param Proveedor $supplier Proveedor con los datos que se desean modificar
     * @return bool TRUE si se logró modificar, FALSE en caso contrario.
     */
    public function updateSupplier(Proveedor $supplier) {
        return $this->proveedorData->update($supplier);
    }

    /**
     * Función que crea el objeto con los datos que envía en cliente
     * @param string $name Nombre del nuevo proveedor 
     * @param string $phone Número de teléfono del proveedor
     * @param string $email Correo electrónico del proveedor
     * @param string $type Tipo de proveedor. Ejemplo: (Fabricante, distribuidor, servicios, etc)
     * @param string $postalCode Código postal del distrito donde se encuentra el proveedor
     * @param string $otherDirection Una dirección más exacta de la ubicación del proveedor
     * 
     * @return Proveedor Objeto proveedor con todos los datos ya asignados
     */
    public function _create_Proveedor($name, $phone, $email, $type, $postalCode, $otherDirection): Proveedor {
        $createdAt = new DateTime(); //Fecha de creación de los objetos
        $strCreatedAt = $createdAt->format('Y-m-dH:i:s');

        // Datos del proveedor
        $idSupplier = $this->getNextId();
        $supplierIdentifier = "SUP-" . $name . "-" . $strCreatedAt;

        // Crear objetos
        $phoneController = new ControladoraTelefonoProveedor();
        $TelefonoProveedor = $phoneController->createPhone($phone, $createdAt);
        $TelefonoProveedor->setIdSupplier($idSupplier);

        $emailController = new ControladoraCorreoProveedor();
        $CorreoProveedor = $emailController->createEmail($email, $createdAt);
        $CorreoProveedor->setIdSupplier($idSupplier);

        // Traer objetos
        $supplierTypeController = new ControladoraTipoProveedor();
        $supplierType = $supplierTypeController->getTypeSupplier($type);

        $districtController = new ControladoraPaisLocalizacion();
        $district = $districtController->getDistrictByPostalCode($postalCode);

        $directionController = new ControladoraDireccionProveedor();
        $idDirection = $directionController->getNextId();

        $directionIdentifier = "DIREC-SUP-" . $postalCode . "-" . $strCreatedAt;
        $directionSuplier = new DireccionProveedor($idDirection, $idSupplier, $directionIdentifier, $district, true, $otherDirection, $createdAt, $createdAt);

        return new Proveedor($idSupplier, $supplierIdentifier, $name, $TelefonoProveedor, $CorreoProveedor, $supplierType, $directionSuplier, $createdAt, $createdAt, true);
    }

    public function existeElNombreDelProveedor($nombre, $identificador){
        return $this->proveedorData->existeElNombreDelProveedor($nombre, $identificador);
    }

    public function obtenerProveedoresPorEstado($estado) {
        return $this->proveedorData->obtenerProveedoresPorEstado($estado);
    }

    public function habilitarProveedor($identificador){
        return $this->proveedorData->habilitarProveedor($identificador);
    }

    public function existeElTelefonoEnProveedor($telefono){
        return $this->proveedorData->existeElTelefonoEnProveedor($telefono);
    }

    public function existeElCorreoEnProveedor($correo) {
        return $this->proveedorData->existeElCorreoEnProveedor($correo);
    }
}
