<?php
/**
 * Description of Articulo
 *
 * @author BrayRPGs
 * fecha de modificacion 12/08/2024
 */

class Articulo {
    private $id;
    private $identificador;
    private $nombre;
    private $proveedor;
    private $estado;
    //private $catagoria;
    private $presentación;
    private $precio;
    private $fechasDeVencimiento;
    private $codigoDeBarras;
    
    //
    public function __construct($id, $identificador, $nombre, $proveedor, $estado, $presentación, $precio, $fechasDeVencimiento, $codigoDeBarras) {
        $this->id = $id;
        $this->identificador = $identificador;
        $this->nombre = $nombre;
        $this->proveedor = $proveedor;
        $this->estado = $estado;
        $this->presentación = $presentación;
        $this->precio = $precio;
        $this->fechasDeVencimiento = $fechasDeVencimiento;
        $this->codigoDeBarras = $codigoDeBarras;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdentificador() {
        return $this->identificador;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getProveedor() {
        return $this->proveedor;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getPresentación() {
        return $this->presentación;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getFechasDeVencimiento() {
        return $this->fechasDeVencimiento;
    }

    public function getCodigoDeBarras() {
        return $this->codigoDeBarras;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdentificador($identificador): void {
        $this->identificador = $identificador;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setProveedor($proveedor): void {
        $this->proveedor = $proveedor;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setPresentación($presentación): void {
        $this->presentación = $presentación;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setFechasDeVencimiento($fechasDeVencimiento): void {
        $this->fechasDeVencimiento = $fechasDeVencimiento;
    }

    public function setCodigoDeBarras($codigoDeBarras): void {
        $this->codigoDeBarras = $codigoDeBarras;
    }

    public function __toString(): string {
        return "Articulo[id=" . $this->id
                . ", identificador=" . $this->identificador
                . ", nombre=" . $this->nombre
                . ", proveedor=" . $this->proveedor
                . ", estado=" . $this->estado
                . ", presentación=" . $this->presentación
                . ", precio=" . $this->precio
                . ", fechasDeVencimiento=" . $this->fechasDeVencimiento
                . ", codigoDeBarras=" . $this->codigoDeBarras
                . "]";
    }
    
    

}