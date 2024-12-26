<?php


/**
 * Controller para manejar los diferentes tipos de proveedores
 * 
 * @author Daniel Briones
 * @version 1.0
 * @since 6-8-24
 * 
 */
class ControladoraTipoProveedor {

    private $typeSupplierData;

    public function __construct() {
        $this->typeSupplierData = new TipoProveedorData();
    }

    /**
     * Obtiene el tipo de proveedor que coincida con un identificador
     * 
     * @param string $typeidentifier identificador del tipo de proveedor que deseamos buscar
     * 
     * @return TipoProveedor Objeto de tipo identificador que coincide con el identificador suministrado
     */
    public function getTypeSupplier(string $typeidentifier): TipoProveedor {
        return $this->typeSupplierData->findOneElement($typeidentifier);
    }

    /**
     * Crea un tipo de supervisor (No terminada!!)
     * 
     * @param string $type Nombre del tipo de identificador
     * @param DateTime $createdAt Fecha en la que se crean los objetos
     * 
     * @return TipoProveedor Objeto de tipo identificador que coincide con el identificador suministrado
     */
    public function createSupplierType(string $type, DateTime $createdAt) {
        $supplierTypeIdentifier = "TYPE-SUP-" . $type . "-" . $createdAt;
    }

    /**
     * Obtiene todos los tipos de proveedores
     * 
     * @return TipoProveedor[] Array de objetos de tipo proveedor
     */
    public function getAllTypeSupplier() {
        return $this->typeSupplierData->getAll();
    }
}

?>