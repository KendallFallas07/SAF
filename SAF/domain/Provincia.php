<?php



/**
 * Clase para el manejo de las provincias de los proveedores
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identifier Identificador por el cual se realizan consultas a BD
 * @param string $nameProv para el nombre de la provincia
 * @param DateTime $createdAt Fecha en la que se añadió la provincia a la BD
 * @param DateTime $modifiedAt Fecha de última modificación de la provincia
 * @param bool $status Indica si la provincia está activo o inactivo
 * @param array  $canton: se necesita agregar cantones a la provincia
 * @param int $idCountry: pais asociado a la provincia
 * 
 */
class Provincia {
    private $id;
    private $identifier;
    private $nameProv;
    private $createdAt;
    private $modifiedAt;
    private $status;
    private array $canton;
    private $idCountry;

    public function __construct($id, $identifier, $nameProv, $createdAt, $modifiedAt, $status, $idCountry) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->nameProv = $nameProv;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->status = $status;
        $this->canton = []; // Inicializar como un array vacío
        $this->idCountry = $idCountry; 
    }

    // Método para convertir la instancia a un array
    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'nameProv' => $this->nameProv,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'modifiedAt' => $this->modifiedAt->format('Y-m-d H:i:s'),
            'status' => $this->status,
            'canton' => $this->canton // Asumiendo que $canton ya es un array
        ];
    }

    // Métodos getters y setters
    public function getId(): int { return $this->id; }
    public function setId($id): void { $this->id = $id; }

    public function getIdentifier(): string { return $this->identifier; }
    public function setIdentifier($identifier): void { $this->identifier = $identifier; }

    public function getNameProv(): string { return $this->nameProv; }
    public function setNameProv($nameProv): void { $this->nameProv = $nameProv; }

    public function getCreatedAt(): DateTime { return $this->createdAt; }
    public function setCreatedAt($createdAt): void { $this->createdAt = $createdAt; }

    public function getStrCreatedAt(): string {
        return ($this->createdAt !== null) ? $this->createdAt->format('Y-m-d') : "";
    }

    public function getModifiedAt(): DateTime { return $this->modifiedAt; }
    public function setModifiedAt($modifiedAt): void { $this->modifiedAt = $modifiedAt; }

    public function getStrModifiedAt(): string {
        return ($this->modifiedAt !== null) ? $this->modifiedAt->format('Y-m-d') : "";
    }

    public function getStatus(): bool { return $this->status; }
    public function setStatus($status): void { $this->status = $status; }

    public function addCanton(Canton $canton): void { $this->canton[] = $canton; }
    public function getCantons(): array { return $this->canton; }
    
    public function getIdCountry(): int { return $this->idCountry; }
    public function setIdCountry($idCountry): void { $this->idCountry = $idCountry; }


}
