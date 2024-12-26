
<?php

/**
 * Clase para el manejo de correos electrónicos de los proveedores
 * 
 * @author Daniel Briones
 * @since 31-07-24
 * @version 1.0
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param int $idSupplier Id de la tabla de proveedores, hace referencia al proveedor al cual pertenece el correo electrónico
 * @param string $email Correo electrónico del proveedor
 * @param DateTime $createdAt Fecha en la que se añadió el correo electrónico a la BD
 * @param DateTime $modifiedAt Fecha de última modificación del correo electrónico
 * @param bool $status Indica si el correo electrónico está activo o inactivo
 * 
 */
class CorreoProveedor {

    private $id;
    private $identifier;
    private $idSupplier;
    private $email;
    private $createdAt;
    private $modifiedAt;
    private $status;

    public function __construct(int $id, string $identifier, int $idSupplier, string $email, DateTime $createdAt, DateTime $modifiedAt, bool $status) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->idSupplier = $idSupplier;
        $this->email = $email;
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

    public function getIdSupplier(): int {
        return $this->idSupplier;
    }

    public function setIdSupplier($idSupplier): void {
        $this->idSupplier = $idSupplier;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
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

    public function getModifiedAtAt(): DateTime {
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
        $this->createdAt = $modifiedAt;
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
     * @return Array Todos los datos del correo para ser utilizados en un JSON
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'idSupplier' => $this->idSupplier,
            'email' => $this->email,
            'createdAt' => $this->createdAt->format('Y-m-d'),
            'modifiedAt' => $this->modifiedAt->format('Y-m-d'),
            'status' => $this->status
        ];
    }
}
