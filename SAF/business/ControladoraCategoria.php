<?php

include_once "../data/CategoriaData.php";

include_once "../domain/Categoria.php";


class ControladoraCategoria{

private $categoryData;

    public function __construct() {
        $this->categoryData = new CategoriaData();
    }

    public function insert(Categoria $category): bool {
        return $this->categoryData->saveCategory($category);
    }

    public function getAllCategories() {
        return $this->categoryData->getAllCategories();
    }

    public function validationName($name, $value){
        return $this->categoryData->validateName($name, $value);
    }

    public function deleteCategory(Categoria $category):bool{
        return $this->categoryData->deleteCategory($category);
    }

    public function nextIdCat(){
        return $this->categoryData->getNextIdCat();
    }

    public function getCategory(Categoria $category): Categoria {
        return $this->categoryData->getCategory($category);
    }

    public function updateCategory(Categoria $category): bool {
        return $this->categoryData->updateCategory($category);
    }

    public function getCategoryByFilter($search){
        return $this->categoryData->getCategoriesByFilter($search);
    }

    public function getCategoryById($id){
        return $this->categoryData->getCategoryById($id);
    }

    public function getCategoryByIdentifier($identifier){
        return $this->categoryData->getCategoryByIdentifier($identifier);
    }

    public function getDisableCategory(){
        return $this->categoryData->getAllCategoriesDisable();
    }

    public function getActivateLastCategory($categoryIdent):bool{
        return $this->categoryData->activateLastCategory($categoryIdent);
    }

    public function getdisableFilt($text){
   return $this->categoryData->getAllCategoriesDisablefilt($text);
    }

    public function autocompletar($text){
        return $this->categoryData->autocompleteCategories($text);
    }

    public function getNameCat(){
        return $this->categoryData->obtenerNombres();
    }

}