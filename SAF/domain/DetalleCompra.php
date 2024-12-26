<?php

class DetalleCompra {

    private $id;
    private $identifier;
    private $compraId;
    private $productoId;
    private $loteId;
    private $cantidadComprada;
    private $fechaCreacion;
    private $fechaModificacion;

    public function __construct($id, $identifier, $compraId, $productoId, $loteId, $cantidadComprada, $fechaCreacion, $fechaModificacion) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->compraId = $compraId;
        $this->productoId = $productoId;
        $this->loteId = $loteId;
        $this->cantidadComprada = $cantidadComprada;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaModificacion = $fechaModificacion;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    public function getCompraId() {
        return $this->compraId;
    }

    public function setCompraId($compraId) {
        $this->compraId = $compraId;
    }

    public function getProductoId() {
        return $this->productoId;
    }

    public function setProductoId($productoId) {
        $this->productoId = $productoId;
    }

    public function getLoteId() {
        return $this->loteId;
    }

    public function setLoteId($loteId) {
        $this->loteId = $loteId;
    }

    public function getCantidadComprada() {
        return $this->cantidadComprada;
    }

    public function setCantidadComprada($cantidadComprada) {
        $this->cantidadComprada = $cantidadComprada;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion) {
        if ($fechaCreacion instanceof DateTime) {
            $this->fechaCreacion = $fechaCreacion;
        } else {
            $this->fechaCreacion = new DateTime($fechaCreacion);
        }
    }

    public function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion($fechaModificacion) {
        if ($fechaModificacion instanceof DateTime) {
            $this->fechaModificacion = $fechaModificacion;
        } else {
            $this->fechaModificacion = new DateTime($fechaModificacion);
        }
    }
}
