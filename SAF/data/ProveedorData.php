<?php

include_once "CorreoData.php";
require_once 'Conexion.php';
require_once '../domain/Proveedor.php';
require_once 'TelefonoData.php';
require_once 'TipoProveedorData.php';
require_once '../domain/TipoProveedor.php';
require_once '../business/ControladoraPaisLocalizacion.php';
/**
 * Clase que maneja las consultas que se realizan a base de datos
 * 
 * @author Daniel Briones 
 * @since 5-08-24
 * @version 1.0
 */

class ProveedorData extends Conexion
{
    /**
     * Guarda los datos del proveedor en la base de datos
     * 
     * @param Proveedor $supplier Objeto con los datos necesarios para guardar el proveedor
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function save(Proveedor $supplier)
    {
        $conn = self::connect();
        try {
            $phoneData = new TelefonoData();
            $emailData = new CorreoData();

            $valiPhone = $phoneData->findByPhoneNumber($supplier->getPhone()->getPhone());
            $valiEmail = $emailData->findByEmail($supplier->getEmail()->getEmail());
            if ($valiPhone || $valiEmail) {
                $response = ['status' => 'error', 'message' => 'El correo o el teléfono ya se encuentra registrado', 'Correo' => $valiEmail, 'Telefono' => $valiPhone];
                echo json_encode($response);
                exit();
            }
            $stmt = $conn->prepare("INSERT INTO tbproveedor (tbproveedorid, tbproveedoridtipoproveedor, tbproveedoridentificador, tbproveedornombre, tbproveedorcreadoen, tbproveedormodificadoen, tbproveedorestado) VALUES (:id, :typeSupplier, :identifier, :name, :createdAt, :modifiedAt, :status)");

            $id = $supplier->getId();
            $idTypeSupplier = $supplier->getSupplierType()->getId();
            $identifier = $supplier->getIdentifier();
            $name = $supplier->getName();
            $createdAt = $supplier->getStrCreatedAt();
            $modifiedAt = $supplier->getStrModifiedAt();
            $status = $supplier->getStatus();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':typeSupplier', $idTypeSupplier, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $result = $stmt->execute();

            if ($this->wasSaved($identifier)) {
                $directionData = new DireccionProveedorData();

                $phoneData->save($supplier->getPhone());
                $emailData->save($supplier->getEmail());
                $directionData->saveDirection($supplier->getSupplierDirection());
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * Modifica los datos del proveedor en la base de datos
     * 
     * @param Proveedor $supplier Objeto con los datos necesarios para modificar el proveedor
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function  update(Proveedor $supplier)
    {
        $conn = self::connect();
        try {
            // Data
            $typeData = new TipoProveedorData();
            $phoneData = new TelefonoData();
            $emailData = new CorreoData();
            $directionData = new DireccionProveedorData();
            $countryLocationController = new ControladoraPaisLocalizacion();

            if ($this->verificarCorreoYTelefonoParaEditar($supplier)) {
                return false;
            }

            // Query
            $stmt = $conn->prepare("UPDATE tbproveedor SET tbproveedornombre = :name, tbproveedoridtipoproveedor = :typeSupplier, tbproveedormodificadoen = :modifiedAt, tbproveedorestado = :status WHERE tbproveedoridentificador = :identifier");

            $identifier = $supplier->getIdentifier();
            $typeSupplier = $typeData->findOneElement($supplier->getSupplierType()->getIdentifier());
            $idTypeSupplier = $typeSupplier->getId();
            $name = $supplier->getName();
            $modifiedAt = $supplier->getStrModifiedAt();
            $status = $supplier->getStatus();

            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':typeSupplier', $idTypeSupplier, PDO::PARAM_INT);
            $stmt->bindParam(':modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $result = $stmt->execute();

            $phoneData->update($supplier->getPhone());
            $emailData->update($supplier->getEmail());

            $direction = $directionData->findOneElementByIdSupplier($supplier->getId());
            $district = $countryLocationController->getDistrictByPostalCode($supplier->getSupplierDirection()->getDistrict()->getPostalCode());
            $direction->setDistrict($district);
            $direction->setSignalDirection($supplier->getSupplierDirection()->getSignalDirection());
            $direction->setModifiedAt($supplier->getSupplierDirection()->getModifiedAt());


            $directionData->update($direction);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    /**
     * "Elimina" los datos del proveedor (cambia el estado por FALSE-Inactivo) en la base de datos
     * 
     * @param string $identifier Identificador del proveedor que se desea eliminar
     * 
     * @return bool TRUE en caso de éxito o FALSE en caso de fallo
     */
    public function delete($identifier)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproveedor SET tbproveedorestado = :status, tbproveedormodificadoen = :modifiedAt WHERE tbproveedoridentificador = :identifier");

