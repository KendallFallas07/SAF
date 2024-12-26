<?php

include_once "../domain/ClienteCredito.php";
require_once 'Conexion.php';

/**
 * @author Kendall Fallas
 */
class ClienteCreditoData extends Conexion
{

    public function guardarClienteCredito(ClienteCredito $clienteCredito): bool
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbclientecredito`(`tbclientecreditoid`, `tbclienteidentificador`,`tbclientecreditoidentificador`, `tbclientecreditocantidad`, `tbclientecreditoporcentaje`, `tbclientecreditoplazo`, `tbclientecreditofechainicio`, `tbclientecreditofechavencimiento`, `tbclientecreditocreadoen`, `tbclientecreditomodificadoen`, `tbclientecreditoestado`) VALUES (:id, :clienteId,:identificador, :cantidad, :porcentaje, :plazo, :fechaInicio, :fechaVencimiento, :creadoEn, :modificadoEn, :estado);");

            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $clienteCredito->getClienteCId();
            $clienteId = $clienteCredito->getClienteId();
            $identificador = $clienteCredito->getClienteCIdentificador();
            $cantidad = $clienteCredito->getClienteCantidadCredito();
            $porcentaje = $clienteCredito->getClienteCPorcentaje();
            $plazo = $clienteCredito->getClienteCPlazo();


            $fechaInicio = $clienteCredito->getClienteCFechaInicio();
            $fechaVencimiento = $clienteCredito->getClienteCFechaVencimiento();
            $creadoEn = $clienteCredito->getCreadoEn();
            $modificadoEn = $clienteCredito->getEditadoEn();

            $estado = $clienteCredito->getClienteCEstado();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_STR);
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
            $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_STR);
            $stmt->bindParam(':plazo', $plazo, PDO::PARAM_INT);
            $stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(':fechaVencimiento', $fechaVencimiento, PDO::PARAM_STR);
            $stmt->bindParam(':creadoEn', $creadoEn, PDO::PARAM_STR);
            $stmt->bindParam(':modificadoEn', $modificadoEn, PDO::PARAM_STR);

            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);

            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }

    public function getNextId()
    {
        $conn = self::connect();
        // Obtengo la conexión
        if ($conn === null) {
            throw new Exception("Error establishing a database connection.");
        }

        // Consulta para obtener el último ID insertado
        $stmt = $conn->prepare("SELECT tbclientecreditoid FROM tbclientecredito ORDER BY tbclientecreditoid DESC LIMIT 1;");
        $stmt->execute();
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbclientecreditoid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos las presentaciones
        $stmt = $conn->query("SELECT * FROM tbclientecredito WHERE tbclientecreditoestado != 0");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function obtenerIdentificadoresClientesPorFiltrado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT tbusuarioidentificador
            FROM tbusuario
            WHERE CONCAT(tbusuarionombre, ' ', tbusuarioapellidos) LIKE :datos
            ORDER BY `tbusuarionombre` ASC;"
        );
        $likeData = "%{$datos}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':datos', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function searchData(string $data)
    {
        // Obtener identificadores de clientes filtrados por nombre y apellido
        $identificadores = $this->obtenerIdentificadoresClientesPorFiltrado($data);

        // Si no se encontraron identificadores, retornar un array vacío
        if (empty($identificadores)) {
            return [];
        }

        // Extraer solo los identificadores en un array simple
        $ids = array_column($identificadores, 'tbusuarioidentificador');

        // Convertir los identificadores en una lista separada por comas para la consulta SQL
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $conn = self::connect();

        // Preparo la consulta con la cláusula IN en la tabla tbclientecredito
        $stmt = $conn->prepare("
        SELECT * 
        FROM `tbclientecredito` 
        WHERE `tbclienteidentificador` IN ($placeholders)
        AND `tbclientecreditoestado` != 0 
        ORDER BY `tbclienteidentificador` ASC;
    ");

        // Asignar valores a los placeholders
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_STR);
        }

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    public function searchByIdentifier(string $identificador)
    {

        $conn = self::connect();

        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare("SELECT * FROM `tbclientecredito` WHERE `tbclientecreditoidentificador` = :identificador AND `tbclientecreditoestado` != 0;");

        // Asigno los valores a los parámetros
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);

        // Ejecuto la consulta
        $stmt->execute();

        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorno los resultados
        return $results;
    }

    public function actualizar(ClienteCredito $data)
    {

        $this->eliminar($data->getClienteCIdentificador());
        $this->guardarClienteCredito($data);
        return 1;
    }

    public function eliminar(string $identificador)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbclientecredito SET tbclientecreditoestado = 0 WHERE tbclientecreditoidentificador = :identificador");
            // Coloco los parámetros
            $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }


    //Apartado de clientes
    public function obtenerClientes()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los tipos de proveedor
        $stmt = $conn->query("SELECT * FROM tbusuario WHERE `tbusuarioestado` != 0");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios = [];
        foreach ($result as $row) {
            $usuarios[] = [
                'id' => $row['tbusuarioidentificador'],
                'nombre' => $row['tbusuarionombre'],
                'apellidos' => $row['tbusuarioapellidos']
            ];
        }

        return $usuarios;
    }

    public function encontrarPorId(int $id)
    {
        // Obtengo la conexión
        $conn = self::connect();

        // Consulta para obtener el nombre del proveedor específico
        $stmt = $conn->prepare("SELECT tbusuarionombre FROM tbusuario WHERE tbusuarioid = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontró el resultado y retorna el nombre
        if ($result) {
            return $result['tbusuarionombre'];
        } else {
            return null; // O lanza una excepción, dependiendo de cómo quieras manejar los errores
        }
    }
    public function ObtenerIdentificadorClientePorId(int $id)
    {
        // Obtengo la conexión
        $conn = self::connect();

        // Consulta para obtener el nombre del proveedor específico
        $stmt = $conn->prepare("SELECT tbusuarioidentificador FROM tbusuario WHERE tbusuarioid = :id AND tbusuarioestado != 0");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontró el resultado y retorna el nombre
        if ($result) {
            return $result['tbusuarioidentificador'];
        } else {
            return null; // O lanza una excepción, dependiendo de cómo quieras manejar los errores
        }
    }

    public function ObtenerIdClientePorIdentificador(string $identificador)
    {
        // Obtengo la conexión
        $conn = self::connect();

        // Consulta para obtener el nombre del proveedor específico
        $stmt = $conn->prepare("SELECT tbusuarioid FROM tbusuario WHERE tbusuarioidentificador = :identificador AND tbusuarioestado != 0");
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontró el resultado y retorna el nombre
        if ($result) {
            return $result['tbusuarioid'];
        } else {
            return null; // O lanza una excepción, dependiendo de cómo quieras manejar los errores
        }
    }



    public function autocompletado(string $datos)
    {

        $conn = self::connect();
        // Preparo la consulta con los parámetros de enlace correctos
        $stmt = $conn->prepare(
            "
            SELECT *
            FROM tbusuario
            WHERE CONCAT(tbusuarionombre, ' ', tbusuarioapellidos) LIKE :datos
            ORDER BY `tbusuarionombre` ASC;"
        );
        $likeData = "%{$datos}%";
        // Asigno los valores a los parámetros
        $stmt->bindParam(':datos', $likeData, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Imprimo los resultados para depuración
        return $results;
    }

    public function filtrarUsuarios(string $identificador): bool
    {

        $conn = self::connect();

        $stmt = $conn->prepare(
            "
        SELECT COUNT(*)
        FROM tbclientecredito
        WHERE tbclienteidentificador = :identificador AND tbclientecreditoestado != 0;
        "
        );

        // Vincula el valor del identificador al parámetro
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el resultado
        $count = $stmt->fetchColumn();

        // Devuelve true si el conteo es mayor que cero, false en caso contrario
        return $count > 0;
    }
}
