

<?php

require_once 'Categoria.php';

class Producto {

    private int $id;
    private string $identificador;
    private string $nombre;
    private string $description;
    private Categoria $categoria;
    private UnidadMedida $unidadMedida;
    private Presentacion $presentacion;
    private Proveedor $proveedor;
    private DateTime $creadoEn;
    private DateTime $actualizadoEn;
    private bool $estado;
    private $imagenes;

    // Constructor vacio. Para instanciar la clase
    public function __construct() {
        
    }

    /**
     * Constructor completo para agregar todos los datos de la clase
     * @param int $id
     * @param string $identificador
     * @param string $nombre
     * @param string $description
     * @param Categoria $categoria
     * @param UnitMeasurement $unidadMedida
     * @param Presentacion $presentacion
     * @param Proveedor $proveedor
     * @param DateTime $creadoEn
     * @param DateTime $actualizadoEn
     * @param bool $estado
     * @return void
     */
    public function constructorComplete(int $id, string $identificador, string $nombre, string $description, Categoria $categoria, UnidadMedida $unidadMedida, Presentacion $presentacion, Proveedor $proveedor, DateTime $creadoEn, DateTime $actualizadoEn, bool $estado) {
        $this->id = $id;
        $this->identificador = $identificador;
        $this->nombre = $nombre;
        $this->description = $description;
        $this->categoria = $categoria;
        $this->unidadMedida = $unidadMedida;
        $this->presentacion = $presentacion;
        $this->proveedor = $proveedor;
        $this->creadoEn = $creadoEn;
        $this->actualizadoEn = $actualizadoEn;
        $this->estado = $estado;
    }

    // Getters y Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getIdentificador(): string {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador): void {
        $this->identificador = $identificador;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getCategoria(): Categoria {
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria): void {
        $this->categoria = $categoria;
    }

    public function getUnidadMedida(): UnidadMedida {
        return $this->unidadMedida;
    }

    public function setUnidadMedida(UnidadMedida $unidadMedida): void {
        $this->unidadMedida = $unidadMedida;
    }

    public function getPresentacion(): Presentacion {
        return $this->presentacion;
    }

    public function setPresentacion(Presentacion $presentacion): void {
        $this->presentacion = $presentacion;
    }

    public function getProveedor(): Proveedor {
        return $this->proveedor;
    }

    public function setProveedor(Proveedor $proveedor): void {
        $this->proveedor = $proveedor;
    }

    public function getCreadoEn(): DateTime {
        return $this->creadoEn;
    }

    public function setCreadoEn(DateTime $creadoEn): void {
        $this->creadoEn = $creadoEn;
    }

    public function getStrCreadoEn(): string {
        return ($this->creadoEn !== null) ? $this->creadoEn->format('Y-m-d') : "";
    }

    public function getActualizadoEn(): DateTime {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(DateTime $actualizadoEn): void {
        $this->actualizadoEn = $actualizadoEn;
    }

    public function getStrActuaizadoEn(): string {
        return ($this->actualizadoEn !== null) ? $this->actualizadoEn->format('Y-m-d') : "";
    }

    public function getEstado(): bool {
        return $this->estado;
    }

    public function setEstado(bool $estado): void {
        $this->estado = $estado;
    }

    public function getImagenes() {
        return $this->imagenes;
    }

    public function setImagenes($imagenes) {
        $this->imagenes = $imagenes;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'identificador' => $this->identificador,
            'nombre' => $this->nombre,
            'description' => $this->description,
            'categoria' => $this->categoria->toArray(),
            'presentacion' => $this->presentacion->toArray(),
            'unidadmedida' => $this->unidadMedida->toArray(),
            'proveedor' => $this->proveedor->toArray(),
            'creadoEn' => $this->creadoEn->format('Y-m-d H:i:s'),
            'actualizadoEn' => $this->actualizadoEn->format('Y-m-d H:i:s'),
            'estado' => $this->estado,
            'imagenes' => $this->imagenes
        ];
    }
}