            $status = 0;
            $modifiedAt = new DateTime();
            $strModifiedAt = $modifiedAt->format('Y-m-d');

            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
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

    /**
     * Obtiene todos los registros de proveedores en la base de datos
     * 
     * @return array Arreglo con todos los registros de proveedores
     */
    public function getAll()
    {
        $conn = self::connect();
        try {
            // Consulta para obtener todos los proveedores
            $stmt = $conn->query("SELECT * FROM tbproveedor WHERE tbproveedorestado = 1");

            $stmt->execute();
            // Obtener todos los resultados
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            // Contoladores necesarios
            $typeData = new TipoProveedorData();
            $phoneData = new ControladoraTelefonoProveedor();
            $emailData = new CorreoData();
            $directionData = new ControladoraDireccionProveedor();
            // Convertir el resultado a una lista de objetos Supplier
            $suppliers = [];
            foreach ($result as $row) {
                $typeSupplier = $typeData->findOneElementById($row['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($row['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($row['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($row['tbproveedorid']);
                $suppliers[] = new Proveedor(
                    $row['tbproveedorid'],
                    $row['tbproveedoridentificador'],
                    $row['tbproveedornombre'],
                    $TelefonoProveedor,
                    $CorreoProveedor,
                    $typeSupplier,
                    $directionSupplier,
                    new DateTime($row['tbproveedorcreadoen']),
                    new DateTime($row['tbproveedormodificadoen']),
                    (bool)$row['tbproveedorestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $suppliers = [];
        } finally {
            $conn = null;
        }
        return $suppliers;
    }

    /**
     * Obtiene todos los registros de proveedores en la base de datos que su nombre coincida con el enviado
     * 
     * @param string $name Nombre (no necesariamente exacto) del proveedor que se desea obtener
     * 
     * @return array Arreglo con todos los registros de proveedores con coincidencias
     */
    public function getSupplierByName($name)
    {
        $conn = self::connect();
        try {
            // Consulta para obtener todos los proveedores
            $stmt = $conn->prepare("SELECT * FROM tbproveedor WHERE tbproveedornombre LIKE :nameSupplier"); //AND tbproveedorestado = 1
            $searchTerm = "%{$name}%";
            $stmt->bindParam(':nameSupplier', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            // Obtener todos los resultados
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            // Contoladores necesarios
            $typeData = new TipoProveedorData();
            $phoneData = new ControladoraTelefonoProveedor();
            $emailData = new ControladoraCorreoProveedor();
            $directionData = new ControladoraDireccionProveedor();
            // Convertir el resultado a una lista de objetos Supplier
            $suppliers = [];
            foreach ($result as $row) {
                $typeSupplier = $typeData->findOneElementById($row['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($row['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($row['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($row['tbproveedorid']);
                $suppliers[] = new Proveedor(
                    $row['tbproveedorid'],
                    $row['tbproveedoridentificador'],
                    $row['tbproveedornombre'],
                    $TelefonoProveedor,
                    $CorreoProveedor,
                    $typeSupplier,
                    $directionSupplier,
                    new DateTime($row['tbproveedorcreadoen']),
                    new DateTime($row['tbproveedormodificadoen']),
                    (bool)$row['tbproveedorestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $suppliers = [];
        } finally {
            $conn = null;
        }
        return $suppliers;
    }

    /**
     * Busca un proveedor por su identificador único
     * 
     * @param string $identifier Identificador único del proveedor
     * 
     * @return Proveedor|null Proveedor si encuentra el registro o null en caso de fallo
     */
    public function findByIdentifier($identifier)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbproveedor WHERE tbproveedoridentificador = :identifier");
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Contoladores necesarios
                $typeData = new TipoProveedorData();
                $phoneData = new ControladoraTelefonoProveedor();
                $emailData = new ControladoraCorreoProveedor();
                $directionData = new ControladoraDireccionProveedor();
                $typeSupplier = $typeData->findOneElementById($result['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($result['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($result['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($result['tbproveedorid']);
                $supplier = new Proveedor(
                    $result['tbproveedorid'],
                    $result['tbproveedoridentificador'],
                    $result['tbproveedornombre'],
                    $TelefonoProveedor,
                    $CorreoProveedor,
                    $typeSupplier,
                    $directionSupplier,
                    new DateTime($result['tbproveedorcreadoen']),
                    new DateTime($result['tbproveedormodificadoen']),
                    (bool)$result['tbproveedorestado']
                );
            } else {
                $supplier = null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $supplier = null;
        } finally {
            $conn = null;
        }
        return $supplier;
    }

    public function findById(int $id)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbproveedor WHERE tbproveedorid = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Contoladores necesarios
                $typeData = new TipoProveedorData();
                $phoneData = new ControladoraTelefonoProveedor();
                $emailData = new ControladoraCorreoProveedor();
                $directionData = new ControladoraDireccionProveedor();
                $typeSupplier = $typeData->findOneElementById($result['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($result['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($result['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($result['tbproveedorid']);
                $supplier = new Proveedor(
                    $result['tbproveedorid'],
                    $result['tbproveedoridentificador'],
                    $result['tbproveedornombre'],
                    $TelefonoProveedor,
                    $CorreoProveedor,
                    $typeSupplier,
                    $directionSupplier,
                    new DateTime($result['tbproveedorcreadoen']),
                    new DateTime($result['tbproveedormodificadoen']),
                    (bool)$result['tbproveedorestado']
                );
            } else {
                $supplier = null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $supplier = null;
        } finally {
            $conn = null;
        }
        return $supplier;
    }

    /**
     * Verifica si el proveedor ha sido creado
     * @param string $identifier Identificador el cual se quiere verificar si fue creado
     * @return bool TRUE si es encontrado, FALSE en caso contrario
     */
    private function wasSaved($identifier): bool
    {
        $conn = self::connect();
        $output = false;
        try {
            $stmt = $conn->prepare("SELECT 1 FROM tbproveedor WHERE tbproveedoridentificador = :identifier");
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $output = true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        return $output;
    }


    /**
     * Obtiene el siguiente id disponible para la tabla de proveedores
     * 
     * @return int Siguiente id disponible para la tabla de proveedores, en caso de estar vacía, 1
     */
    public function getNextId(): int
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbproveedorid FROM tbproveedor ORDER BY tbproveedorid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbproveedorid'] : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId + 1;
    }

    private function verificarCorreoYTelefonoParaEditar(Proveedor $supplier)
    {
        $conn = self::connect();
        try {
            // Data
            $phoneData = new TelefonoData();
            $emailData = new CorreoData();

            // Querys
            $stmtCorreo = $conn->prepare("SELECT tbcorreoproveedorid FROM `tbcorreoproveedor` WHERE tbcorreoproveedorcorreo = :correo AND NOT tbcorreoproveedoridproveedor = :idproveedor");
            $stmtTelefono = $conn->prepare("SELECT tbtelefonoid FROM `tbtelefono` WHERE tbtelefonotelefono = :telefono AND NOT tbtelefonoidproveedor = :idproveedor");

            //Variables
            $idProveedor = $supplier->getId();
            $telefono = $supplier->getPhone()->getPhone();
            $correo = $supplier->getEmail()->getEmail();

            //Asignar variables a consulta
            $stmtCorreo->bindParam(':idproveedor', $idProveedor, PDO::PARAM_INT);
            $stmtCorreo->bindParam(':correo', $correo, PDO::PARAM_STR);

            $stmtTelefono->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmtTelefono->bindParam(':idproveedor', $idProveedor, PDO::PARAM_INT);

            $stmtCorreo->execute();
            $stmtTelefono->execute();

            // Obtener resultados
            $resultCorreo = $stmtCorreo->fetch(PDO::FETCH_ASSOC);
            $resultTelefono = $stmtTelefono->fetch(PDO::FETCH_ASSOC);

            return ($resultTelefono || $resultCorreo);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            $conn = null;
        }
        return $result;
    }

    public function existeElNombreDelProveedor($nombre, $identificador)
    {
        $existe = false;
        $estadoDelProveedor = null;

        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT tbproveedornombre, tbproveedoridentificador, tbproveedorestado FROM tbproveedor");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila) {
                if ($this->coincidenLasPalabra($fila['tbproveedornombre'], $nombre) && $identificador !== $fila['tbproveedoridentificador']) {
                    $existe = true;
                    $estadoDelProveedor = $fila['tbproveedorestado'];
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
            'activo' => $estadoDelProveedor
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
        return levenshtein(strtolower(str_replace(' ', '',$palabraAlmacenada)), strtolower(str_replace(' ', '',$palabraIngresada))) <= $distanciaMaxima;
    }

    /**
     * Obtiene todos los registros de proveedores en la base de datos que su nombre coincida con el estado
     * 
     * @param int $estado Estado del proveedor que se desea obtener 1|0
     * 
     * @return array Arreglo con todos los registros de proveedores con coincidencias
     */
    public function obtenerProveedoresPorEstado($estado) {
        $conn = self::connect();
        try {
            // Consulta para obtener todos los proveedores
            $stmt = $conn->prepare("SELECT * FROM tbproveedor WHERE tbproveedorestado = :estado");
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->execute();
            // Obtener todos los resultados
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            // Contoladores necesarios
            $typeData = new TipoProveedorData();
            $phoneData = new ControladoraTelefonoProveedor();
            $emailData = new CorreoData();
            $directionData = new ControladoraDireccionProveedor();
            // Convertir el resultado a una lista de objetos Supplier
            $suppliers = [];
            foreach ($result as $row) {
                $typeSupplier = $typeData->findOneElementById($row['tbproveedoridtipoproveedor']);
                $TelefonoProveedor = $phoneData->findBySupplierId($row['tbproveedorid']);
                $CorreoProveedor = $emailData->findBySupplierId($row['tbproveedorid']);
                $directionSupplier = $directionData->findOneElementByIdSupplier($row['tbproveedorid']);
                $suppliers[] = new Proveedor(
                    $row['tbproveedorid'],
                    $row['tbproveedoridentificador'],
                    $row['tbproveedornombre'],
                    $TelefonoProveedor,
                    $CorreoProveedor,
                    $typeSupplier,
                    $directionSupplier,
                    new DateTime($row['tbproveedorcreadoen']),
                    new DateTime($row['tbproveedormodificadoen']),
                    (bool)$row['tbproveedorestado']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $suppliers = [];
        } finally {
            $conn = null;
        }
        return $suppliers;
    }

    public function habilitarProveedor($identificador){
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("UPDATE tbproveedor SET tbproveedorestado = :status, tbproveedormodificadoen = :modifiedAt WHERE tbproveedoridentificador = :identifier");

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

    public function existeElTelefonoEnProveedor($telefono){
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT 1 FROM tbtelefono WHERE tbtelefonotelefono LIKE :phoneNumber");
            $searchTerm = "%{$telefono}%";
            $stmt->bindParam(':phoneNumber', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            $conn = null;
        }
    }

    public function existeElCorreoEnProveedor($correo) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("SELECT 1 FROM tbcorreoproveedor WHERE tbcorreoproveedorcorreo LIKE :emailAddress");
            $searchTerm = "%{$correo}%";
            $stmt->bindParam(':emailAddress', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result !== false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conn = null;
        }
    }
}
