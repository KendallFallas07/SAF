<?php
date_default_timezone_set('America/Costa_Rica');
class Factura {
    private $idFactura;
    private $identificadorFactura;
    private $venta;
    private $creadoEn;
    private $modificadoEn;
    private $urlFactura;
    private $estado;
    private $strCreadoEn;
    private $strModificadoEn;

    public function __construct() {
        $createdAt = new DateTime();
        $this->idFactura = 0;
        $this->identificadorFactura = "FAC-" . time();
        $this->venta = null;
        $this->urlFactura = "";
        $this->estado = 1;
        $this->creadoEn = $createdAt;
        $this->modificadoEn = $createdAt;
        $this->strCreadoEn = $createdAt->format('Y-m-d H:i:s');
        $this->strModificadoEn = $createdAt->format('Y-m-d H:i:s');
    }

    public function getIdFactura() {
        return $this->idFactura;
    }

    public function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    public function getIdentificadorFactura() {
        return $this->identificadorFactura;
    }

    public function setIdentificadorFactura($identificadorFactura) {
        $this->identificadorFactura = $identificadorFactura;
    }

    public function getVenta() {
        return $this->venta;
    }

    public function setVenta($venta) {
        $this->venta = $venta;
    }

    public function getCreadoEn() {
        return $this->creadoEn;
    }

    public function setCreadoEn($creadoEn) {
        $this->creadoEn = $creadoEn;
        $this->strCreadoEn = $creadoEn->format('Y-m-d H:i:s');
    }

    public function getModificadoEn() {
        return $this->modificadoEn;
    }

    public function setModificadoEn($modificadoEn) {
        $this->modificadoEn = $modificadoEn;
        $this->strModificadoEn = $modificadoEn->format('Y-m-d H:i:s');
    }

    public function getUrlFactura() {
        return $this->urlFactura;
    }

    public function setUrlFactura($urlFactura) {
        $this->urlFactura = $urlFactura;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getStrCreadoEn() {
        return $this->strCreadoEn;
    }

    public function setStrCreadoEn($strCreadoEn) {
        $this->strCreadoEn = $strCreadoEn;
    }

    public function getStrModificadoEn() {
        return $this->strModificadoEn;
    }

    public function setStrModificadoEn($strModificadoEn) {
        $this->strModificadoEn = $strModificadoEn;
    }
}

?>
