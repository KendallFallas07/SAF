


<?php 

/**
 * Manejo de categoria
 * 
 * @param int $idCat Identificador "Auto incremental"
 * @param string $identifierCat Identificador por el cual se realizan consultas a BD
 * @param string $nameCategory Nombre de la categoria
 * @param string $descriptionCat descripcion de la categoria
 * @param DateTime $createdAtCat Fecha en la que se añadió la categoria a la BD
 * @param DateTime $modifiedAtCat Fecha de última modificación de la categoria
 * @param bool $statusCat Indica si la categoria está activo o inactivo
 */



 class Categoria{
    private $idCat;
    private $identifierCat;
    private $nameCategory;
    private $descriptionCat;
    private $createdAtCat;
    private $modifiedAtCat;
    private $statusCat;

   //Constructor
    public function __construct($idCat, $identifierCat, $nameCategory, $descriptionCat, $createdAtCat, $modifiedAtCat, $statusCat) {
        $this->idCat = $idCat;
        $this->identifierCat = $identifierCat;
        $this->nameCategory = $nameCategory;
        $this->descriptionCat = $descriptionCat;
        $this->createdAtCat = $createdAtCat;
        $this->modifiedAtCat = $modifiedAtCat;
        $this->statusCat = $statusCat;
    }
    //Getter and setter
    public function getIdCat(): int {
        return $this->idCat;
    }
    public function setIdCat($idCat) {
        $this->idCat = $idCat;
    }
    public function getIdentifierCat(): string {
        return $this->identifierCat;
    }
    public function setIdentifierCat($identifierCat) {
        $this->identifierCat = $identifierCat;
    }
    public function getNameCategory(): string {
        return $this->nameCategory;
    }
    public function setNameCategory($nameCategory) {
        $this->nameCategory = $nameCategory;
    }
    public function getDescriptionCat(): string {
        return $this->descriptionCat;
    }
    public function setDescriptionCat($descriptionCat) {
        $this->descriptionCat = $descriptionCat;
    }
    public function getCreatedAtCat(): DateTime {
        return $this->createdAtCat;
    }
   /**
     * 
     * @return string
     */
    public function getStrCreatedAtCat(): string {
        return $this->createdAtCat->format('Y-m-d');
    }
    
    public function setCreatedAtCat(DateTime $createdAtCat): void {
        $this->createdAtCat = $createdAtCat;
    }
    public function getModifiedAtCat(): DateTime {
        return $this->modifiedAtCat;
    }
    public function setModifiedAtCat(DateTime $modifiedAtCat): void {
        $this->modifiedAtCat = $modifiedAtCat;
    }
    /**
     * 
     * @return string
     */
    public function getStrModifiedAtCat(): string {
        return $this->modifiedAtCat->format('Y-m-d');
    }
    public function getStatusCat(): bool {
        return $this->statusCat;
    }
    public function setStatusCat(bool $statusCat): void {
        $this->statusCat = $statusCat;
    }

    public function toArray(){
        return [
            'id'=>$this->idCat,
            'identifier' => $this->identifierCat,
            'name' => $this->nameCategory,
            'description' => $this->descriptionCat,
            'created_at' => $this->getStrCreatedAtCat(),
           'modified_at' => $this->getStrModifiedAtCat(),
           'status' => $this->statusCat ? $this->statusCat : 0

        ];
    }

 }
