<?php

/**
 * Clase para el manejo de Países de los proveedores
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $nameCountry para el nombre del pais
 * @param DateTime $createdAt Fecha en la que se añadió el pais a la BD
 * @param DateTime $modifiedAt Fecha de última modificación del pais
 * @param bool $status Indica si el pais está activo o inactivo
 * @param array $provinceList: lista de provincia del pais
 * 
 */

class Pais {

    private $id;
    private $identifier;
    private $nameCountry;
    private $createdAt;
    private $modifiedAt;
    private $status;
    private $provinceList;

    public function __construct($id, $identifier, $nameCountry, $createdAt, $modifiedAt, $status) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->nameCountry = $nameCountry;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
        $this->provinceList = [];
    }

    //Métodos getters y setters
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

    public function getNameCountry(): string {
        return $this->nameCountry;
    }

    public function setNameCountry($nameCountry): void {
        $this->nameCountry = $nameCountry;
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

    public function addProvince(Provincia $province): void {
        $this->provinceList[] = $province;
    }

    public function getProvinceList(): array {
        return $this->provinceList;
    }
}
