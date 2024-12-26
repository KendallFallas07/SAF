<?php

require_once "ControladoraUnidadMedida.php";

require_once "../domain/Presentacion.php";

require_once "ControladoraPresentacion.php";

require_once "../domain/Categoria.php";

require_once "ControladoraCategoria.php";

require_once "../domain/Producto.php";

require_once "../data/ProductoData.php";

/**
 * Controlador de productos
 * 
 * @author Daniel Briones 
 * @version 1.0
 * @since 19-08-24
 */
class ControladoraProducto {

    private $productsData;

    public function __construct()
    {
        $this->productsData = new ProductoData();
    }

    /**
     * Función encargada de guardar el producto en la base de datos.
     * 
     * @param Producto $producto Objeto con los datos del producto que se desean guardar en la BD.
     * 
     * @return bool TRUE si el producto se registro en la base de datos, FALSE si el producto no se registro en la base de datos
     */
    public function saveProduct($product) {
        return $this->productsData->saveProduct($product);
    }

    /**
     * Obtiene el siguiente id disponible para la tabla de productos
     * 
     * @return int $lastId Siguiente id disponible para la tabla productos, en caso de estar vacía, 1
     */
    public function getNextId(){
        return $this->productsData->getNextId();
    }

    /**
    * Obtiene todos los productos que su estado sea activo
    *
    * @return JSON Todos los productos disponibles
    */
    public function findAllProductos() {
        return $this->productsData->findAll();
    }

    public function findByIdentifier($identifier){
        return $this->productsData->findByIdentifier($identifier);
    }

    public function searchProduct($search) {
        return $this->productsData->searchProduct($search);
    }

    /**
     * "Elimina" los datos del producto (cambia el estado a FALSE-Inactivo y la fecha de modificación)
     * 
     * @param Producto $producto Objeto que contiene el id del producto que se desea "Eliminar" y la fecha de modificación
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function deleteProduct($product) {
        return $this->productsData->deleteProduct($product);
    }

    /**
     * Actualiza los datos del producto (nombre, descripción, fecha de modificación)
     * 
     * @param Producto $product Producto con los datos actualizar
     * 
     * @return True|False TRUE en caso de actualizar correctamente el producto, FALSE en caso contrario
     */
    public function updateProduct($product){
        return $this->productsData->updateProduct($product);
    }


    public function createProduct($name, $description, $categoryIdentifier, $unitMIdentifier, $presentationIdentifier, $supplieridentifier) : Producto {
        $createdAt = new DateTime();
        $newProduct = new Producto();

        $categoryController = new ControladoraCategoria();
        $category = new Categoria(0, $categoryIdentifier, "", "", new DateTime(), new DateTime(), 1);

        $presentationController = new PresentacionController();
        $presentation = $presentationController->findById($presentationIdentifier);
        
        $UnitController = new ControladoraUnidadMedida();
        $unitM = $UnitController->findByIdentifier($unitMIdentifier);

        $supplierController = new ControladoraProveedor();
        $supplier = $supplierController->findByIdentifier($supplieridentifier);

        $newProduct->constructorComplete($this->getNextId(), "PROD-" . $createdAt->format('dmYHis'), $name, $description, $categoryController->getCategory($category), $unitM, $presentation, $supplier, $createdAt, $createdAt, true);
        return $newProduct;
    }

    public function existeElNombreDelProducto($nombre, $identificador){
        return $this->productsData->existeElNombreDelProducto($nombre, $identificador);
    }

    public function obtenerProveedoresPorEstado($estado) {
        return $this->productsData->obtenerProveedoresPorEstado($estado);
    }

    public function habilitarProducto($identificador) {
        return $this->productsData->habilitarProducto($identificador);
    }

    public function guardarImagen($productoId, $ruta){
        return $this->productsData->guardarImagen($productoId, $ruta);
    }

    public function getLoteYMargen($identificador){
        return $this->productsData->obtenerLoteYMargenes($identificador);
    }

    public function obtenerImagenesProductos($identificador){
        return $this->productsData->obtenerImagenesDeProducto($identificador);
    }

}