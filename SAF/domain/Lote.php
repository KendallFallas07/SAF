<?php

/**
 * Clase para el manejo de Lotes
 * 
 * @param int $id Identificador "Auto incremental"
 * @param string $identificador Identificador por el cual se realizan consultas a BD
 * @param int $tbProductoId Identificador del producto asociado
 * @param string $tbProductoName Nombre del producto asociado
 * @param int $cantidadAdquirida Cantidad adquirida del producto
 * @param int $cantidadActual Cantidad actual del producto en el lote
 * @param float $precioCompra Precio de compra del producto
 * @param int $porcentaje Precio de venta del producto
 * @param DateTime $fechaAdquisicion Fecha de adquisición del lote
 * @param DateTime $fechaExpiracion Fecha de expiración del lote
 * @param DateTime $fechaCreacion Fecha en la que se creó el lote en la BD
 * @param DateTime $fechaModificacion Fecha de última modificación del lote
 * @param bool $estado resultado
 * @param bool $estado Indica si el lote está activo o inactivo
 */


class Lote {

    private $id;
    private $identificador;
    private $tbProductoId;
    private $tbProductoName;
    private $cantidadAdquirida;
    private $cantidadActual;
    private $precioCompra;
    private $porcentaje;
    private $fechaAdquisicion;
    private $fechaExpiracion;
    private $fechaCreacion;
    private $fechaModificacion;
    private $estado;
    private $resultado;

    public function __construct($id, $identificador, $tbProductoId, $cantidadAdquirida, $cantidadActual, $precioCompra, $fechaAdquisicion, $fechaExpiracion, $fechaCreacion, $fechaModificacion, $estado) {
        $this->id = $id;
        $this->identificador = $identificador;
        $this->tbProductoId = $tbProductoId;
        $this->cantidadAdquirida = $cantidadAdquirida;
        $this->cantidadActual = $cantidadActual;
        $this->precioCompra = $precioCompra;
        $this->fechaAdquisicion = $fechaAdquisicion;
        $this->fechaExpiracion = $fechaExpiracion;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaModificacion = $fechaModificacion;
        $this->estado = $estado;
    }

    // Métodos getters y setters
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdentificador(){
        return $this->identificador;
    }

    public function setIdentificador($identificador){
        $this->identificador = $identificador;
    }

    public function getTbProductoId(): string{
        return $this->tbProductoId;
    }

    public function setTbProductoId($tbProductoId){
        $this->tbProductoId = $tbProductoId;
    }

    public function getTbProductoName(){
        return $this->tbProductoName;
    }

    public function setTbProductoName($tbProductoName){
        $this->tbProductoName = $tbProductoName;
    }

    public function getCantidadAdquirida() {
        return $this->cantidadAdquirida;
    }

    public function setCantidadAdquirida($cantidadAdquirida){
        $this->cantidadAdquirida = $cantidadAdquirida;
    }

    public function getCantidadActual() {
        return $this->cantidadActual;
    }

    public function setCantidadActual($cantidadActual){
        $this->cantidadActual = $cantidadActual;
    }

    public function getPrecioCompra(){
        return $this->precioCompra;
    }

    public function setPrecioCompra($precioCompra){
        $this->precioCompra = $precioCompra;
    }

    public function getPrecioPorcentaje(){
        return $this->porcentaje;
    }

    public function setPrecioPorcentaje($porcentaje){
        $this->porcentaje = $porcentaje;
    }

    public function getFechaAdquisicion() {
        return $this->fechaAdquisicion;
    }

    public function setFechaAdquisicion($fechaAdquisicion){
        $this->fechaAdquisicion = $fechaAdquisicion;
    }

    public function getFechaExpiracion() {
        return $this->fechaExpiracion;
    }

    public function setFechaExpiracion($fechaExpiracion){
        $this->fechaExpiracion = $fechaExpiracion;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion){
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion($fechaModificacion){
        $this->fechaModificacion = $fechaModificacion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getResultado(){
        return $this->resultado;
    }

    public function setResultado($resultado){
        $this->estado = $resultado;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identificador,
            'name' => $this->tbProductoId,
            'cantidadAd' => $this->cantidadAdquirida,
            'precioCompra' => $this->precioCompra,
            'fechaAdquisicion' => $this->fechaAdquisicion,
            'fechaExpiracion' => $this->fechaExpiracion
        ];
    }
    
}