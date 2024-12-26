


<?php 

/**
 * 
 * @param int $idMargen 
 * @param string $identifierMargen 
 * @param float $porcentaje 
 * @param string $identifierLote 
 * @param string $nameProduct
 * @param DateTime $createdAtMargen
 * @param DateTime $modifiedAtMargen
 * @param bool $statusMargen 
 */



 class MargenGanancia{
    private $idMargen;
    private $identifierMargen;
    private $porcentaje;
    private $identifierLote;
    private $createdAtMargen;
    private $modifiedAtMargen;
    private $statusMargen;

    private $nameProduct;

   //Constructor
    public function __construct($idMargen, $identifierMargen, $porcentaje, $identifierLote, $createdAtMargen, $modifiedAtMargen, $statusMargen) {
    
        $this->idMargen = $idMargen;
        $this->identifierMargen = $identifierMargen;
        $this->porcentaje = $porcentaje;
        $this->identifierLote = $identifierLote;
        $createdAtMargen instanceof DateTime?$this->createdAtMargen = $createdAtMargen : $this->createdAtMargen = new DateTime($createdAtMargen);
        $modifiedAtMargen instanceof DateTime? $this->modifiedAtMargen = $modifiedAtMargen : $this->modifiedAtMargen = new DateTime($modifiedAtMargen);
        $this->statusMargen = $statusMargen;
    
    }

    //Getter and setter
    public function getIdMargen(): int {
        return $this->idMargen;
    }
    public function setIdMargen($idMargen) {
        $this->idMargen = $idMargen;
    }
    public function getIdentifierMargen(): string {
        return $this->identifierMargen;
    }
    public function setIdentifierMargen($identifierMargen) {
        $this->identifierMargen = $identifierMargen;
    }
    public function getPorcentaje(): float {
        return $this->porcentaje;
    }
    public function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }
    public function getIdentifierLote(): string {
        return $this->identifierLote;
    }
    public function setIdentifierLote($identifierLote) {
        $this->identifierLote = $identifierLote;
    }
    public function getCreatedAtMargen(): DateTime {
        return $this->createdAtMargen;
    }
    public function setCreatedAtMargen(DateTime $createdAtMargen): void {
        $this->createdAtMargen = $createdAtMargen;
    }
    public function getModifiedAtMargen(): DateTime {
        return $this->modifiedAtMargen;
    }
    public function setModifiedAtMargen(DateTime $modifiedAtMargen): void {
        $this->modifiedAtMargen = $modifiedAtMargen;
    }
    public function getStatusMargen(): bool {
        return $this->statusMargen;
    }
    public function setStatusMargen($statusMargen): void {
        $this->statusMargen = $statusMargen;
    }
    public function getNameProduct(): string {
        return $this->nameProduct;
    }
    public function setNameProduct($nameProduct): void {
        $this->nameProduct = $nameProduct;
    }
    
 }