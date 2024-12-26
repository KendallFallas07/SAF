
<?php

/**
 * Clase para manajar información de los proveedores
 * 
 * @author Daniel Briones
 * @since 31-07-24
 * @version 1.0
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $name Nombre del proveedor. (Nombre de la empresa o nombre completo del individuo)
 * @param TelefonoProveedor $phone Número de teléfono de contacto del proveedor
 * @param CorreoProveedor $email Correo electrónico del proveedor
 * @param TipoProveedor $supplierType Tipo de proveedor. Ejemplo: (Fabricante, distribuidor, servicios, etc)
 * @param DireccionProveedor $supplierDirection Dirección en la que se encuentra ubicado el proveedor
 * @param DateTime $createdAt Fecha en la que se añadió el proveedor a la BD
 * @param DateTime $modifiedAt Fecha de última modificación del proveedor
 * @param bool $status Indica si el proveedor está activo o inactivo
 * 
 */
class Proveedor {

    private $id;
    private $identifier;
    private $name;
    private TelefonoProveedor $phone;
    private CorreoProveedor $email;
    private TipoProveedor $supplierType;
    private DireccionProveedor $supplierDirection;
    private $createdAt;
    private $modifiedAt;
    private $status;

    public function __construct(
            int $id,
            string $identifier,
            string $name,
            TelefonoProveedor $phone,
            CorreoProveedor $email,
            TipoProveedor $supplierType,
            DireccionProveedor $supplierDirection,
            DateTime $createdAt,
            DateTime $modifiedAt,
            bool $status
    ) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->supplierType = $supplierType;
        $this->supplierDirection = $supplierDirection;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
    }

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

    public function getName(): string {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function getPhone(): TelefonoProveedor {
        return $this->phone;
    }

    public function setPhone(TelefonoProveedor $phone): void {
        $this->phone = $phone;
    }

    public function getEmail(): CorreoProveedor {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function getSupplierType(): TipoProveedor {
        return $this->supplierType;
    }

    public function setSupplierType(TipoProveedor $supplierType): void {
        $this->supplierType = $supplierType;
    }

    public function getSupplierDirection(): DireccionProveedor {
        return $this->supplierDirection;
    }

    public function setSupplierDirection(DireccionProveedor $supplierDirection): void {
        $this->supplierDirection = $supplierDirection;
    }

    public function getCreatedAt(): DateTime {
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

    public function setCreatedAt(DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getModifiedAt(): DateTime {
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

    public function setModifiedAt(DateTime $modifiedAt): void {
        $this->modifiedAt = $modifiedAt;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    /**
     * Se encarga de formar un array con todos los datos para usar en un JSON
     * 
     * @return Array Todos los datos del proveedor para ser utilizados en un JSON
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'name' => $this->name,
            'phone' => $this->phone ? $this->phone->toArray() : null,
            'email' => $this->email ? $this->email->toArray() : null,
            'supplierType' => $this->supplierType ? $this->supplierType->toArray() : null,
            'supplierDirection' => $this->supplierDirection ? $this->supplierDirection->toArray() : null,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'modifiedAt' => $this->modifiedAt->format('Y-m-d'),
            'status' => $this->status
        ];
    }
}

?>