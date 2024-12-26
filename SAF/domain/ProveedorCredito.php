<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ProveedorCredito
 *
 * @author ceasarcalvo
 */
class ProveedorCredito {
    private $proveedorCId;
    private $tbproveedorid;
    private $proveedorCIdentificador;
    private $proveedorCCantidadCredito;
    private $proveedorCPorcentaje;
    private $proveedorCPlazo;
    private $proveedorCFechaInicio;
    private $proveedorCFechaVencimiento;
    private $fechaCreacion;
    private $fechaEdicion;
    private $proveedorCEstado;
    
    public function __construct($proveedorCId, $tbproveedorid, $proveedorCIdentificador, $proveedorCCantidadCredito, $proveedorCPorcentaje, $proveedorCPlazo, $proveedorCFechaInicio, $proveedorCFechaVencimiento, $fechaCreacion, $fechaEdicion, $proveedorCEstado) {
        $this->proveedorCId = $proveedorCId;
        $this->tbproveedorid = $tbproveedorid;
        $this->proveedorCIdentificador = $proveedorCIdentificador;
        $this->proveedorCCantidadCredito = $proveedorCCantidadCredito;
        $this->proveedorCPorcentaje = $proveedorCPorcentaje;
        $this->proveedorCPlazo = $proveedorCPlazo;
        $this->proveedorCFechaInicio = $proveedorCFechaInicio;
        $this->proveedorCFechaVencimiento = $proveedorCFechaVencimiento;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaEdicion = $fechaEdicion;
        $this->proveedorCEstado = $proveedorCEstado;
    }

    public function getProveedorCId() {
        return $this->proveedorCId;
    }

    public function getTbproveedorid() {
        return $this->tbproveedorid;
    }

    public function getProveedorCIdentificador() {
        return $this->proveedorCIdentificador;
    }

    public function getProveedorCCantidadCredito() {
        return $this->proveedorCCantidadCredito;
    }

    public function getProveedorCPorcentaje() {
        return $this->proveedorCPorcentaje;
    }

    public function getProveedorCPlazo() {
        return $this->proveedorCPlazo;
    }

    public function getProveedorCFechaInicio() {
        return $this->proveedorCFechaInicio;
    }

    public function getProveedorCFechaVencimiento() {
        return $this->proveedorCFechaVencimiento;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function getFechaEdicion() {
        return $this->fechaEdicion;
    }

    public function getProveedorCEstado() {
        return $this->proveedorCEstado;
    }

    public function setProveedorCId($proveedorCId): void {
        $this->proveedorCId = $proveedorCId;
    }

    public function setTbproveedorid($tbproveedorid): void {
        $this->tbproveedorid = $tbproveedorid;
    }

    public function setProveedorCIdentificador($proveedorCIdentificador): void {
        $this->proveedorCIdentificador = $proveedorCIdentificador;
    }

    public function setProveedorCCantidadCredito($proveedorCCantidadCredito): void {
        $this->proveedorCCantidadCredito = $proveedorCCantidadCredito;
    }

    public function setProveedorCPorcentaje($proveedorCPorcentaje): void {
        $this->proveedorCPorcentaje = $proveedorCPorcentaje;
    }

    public function setProveedorCPlazo($proveedorCPlazo): void {
        $this->proveedorCPlazo = $proveedorCPlazo;
    }

    public function setProveedorCFechaInicio($proveedorCFechaInicio): void {
        $this->proveedorCFechaInicio = $proveedorCFechaInicio;
    }

    public function setProveedorCFechaVencimiento($proveedorCFechaVencimiento): void {
        $this->proveedorCFechaVencimiento = $proveedorCFechaVencimiento;
    }

    public function setFechaCreacion($fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function setFechaEdicion($fechaEdicion): void {
        $this->fechaEdicion = $fechaEdicion;
    }

    public function setProveedorCEstado($proveedorCEstado): void {
        $this->proveedorCEstado = $proveedorCEstado;
    }

        
    public function toArray() {
        return [
            'id' => $this->proveedorCId,
            'tbproveedorid' => $this->tbproveedorid,
            'identificador' => $this->proveedorCIdentificador,
            'cantidadCredito' => $this->proveedorCCantidadCredito,
            'porcentaje' => $this->proveedorCPorcentaje,
            'plazo' => $this->proveedorCPlazo,
            'fechaInicio' => $this->proveedorCFechaInicio->format('Y-m-d'),
            'fechaVencimiento' => $this->proveedorCFechaVencimiento->format('Y-m-d'),
            'fechaCreacion' => $this->fechaCreacion->format('Y-m-d'),
            'fechaEdicion' => $this->fechaEdicion->format('Y-m-d'),
            'estado' => $this->proveedorCEstado
        ];
    }

}
