<?php

/**
 * Clase para el manejo de Distritos de los proveedores
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $nameDistric para el nombre del pais
 * @param DateTime $createdAt Fecha en la que se añadió el Distrito a la BD
 * @param DateTime $modifiedAt Fecha de última modificación del Distrito
 * @param bool $status Indica si el distrito está activo o inactivo
 * @param string $details Detalla la ubicación exacta donde se encuentra el proveedor en el distrito
 * @param string $postalcode Detalla el codigo postal del Distrito
 * @param int $identCanton: identificado del canton
 */

class Distrito {

    private $id;
    private $identifier;
    private $nameDistric;
    private $createdAt;
    private $modifiedAt;
    private $status;
    private $details;
    private $postalcode;
    private $identCanton;

    public function __construct($id, $identifier, $nameDistric, $createdAt, $modifiedAt, $status, $details, $postalcode, $identCanton) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->nameDistric = $nameDistric;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
        $this->details = $details;
        $this->postalcode = $postalcode;
        $this->identCanton = $identCanton;
    }

    // Métodos getters y setters
    public function getId(): int {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void {
        $this->identifier = $identifier;
    }

    public function getNameDistric(): string {
        return $this->nameDistric;
    }

    public function setNameDistric($nameDistric): void {
        $this->nameDistric = $nameDistric;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

    /**
     * Cambia el formato de la fecha de creación (DateTime a string)
     * 
     * @return string $createdAt Retorna la fecha de creación en formato string
     */
    public function getStrCreatedAt(): string {
        return ($this->createdAt !== null) ? $this->createdAt->format('Y-m-d') : "";
    }

    public function getModifiedAt(): DateTime {
        return $this->modifiedAt;
    }

    public function setModifiedAt($modifiedAt): void {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * Cambia el formato de la última fecha de modificación (DateTime a string)
     * 
     * @return string $modifiedAt Retorna la última fecha de modificación en formato string
     */
    public function getStrModifiedAt(): string {
        return ($this->modifiedAt !== null) ? $this->modifiedAt->format('Y-m-d') : "";
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function getDetails(): string {
        return $this->details;
    }

    public function setDetails($details): void {
        $this->details = $details;
    }

    public function getPostalCode(): string {
        return $this->postalcode;
    }

    public function setPostalCode($postalcode): void {
        $this->postalcode = $postalcode;
    }

    public function getIdentCanton(): int {
        return $this->identCanton;
    }

    public function setIdentCanton($identCanton): void {
        $this->identCanton = $identCanton;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'nameDistrict' => $this->nameDistric,
            'details' => $this->details,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'modifiedAt' => $this->modifiedAt->format('Y-m-d'),
            'status' => $this->status,
            'postalCode' => $this->postalcode
        ];
    }
}

?>
