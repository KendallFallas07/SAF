<?php

require_once "Distrito.php";

/**
 * Clase para el manejo de Cantones
 * 
 * @param int $id Identificador "Auto incremental"
 * @param int $provinceId Identificador de la provincia
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $nameCanton Nombre del Cantón
 * @param DateTime $createdAt Fecha en la que se añadió el Cantón a la BD
 * @param DateTime $modifiedAt Fecha de última modificación del Cantón
 * @param bool $status Indica si el Cantón está activo o inactivo
 * @param array $districts Lista de distritos asociados al Cantón
 */
class Canton {

    private $id;
    private $provinceId;
    private $identifier;
    private $nameCanton;
    private $createdAt;
    private $modifiedAt;
    private $status;
    private $districts;

    public function __construct($id, $provinceId, $identifier, $nameCanton, $createdAt, $modifiedAt, $status) {
        $this->id = $id;
        $this->provinceId = $provinceId;
        $this->identifier = $identifier;
        $this->nameCanton = $nameCanton;
        $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        $this->modifiedAt = $modifiedAt instanceof DateTime ? $modifiedAt : new DateTime($modifiedAt);
        $this->status = $status;
        $this->districts = [];
    }

    // Métodos getters y setters
    public function getId(): int {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getProvinceId(): int {
        return $this->provinceId;
    }

    public function setProvinceId($provinceId): void {
        $this->provinceId = $provinceId;
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void {
        $this->identifier = $identifier;
    }

    public function getNameCanton(): string {
        return $this->nameCanton;
    }

    public function setNameCanton($nameCanton): void {
        $this->nameCanton = $nameCanton;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
    }

    /**
     * Retorna la fecha de creación en formato string
     * 
     * @return string
     */
    public function getStrCreatedAt(): string {
        return $this->createdAt->format('Y-m-d');
    }

    public function getModifiedAt(): DateTime {
        return $this->modifiedAt;
    }

    public function setModifiedAt($modifiedAt): void {
        $this->modifiedAt = $modifiedAt instanceof DateTime ? $modifiedAt : new DateTime($modifiedAt);
    }

    /**
     * Retorna la última fecha de modificación en formato string
     * 
     * @return string
     */
    public function getStrModifiedAt(): string {
        return $this->modifiedAt->format('Y-m-d');
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function addDistrict(Distrito $district): void {
        $this->districts[] = $district;
    }

    public function getDistricts(): array {
        return $this->districts;
    }
}
