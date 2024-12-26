
<?php

/**
 * Clase para manejar diferentes tipos de proveedores. Ejemplo: (Fabricante, distribuidor, servicios, etc)
 * 
 * @author Daniel Briones
 * @since 31-07-24
 * @version 1.0
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $nameType Nombre del tipo de proveedor
 * @param DateTime $createdAt Fecha de creación del tipo de proveedor
 * @param DateTime $modifiedAt Fecha de última modificación del tipo de proveedor
 * @param bool $status Indica si el tipo de proveedor está activo o inactivo
 * 
 */
class TipoProveedor {

    private $id;
    private $identifier;
    private $nameType;
    private $createdAt;
    private $modifiedAt;
    private $status;

    public function __construct($id, $identifier, $nameType, DateTime $createdAt, DateTime $modifiedAt, bool $status) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->nameType = $nameType;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    public function getNameType() {
        return $this->nameType;
    }

    public function setNameType($nameType) {
        $this->nameType = $nameType;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Cambia el formato de la fecha de creación (DateTime a string)
     * 
     * @return string $createdAt Retorna la fecha de creación en formato string
     */
    public function getStrCreatedAt(): string {
        return ($this->createdAt !== null) ? $this->createdAt->format('Y-m-d') : "";
    }

    public function setCreatedAt(DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getModifiedAt() {
        return $this->modifiedAt;
    }

    /**
     * Cambia el formato de la última fecha de modificación (DateTime a string)
     * 
     * @return string $modifiedAt Retorna la última fecha de modificación en formato string
     */
    public function getStrModifiedAt(): string {
        return ($this->modifiedAt !== null) ? $this->modifiedAt->format('Y-m-d') : "";
    }

    public function setModifiedAt(DateTime $modifiedAt) {
        $this->modifiedAt = $modifiedAt;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function setStatus(bool $status): void {
        $this->status = $status;
    }

    /**
     * Se encarga de formar un array con todos los datos para usar en un JSON
     * 
     * @return Array Todos los datos de tipo de proveedor para ser utilizados en un JSON
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'nameType' => $this->nameType,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'modifiedAt' => $this->modifiedAt->format('Y-m-d'),
            'status' => $this->status
        ];
    }
}
