<?php

/**
 * Clase para el manejo de dirección de los proveedores
 * 
 * @param int $idDirection Identificador "Auto incremental"
 * @param int $idSupplier Id de la tabla de proveedores, hace referencia al proveedor al cual pertenece la dirección
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param Distrito $district Objeto del tipo District que detalla el distrito del proveedor
 * @param bool $status Indica si la dirección está activa o inactiva
 * @param string $signalDirection: Direccion exacta del proveedor
 * @param DateTime $createdAt Fecha en la que se añadió la dirección a la BD
 * @param DateTime $modifiedAt Fecha de última modificación de la dirección
 */
class DireccionProveedor {

    private $idDirection;
    private $idSupplier;
    private $identifier;
    private $district;
    private $status;
    private $signalDirection;
    private $createdAt;
    private $createModiAt;

    public function __construct($idDirection, $idSupplier, $identifier, $district, $status, $signalDirection, $createdAt, $createModiAt) {
        $this->idDirection = $idDirection;
        $this->idSupplier = $idSupplier;
        $this->identifier = $identifier;
        $this->district = $district;
        $this->status = $status;
        $this->signalDirection = $signalDirection;
        $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        $this->createModiAt = $createModiAt instanceof DateTime ? $createModiAt : new DateTime($createModiAt);
    }

    // Métodos getters y setters
    public function getIdDirection(): int {
        return $this->idDirection;
    }

    public function setIdDirection($idDirection): void {
        $this->idDirection = $idDirection;
    }

    public function getIdSupplier(): int {
        return $this->idSupplier;
    }

    public function setIdSupplier($idSupplier): void {
        $this->idSupplier = $idSupplier;
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void {
        $this->identifier = $identifier;
    }

    public function getDistrict(): Distrito {
        return $this->district;
    }

    public function setDistrict(Distrito $district): void {
        $this->district = $district;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
    }

    public function getStrCreatedAt(): string {
        return $this->createdAt->format('Y-m-d');
    }

    public function getModifiedAt(): DateTime {
        return $this->createModiAt;
    }

    public function setModifiedAt($createModiAt): void {
        $this->createModiAt = $createModiAt instanceof DateTime ? $createModiAt : new DateTime($createModiAt);
    }

    public function getStrModifiedAt(): string {
        return $this->createModiAt->format('Y-m-d');
    }

    public function getSignalDirection(): string {
        return $this->signalDirection;
    }

    public function setSignalDirection($signalDirection): void {
        $this->signalDirection = $signalDirection;
    }

    /**
     * Se encarga de formar un array con todos los datos para usar en un JSON
     * 
     * @return Array Todos los datos de la dirección del proveedor para ser utilizados en un JSON
     */
    public function toArray() {
        return [
            'id' => $this->idDirection,
            'identifier' => $this->identifier,
            'idSupplier' => $this->idSupplier,
            'distict' => $this->getDistrict() ? $this->getDistrict()->toArray() : null,
            'signalDirection' => $this->signalDirection,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'modifiedAt' => $this->createModiAt->format('Y-m-d'),
            'status' => $this->status
        ];
    }
}
