<?php

/**
 * Manejo de subCategoria
 * 
 * @param int $idSubCat Identificador "Auto incremental"
 * @param string $identifierSubCat Identificador por el cual se realizan consultas a BD
 * @param string $identifierCat 
 * @param string $nameSubcategory Nombre de la subCategoria
 * @param string $descriptionSubcat Descripción de la Subcategoria
 * @param DateTime $createdAtSubcat Fecha en la que se añadió la Subcategoria a la BD
 * @param DateTime $modifiedAtSubcat Fecha de última modificación de la Subcategoria
 * @param bool $statusSubcat Indica si la Subcategoria está activa o inactiva
 * @param string $categoryName
 */
class Subcategoria {
    private $idSubCat;
    private $identifierCat;
    private $identifierSubCat;
    private $nameSubcategory;
    private $descriptionSubcat;
    private $createdAtSubcat;
    private $modifiedAtSubcat;
    private $statusSubcat;

    private $categoryName;

    

    // Constructor
    public function __construct(
        $idSubCat,
        $identifierCat,
        $identifierSubCat,
        $nameSubcategory,
        $descriptionSubcat,
        DateTime $createdAtSubcat,
        DateTime $modifiedAtSubcat,
        $statusSubcat
    ) {
        $this->idSubCat = $idSubCat;
        $this->identifierCat = $identifierCat;
        $this->identifierSubCat = $identifierSubCat;
        $this->nameSubcategory = $nameSubcategory;
        $this->descriptionSubcat = $descriptionSubcat;
        $this->createdAtSubcat = $createdAtSubcat;
        $this->modifiedAtSubcat = $modifiedAtSubcat;
        $this->statusSubcat = $statusSubcat;
    }

    // Getters
    public function getIdSubCat() {
        return $this->idSubCat;
    }

    public function getIdentifierCat() {
        return $this->identifierCat;
    }

    public function getIdentifierSubCat() {
        return $this->identifierSubCat;
    }

    public function getNameSubcategory() {
        return $this->nameSubcategory;
    }

    public function getDescriptionSubcat() {
        return $this->descriptionSubcat;
    }

    public function getCreatedAtSubcat() {
        return $this->createdAtSubcat;
    }

    public function getModifiedAtSubcat() {
        return $this->modifiedAtSubcat;
    }

    public function getStatusSubcat() {
        return $this->statusSubcat;
    }

    // Setters
    public function setIdSubCat($idSubCat) {
        $this->idSubCat = $idSubCat;
    }

    public function setIdentifierCat($identifierCat) {
        $this->identifierCat = $identifierCat;
    }

    public function setIdentifierSubCat($identifierSubCat) {
        $this->identifierSubCat = $identifierSubCat;
    }

    public function setNameSubcategory($nameSubcategory) {
        $this->nameSubcategory = $nameSubcategory;
    }

    public function setDescriptionSubcat($descriptionSubcat) {
        $this->descriptionSubcat = $descriptionSubcat;
    }

    public function setCreatedAtSubcat(DateTime $createdAtSubcat) {
        $this->createdAtSubcat = $createdAtSubcat;
    }

    public function setModifiedAtSubcat(DateTime $modifiedAtSubcat) {
        $this->modifiedAtSubcat = $modifiedAtSubcat;
    }

    public function setStatusSubcat($statusSubcat) {
        $this->statusSubcat = $statusSubcat;
    }

    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }
}

