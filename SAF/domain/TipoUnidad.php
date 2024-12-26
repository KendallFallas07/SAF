<?php

/**
 * Manejo del tipo de unidad
 * 
 * @param int $idUnit Identificador "Auto incremental"
 * @param string $identifierTU Identificador por el cual se realizan consultas a BD
 * @param string $nameUnit Nombre de la unidad
 * @param string $descriptionUnir descripcion de la unidad
 * @param DateTime $createdAtUnit Fecha en la que se añadió la unidad a la BD
 * @param DateTime $modifiedAtUnit Fecha de última modificación de la unidad
 * @param bool $statusUnit Indica si la unidad está activo o inactivo
 */

class TipoUnidad {

    private $idUnit;
    private $identifierTU;
    private $nameUnit;
    private $descriptionUnit;
    private $createdAtUnit;
    private $modifiedAtUnit;
    private $statusUnit;

    public function __construct($idUnit, $identifierTU, $name, $description, $createdAt, $modifiedAt, $status) {
        $this->idUnit = $idUnit;
        $this->identifierTU = $identifierTU;
        $this->nameUnit = $name;
        $this->descriptionUnit = $description;
        $this->createdAtUnit = $createdAt;
        $this->modifiedAtUnit = $modifiedAt;
        $this->statusUnit = $status;
    }

    // Getters y Setters
    public function getIdUnit(): int {
        return $this->idUnit;
    }

    public function setIdUnit($idUnit) {
        $this->idUnit = $idUnit;
    }

    public function getIdentifierTU(): string {
        return $this->identifierTU;
    }

    public function setIdentifierTU($identifierTU) {
        $this->identifierTU = $identifierTU;
    }

    public function getNameUnit(): string {
        return $this->nameUnit;
    }

    public function setNameUnit($nameUnit) {
        $this->nameUnit = $nameUnit;
    }

    public function getDescriptionUnit(): string {
        return $this->descriptionUnit;
    }

    public function setDescriptionUnit($descriptionUnit) {
        $this->descriptionUnit = $descriptionUnit;
    }

    public function getCreatedAtUnit(): DateTime {
        return $this->createdAtUnit;
    }

    public function setCreatedAtUnit($createdAtUnit) {
        $this->createdAtUnit = $createdAtUnit;
    }

    public function getModifiedAtUnit(): DateTime {
        return $this->modifiedAtUnit;
    }

    public function setModifiedAtUnit($modifiedAtUnit) {
        $this->modifiedAtUnit = $modifiedAtUnit;
    }

    public function getStatusUnit(): bool {
        return $this->statusUnit;
    }

    public function setStatusUnit($statusUnit) {
        $this->statusUnit = $statusUnit;
    }

    public function getStrCreatedAtUnit(): string {
        return $this->createdAtUnit->format('Y-m-d');
    }

    public function getStrModifiedAtUnit(): string {
        return $this->modifiedAtUnit->format('Y-m-d');
    }

    public function toArray() {
        return [
            'id' => $this->idUnit,
            'identifier' => $this->identifierTU,
            'name' => $this->nameUnit,
            'description' => $this->descriptionUnit,
            'created_at' => $this->getStrCreatedAtUnit(),
            'modified_at' => $this->getStrModifiedAtUnit(),
            'status' => $this->statusUnit ? 'Activo' : 'Inactivo'
        ];
    }
}
