<?php

class ClienteCredito{

    private $clienteCId;
	private $clienteId;
    private $clienteCIdentificador;
    private $clienteCantidadCredito;
    private $clienteCPorcentaje;
    private $clienteCPlazo;
    private $clienteCFechaInicio;
    private $clienteCFechaVencimiento;
    private $creadoEn;
    private $editadoEn;
    private $clienteCEstado;

	public function __construct($clienteCId, $clienteId,$clienteCIdentificador, $clienteCantidadCredito, $clienteCPorcentaje, $clienteCPlazo,$clienteCFechaInicio, $clienteCFechaVencimiento, $creadoEn, $editadoEn, $clienteCEstado) {

		$this->clienteCId = $clienteCId;
		$this->clienteId = $clienteId;
		$this->clienteCIdentificador = $clienteCIdentificador;
		$this->clienteCantidadCredito = $clienteCantidadCredito;
		$this->clienteCPorcentaje = $clienteCPorcentaje;
		$this->clienteCPlazo = $clienteCPlazo;
		$this->clienteCFechaInicio = $clienteCFechaInicio;
		$this->clienteCFechaVencimiento = $clienteCFechaVencimiento;
		$this->creadoEn = $creadoEn;
		$this->editadoEn = $editadoEn;
		$this->clienteCEstado = $clienteCEstado;
	}

	public function getClienteCId() {
		return $this->clienteCId;
	}

	public function getClienteId() {
		return $this->clienteId;
	}

	public function setClienteCId($value) {
		$this->clienteCId = $value;
	}

	public function getClienteCIdentificador() {
		return $this->clienteCIdentificador;
	}

	public function setClienteCIdentificador($value) {
		$this->clienteCIdentificador = $value;
	}

	public function getClienteCantidadCredito() {
		return $this->clienteCantidadCredito;
	}

	public function setClienteCantidadCredito($value) {
		$this->clienteCantidadCredito = $value;
	}

	public function getClienteCPorcentaje() {
		return $this->clienteCPorcentaje;
	}

	public function setClienteCPorcentaje($value) {
		$this->clienteCPorcentaje = $value;
	}

	public function getClienteCPlazo() {
		return $this->clienteCPlazo;
	}

	public function setClienteCPlazo($value) {
		$this->clienteCPlazo = $value;
	}

	public function getClienteCFechaInicio() {
		return $this->clienteCFechaInicio;
	}

	public function setClienteCFechaInicio($value) {
		$this->clienteCFechaInicio = $value;
	}

	public function getClienteCFechaVencimiento() {
		return $this->clienteCFechaVencimiento;
	}

	public function setClienteCFechaVencimiento($value) {
		$this->clienteCFechaVencimiento = $value;
	}

	public function getCreadoEn() {
		return $this->creadoEn;
	}

	public function setCreadoEn($value) {
		$this->creadoEn = $value;
	}

	public function getEditadoEn() {
		return $this->editadoEn;
	}

	public function setEditadoEn($value) {
		$this->editadoEn = $value;
	}

	public function getClienteCEstado() {
		return $this->clienteCEstado;
	}

	public function setClienteCEstado($value) {
		$this->clienteCEstado = $value;
	}
}