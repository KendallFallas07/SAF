<?php

require_once '../data/SubcategoriaData.php';
require_once '../domain/Subcategoria.php';


class ControladoraSubcategoria {
    private $subcategoriaData;

    public function __construct() {
        $this->subcategoriaData = new SubcategoriaData();
    }

    public function guardar(Subcategoria $subcategoria): bool {
        return $this->subcategoriaData->saveSubcategory($subcategoria);
    }

    public function ObtenerSubcategorias() {
        return $this->subcategoriaData->getAllSubCategories();
    }

    public function obtenerSIguienteId() {
        return $this->subcategoriaData->getNextIdSubCat();
    }

    public function buscarPorFiltro($busqueda) {
        return $this->subcategoriaData->getSubcategoriesByFilter($busqueda);
    }

    public function obtenerCategoriaPorIdentificador($identificador) {
        return $this->subcategoriaData->getCategoryByIdentifier($identificador);
    }

    public function eliminar($id) {
        return $this->subcategoriaData->deleteSubcategory($id);
    }

    public function obtenerSubcategoriaPorId($id) {
        return $this->subcategoriaData->getOnlySubCat($id);
    }

    public function actualizar(Subcategoria $subcategoria) {
        return $this->subcategoriaData->updateSubcategory($subcategoria);
    }

    public function obtenerSubcategoriasDeshabilitadas() {
        return $this->subcategoriaData->getAllSubCategoriesDisable();
    }

    public function habilitar($id) {
        return $this->subcategoriaData->activateLastSubcategory($id);
    }

    public function buscarDEshabilitadas($text){
        return $this->subcategoriaData->getAllSubCategoriesDisableByFilter($text);
    }

    public function autocompletar($text){
        return $this->subcategoriaData->autocompleteSubcategories($text);
    }

    public function validarNombre ($name,$identifier){
        return $this->subcategoriaData->validateSubcategoryName($name,$identifier);
    }

    public function obtenerNombresSubcategorias (){
        return $this->subcategoriaData->obtenerNombres();
    }
    
    

}