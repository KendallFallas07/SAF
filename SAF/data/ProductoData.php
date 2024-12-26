
<?php
include_once "../domain/Producto.php";
include_once "../business/ControladoraCategoria.php";
include_once "../business/ControladoraUnidadMedida.php";
include_once "../business/ControladoraPresentacion.php";
include_once "../business/ControladoraProveedor.php";
include_once 'Conexion.php';
include_once "ProveedorProductoData.php";
include_once "../domain/Lote.php";
include_once "../domain/MargenGanancia.php";
/**
 * 
 * @author Daniel Briones
 * @version 1.0.0
 * @since 19-08-24
 * 
 */

class ProductoData extends Conexion
{

    /**
     * Función encargada de guardar el producto en la base de datos.
     * 
     * @param Producto $producto Objeto con los datos del producto que se desean guardar en la BD.
     * 
     * @return bool TRUE si el producto se registro en la base de datos, FALSE si el producto no se registro en la base de datos
     */
    public function saveProduct($producto)
    {
        $conn = self::connect();
        try {
            $sql = "INSERT INTO tbproducto (tbproductoid, tbproductoidentificador, tbproductonombreproducto, tbproductodescripcionproducto, tbproductocategoriaidentificador, tbproductounidadmedidaidentificador, tbproductopresentacionidentificador, tbproductofechacreacion, tbproductofechamodificacion, tbproductoestado) VALUES (:id, :identificador, :nombreProducto, :descripcionProducto, :categoriaId, :unidadMedidaId, :presentacionId, :fechaCreacion, :fechaModificacion, :estado)";
            $stmt = $conn->prepare($sql);

            $id = $producto->getId();
            $identifier = $producto->getIdentificador();
            $name = $producto->getNombre();
            $description = $producto->getDescription();
            $catId = $producto->getCategoria()->getIdentifierCat();
            $unidadMedida = $producto->getUnidadMedida()->getIdentifier();
            $presentation = $producto->getPresentacion()->getIdentifier();
            $createdAt = $producto->getStrCreadoEn();
            $modifiedAt = $producto->getStrActuaizadoEn();
            $status = $producto->getEstado();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identificador', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':nombreProducto', $name, PDO::PARAM_STR);
            $stmt->bindParam(':descripcionProducto', $description, PDO::PARAM_STR);
            $stmt->bindParam(':categoriaId', $catId, PDO::PARAM_STR);
            $stmt->bindParam(':unidadMedidaId', $unidadMedida, PDO::PARAM_STR);
            $stmt->bindParam(':presentacionId', $presentation, PDO::PARAM_STR);
            $stmt->bindParam(':fechaCreacion', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':fechaModificacion', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $status, PDO::PARAM_INT);

            $result = $stmt->execute();

            //Guardar datos de proveedor producto
            $proveedorProductoData = new ProveedorProductoData();
            $result = $proveedorProductoData->guardar($producto);

            $result = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * Obtiene el siguiente id disponible para la tabla de productos
     * 
     * @return int $lastId Siguiente id disponible para la tabla productos, en caso de estar vacía, 1
     */
    public function getNextId()
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbproductoid FROM tbproducto ORDER BY tbproductoid DESC LIMIT 1");
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbproductoid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = null;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }

    /**
     * "Elimina" los datos del producto (cambia el estado a FALSE-Inactivo y la fecha de modificación)
     * 
     * @param Producto $producto Objeto que contiene el id del producto que se desea "Eliminar" y la fecha de modificación
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function deleteProduct($producto)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproducto SET tbproductofechamodificacion = :modifiedAt, tbproductoestado = :status WHERE tbproductoid = :id");

            // Obtener los valores del objeto $producto
            $id = $producto->getId();
            $modifiedAt = $producto->getActualizadoEn()->format('Y-m-d H:i:s'); // Asegúrate de que el formato sea correcto
            $status = 0; // Asignar el estado como inactivo

            // Utilizar bindValue en lugar de bindParam
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);

            // Ejecutar la consulta
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null; // Cerrar la conexión
        }
        return $result;
    }



    /**
     * Actualiza los datos del producto (nombre, descripción, fecha de modificación)
     * 
     * @param Producto $product Producto con los datos actualizar
     * 
     * @return True|False TRUE en caso de actualizar correctamente el producto, FALSE en caso contrario
     */
    public function updateProduct($producto)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproducto SET tbproductonombreproducto = :nameProduct, tbproductodescripcionproducto = :descriptionProduct, tbproductofechamodificacion = :modifiedAt, tbproductocategoriaidentificador = :categoryId, tbproductounidadmedidaidentificador = :unitmeasurement, tbproductopresentacionidentificador = :presentationid WHERE tbproductoid = :id");

            $id = $producto->getId();
            $name = $producto->getNombre();
            $description = $producto->getDescription();
            $modifiedAt = $producto->getStrActuaizadoEn();
            $categoryId = $producto->getCategoria()->getIdentifierCat();
            $unidadMedidaId = $producto->getUnidadMedida()->getIdentifier();
            $presentationId = $producto->getPresentacion()->getIdentifier();


            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nameProduct', $name, PDO::PARAM_STR);
            $stmt->bindParam(':descriptionProduct', $description, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_STR);
            $stmt->bindParam(':unitmeasurement', $unidadMedidaId, PDO::PARAM_STR);
            $stmt->bindParam(':presentationid', $presentationId, PDO::PARAM_STR);

            $result = $stmt->execute();

            $proveedorProductoData = new ProveedorProductoData();
            $proveedorProductoData->update($producto);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * Obtiene todos los productos que su estado sea activo
     *
     * @return Array Todos los productos disponibles
     */
    public function findAllProductos()
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conn = null;
        }
    }

    public function findByIdentifier($identifier)
    {
        $conn = self::connect();
        $product = null;

        try {
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado AND tbproductoidentificador = :identifier");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            $stmt->bindValue(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $categoryController = new ControladoraCategoria();
            $unidadMedidaController = new ControladoraUnidadMedida();
            $presentationController = new PresentacionController();
            $supplierController = new ControladoraProveedor();
            $proveedorProductoData = new ProveedorProductoData();

            if ($result) {
                $idsupplier = $proveedorProductoData->findSupplierByIdProduct($result['tbproductoidentificador']);

                $product = new Producto();
                $product->constructorComplete(
                    (int)$result['tbproductoid'],
                    $result['tbproductoidentificador'],
                    $result['tbproductonombreproducto'],
                    $result['tbproductodescripcionproducto'],
                    $categoryController->getCategoryByIdentifier($result['tbproductocategoriaidentificador']),
                    $unidadMedidaController->findByidentifier($result['tbproductounidadmedidaidentificador']),
                    $presentationController->findById($result['tbproductopresentacionidentificador']),
                    $supplierController->findByIdentifier($idsupplier),
                    new DateTime($result['tbproductofechacreacion']),
                    new DateTime($result['tbproductofechamodificacion']),
                    (bool)$result['tbproductoestado']
                );
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $product;
    }

    public function searchProduct($search)
    {
        $conn = self::connect();
        $products = []; // Cambiado de null a un array para almacenar múltiples productos

        try {
            if (empty($search)) {
                $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado");
                $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            } else {
                $searchTerm = "%{$search}%";
                $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductonombreproducto LIKE :search");
                $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
            }
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo

            $categoryController = new ControladoraCategoria();
            $unidadMedidaController = new ControladoraUnidadMedida();
            $presentationController = new PresentacionController();
            $supplierController = new ControladoraProveedor();
            $proveedorProductoData = new ProveedorProductoData();

            foreach ($results as $result) {
                $idsupplier = $proveedorProductoData->findSupplierByIdProduct($result['tbproductoidentificador']);
                $product = new Producto();
                $product->constructorComplete(
                    (int)$result['tbproductoid'],
                    $result['tbproductoidentificador'],
                    $result['tbproductonombreproducto'],
                    $result['tbproductodescripcionproducto'],
                    $categoryController->getCategoryByIdentifier($result['tbproductocategoriaidentificador']),
                    $unidadMedidaController->findByidentifier($result['tbproductounidadmedidaidentificador']),
                    $presentationController->findById($result['tbproductopresentacionidentificador']),
                    $supplierController->findByIdentifier($idsupplier),
                    new DateTime($result['tbproductofechacreacion']),
                    new DateTime($result['tbproductofechamodificacion']),
                    (bool)$result['tbproductoestado']
                );
                $products[] = $product->toArray();
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $products; // Devuelve el array de productos
    }

    public function findAll()
    {
        $conn = self::connect();
        $products = [];

        try {
            // Consulta para obtener todos los productos activos
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado");
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT); // Estado activo
            $stmt->execute();

            $categoryController = new ControladoraCategoria();
            $unidadMedidaController = new ControladoraUnidadMedida();
            $presentationController = new PresentacionController();
            $supplierController = new ControladoraProveedor();
            $proveedorProductoData = new ProveedorProductoData();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idsupplier = $proveedorProductoData->findSupplierByIdProduct($result['tbproductoidentificador']);
                $product = new Producto();
                $product->constructorComplete(
                    (int)$result['tbproductoid'],
                    $result['tbproductoidentificador'],
                    $result['tbproductonombreproducto'],
                    $result['tbproductodescripcionproducto'],
                    $categoryController->getCategoryByIdentifier($result['tbproductocategoriaidentificador']),
                    $unidadMedidaController->findByidentifier($result['tbproductounidadmedidaidentificador']),
                    $presentationController->findById($result['tbproductopresentacionidentificador']),
                    $supplierController->findByIdentifier($idsupplier),
                    new DateTime($result['tbproductofechacreacion']),
                    new DateTime($result['tbproductofechamodificacion']),
                    (bool)$result['tbproductoestado']
                );

                // Añadir el producto al array
                $products[] = $product;
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $products; // Devolver el array de productos
    }

    public function existeElNombreDelProducto($nombre, $identificador)
    {
        $existe = false;
        $estadoDelProducto = null;

        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbproductonombreproducto, tbproductoidentificador, tbproductoestado FROM tbproducto");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila) {
                if ($this->coincidenLasPalabra($fila['tbproductonombreproducto'], $nombre) && $identificador !== $fila['tbproductoidentificador']) {
                    $existe = true;
                    $estadoDelProducto = $fila['tbproductoestado'];
                    break;
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }


        $respuesta = [
            'nombre' => $nombre,
            'existe' => $existe,
            'activo' => $estadoDelProducto
        ];
        return $respuesta;
    }

    /**
     * Calcula que tanto coinciden las palabras
     * 
     * @param string $palabraAlmacenada La palabra almacenada en la base de datos
     * @param string $palabraIngresada La palabra ingresada por el usuario y se va a evaluar
     * 
     * @return bool TRUE en caso que coincida con la distancia maxima, FALSE si pasa esa distancia 
     */
    private function coincidenLasPalabra($palabraAlmacenada, $palabraIngresada)
    {
        $distanciaMaxima = 2;
        return levenshtein(strtolower(str_replace(' ', '', $palabraAlmacenada)), strtolower(str_replace(' ', '', $palabraIngresada))) <= $distanciaMaxima;
    }

    public function obtenerProveedoresPorEstado($estado)
    {
        $conn = self::connect();
        $products = [];

        try {
            // Consulta para obtener todos los productos activos
            $stmt = $conn->prepare("SELECT * FROM tbproducto WHERE tbproductoestado = :estado");
            $stmt->bindValue(':estado', $estado, PDO::PARAM_INT);
            $stmt->execute();

            $categoryController = new ControladoraCategoria();
            $unidadMedidaController = new ControladoraUnidadMedida();
            $presentationController = new PresentacionController();
            $supplierController = new ControladoraProveedor();
            $proveedorProductoData = new ProveedorProductoData();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idsupplier = $proveedorProductoData->findSupplierByIdProduct($result['tbproductoidentificador']);
                $product = new Producto();
                $product->constructorComplete(
                    (int)$result['tbproductoid'],
                    $result['tbproductoidentificador'],
                    $result['tbproductonombreproducto'],
                    $result['tbproductodescripcionproducto'],
                    $categoryController->getCategoryByIdentifier($result['tbproductocategoriaidentificador']),
                    $unidadMedidaController->findByidentifier($result['tbproductounidadmedidaidentificador']),
                    $presentationController->findById($result['tbproductopresentacionidentificador']),
                    $supplierController->findByIdentifier($idsupplier),
                    new DateTime($result['tbproductofechacreacion']),
                    new DateTime($result['tbproductofechamodificacion']),
                    (bool)$result['tbproductoestado']
                );

                // Añadir el producto al array
                $products[] = $product;
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null; // Cerrar la conexión
        }

        return $products; // Devolver el array de productos
    }

    public function habilitarProducto($identificador)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproducto SET tbproductofechamodificacion = :modifiedAt, tbproductoestado = :status WHERE tbproductoidentificador = :identifier");

            $status = 1;
            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d');

            $stmt->bindParam(':identifier', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $strModifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function guardarImagen($productoId, $ruta)
    {

        $conn = self::connect();

        // Crear un objeto DateTime
        $dateTime = new DateTime();

        // Establecer la zona horaria
        $dateTime->setTimezone(new DateTimeZone('America/Costa_Rica'));

        // Obtener el timestamp
        $timestamp = $dateTime->getTimestamp();

        $identificador = strval($timestamp);

        try {
            $stmt = $conn->prepare("INSERT INTO `tbproductoimagen`(`tbproductoimagenidentificador`, `tbproductoimagenproductoIdentificador`, `tbproductoimagenruta`) VALUES (:identificador, :productoId, :ruta)");


            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':productoId', $productoId, PDO::PARAM_STR);
            $stmt->bindParam(':ruta', $ruta, PDO::PARAM_STR);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    //para ventas
private function consultaSacarUnlote(string $identificador) {
    $conn = self::connect();
    $stmt = $conn->prepare("SELECT * FROM tblote WHERE tbproductoidentificador  = :identificador AND tbloteestado != 0;");
    $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    $stmt->execute();

  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lotes= new Lote(
            $row['tbloteid'],
            $row['tbloteidentificador'],
            $row['tbproductoidentificador'],
            $row['tblotecantidadadquirida'],
            $row['tblotecantidadactual'],
            $row['tblotepreciocompra'],
            new DateTime($row['tblotefechaadquisicion']),
            new DateTime($row['tblotefechaexpiracion']),
            new DateTime($row['tblotefechacreacion']),
            new DateTime($row['tblotefechamodificacion']),
            $row['tbloteestado']
        );
    }
    return $lotes;
}

private function getMargenesByIdentifier($identifier)
{
    // Conexión a la base de datos
    $conn = self::connect();
    
    // Preparar la consulta con un placeholder
    $stmt = $conn->prepare("SELECT * FROM tbmargenganancia WHERE tbmargengananciaestado != 0 AND tbloteidentificador  = :identifier;");
    
    // Asignar el valor del parámetro
    $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    foreach ($result as $dates) {
        $margen = new MargenGanancia(
            $dates['tbmargengananciaid'],
            $dates['tbmargengananciaidentificador'],
            $dates['tbmargengananciaporcentaje'],
            $dates['tbloteidentificador'], '', '', 1
        );
        
    }
    
    return $margen;
}

public function obtenerLoteYMargenes(string $identificador) {
    // Obtener el lote correspondiente
    $lote = $this->consultaSacarUnlote($identificador);


    
    // Obtener los márgenes correspondientes
    $margen = $this->getMargenesByIdentifier($lote->getIdentificador());
    
    // Combinar los resultados
    $resultados = [
        'precio' => $lote->getPrecioCompra(),
        'margen' => $margen->getPorcentaje()
    ];

    
    return $resultados;
}


public function obtenerImagenesDeProducto($identificador){
    $conn = self::connect();
    try {
        $stmt = $conn->prepare("SELECT tbproductoimagenruta FROM `tbproductoimagen` WHERE tbproductoimagenproductoIdentificador = :identificador");
        $stmt->bindValue(':identificador', $identificador, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
    return null;
}

}
