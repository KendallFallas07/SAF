<?php

require_once "Conexion.php";
require_once '../domain/Subcategoria.php';
require_once '../domain/Categoria.php';

class SubcategoriaData extends Conexion{
    public function getAllSubCategories()
    {
        $conn = self::connect();
        $stmt = $conn->query("SELECT * FROM tbsubcategoria WHERE tbsubcategoriaestado  = 1");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $subcategories = [];

        foreach ($result as $dates) {
            $subObj = new Subcategoria(
                $dates['tbsubcategoriaid'],
                $dates['tbcategoriaidentificador'],
                $dates['tbsubcategoriaidentificador'],
                $dates['tbsubcategorianombre'],
                $dates['tbsubcategoriadescripcion'],
                new DateTime($dates['tbsubcategoriafechacreacion']),
                new DateTime($dates['tbsubcategoriafechamodificacion']),
                $dates['tbsubcategoriaestado']
                
            );
            $subcategories[] = $subObj;
        }

        return $subcategories;
    }

    public function getAllSubCategoriesDisable()
{
    $conn = self::connect();
    $stmt = $conn->query("
    SELECT * 
    FROM tbsubcategoria AS s1
    WHERE s1.tbsubcategoriaestado = 0
      AND NOT EXISTS (
          SELECT 1
          FROM tbsubcategoria AS s2
          WHERE s2.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
            AND s2.tbsubcategoriaestado = 1
      )
      AND s1.tbsubcategoriaid = (
          SELECT MAX(s3.tbsubcategoriaid)
          FROM tbsubcategoria AS s3
          WHERE s3.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
            AND s3.tbsubcategoriaestado = 0
      )
    ");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $subcategories = [];

    foreach ($result as $dates) {
        $subObj = new Subcategoria(
            $dates['tbsubcategoriaid'],
            $dates['tbcategoriaidentificador'],
            $dates['tbsubcategoriaidentificador'],
            $dates['tbsubcategorianombre'],
            $dates['tbsubcategoriadescripcion'],
            new DateTime($dates['tbsubcategoriafechacreacion']),
            new DateTime($dates['tbsubcategoriafechamodificacion']),
            $dates['tbsubcategoriaestado']
        );
        $subcategories[] = $subObj;
    }

    return $subcategories;
}


    public function getOnlySubCat($identifiersubCat)
    {
        try {
            $conn = self::connect();
            
            // Prepara la consulta con un marcador de parámetros
            $stmt = $conn->prepare("SELECT * FROM tbsubcategoria WHERE tbsubcategoriaidentificador = :identificador and tbsubcategoriaestado !=0");
            $stmt->bindParam(':identificador', $identifiersubCat, PDO::PARAM_STR);
            $stmt->execute();
            
            // Obtiene el resultado como un array asociativo
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verifica si se encontró un resultado
            if ($result) {
                // Crea un objeto Subcategoria con los datos obtenidos
                $subObj = new Subcategoria(
                    $result['tbsubcategoriaid'],
                    $result['tbcategoriaidentificador'],
                    $result['tbsubcategoriaidentificador'],
                    $result['tbsubcategorianombre'],
                    $result['tbsubcategoriadescripcion'],
                    new DateTime($result['tbsubcategoriafechacreacion']),
                    new DateTime($result['tbsubcategoriafechamodificacion']),
                    $result['tbsubcategoriaestado']
                );
                return $subObj;
            } else {
                // Retorna null si no se encontró el resultado
                return null;
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de excepción
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    

    public function saveSubcategory(Subcategoria $subCat): bool
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbsubcategoria`(`tbsubcategoriaid`, `tbcategoriaidentificador`, `tbsubcategoriaidentificador`, `tbsubcategorianombre`, `tbsubcategoriadescripcion`, `tbsubcategoriafechacreacion`, `tbsubcategoriafechamodificacion`,`tbsubcategoriaestado`) VALUES (:id, :identifierCat,:identifier, :pName, :pDescription, :createdAt, :updatedAt, :pState);");

            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $subCat->getIdSubCat();
            $identifierCat = $subCat->getIdentifierCat();
            $identifier = $subCat->getIdentifierSubCat();
            $pName = $subCat->getNameSubcategory();
            $pDescription = $subCat->getDescriptionSubcat();

            // Convierte DateTime a string
            $createdAt = $subCat->getCreatedAtSubcat()->format('Y-m-d H:i:s');
            $updatedAt = $subCat->getModifiedAtSubcat()->format('Y-m-d H:i:s');

            $pState = $subCat->getStatusSubcat();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifierCat', $identifierCat, PDO::PARAM_STR);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':pName', $pName, PDO::PARAM_STR);
            $stmt->bindParam(':pDescription', $pDescription, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':pState', $pState, PDO::PARAM_INT);

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


    public function getNextIdSubCat(): int
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbsubcategoriaid FROM tbsubcategoria ORDER BY tbsubcategoriaid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbsubcategoriaid'] + 1 : 1;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId;
    }


    public function getSubcategoriesByFilter($searchT)
    {
        $conn = self::connect();

        // Preparar la consulta SQL con LIKE para filtrar los resultados si se proporciona un término de búsqueda
        $sql = "SELECT * FROM tbsubcategoria WHERE tbsubcategoriaestado = 1 AND tbsubcategorianombre LIKE :search OR tbsubcategoriaestado = 1 AND tbsubcategoriadescripcion LIKE :search";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':search', '%' . $searchT . '%');

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $subcategories = [];

        foreach ($result as $dates) {
            $subObj = new Subcategoria(
                $dates['tbsubcategoriaid'],
                $dates['tbcategoriaidentificador'],
                $dates['tbsubcategoriaidentificador'],
                $dates['tbsubcategorianombre'],
                $dates['tbsubcategoriadescripcion'],
                new DateTime($dates['tbsubcategoriafechacreacion']),
                new DateTime($dates['tbsubcategoriafechamodificacion']),
                $dates['tbsubcategoriaestado']
                
            );
            $subcategories[] = $subObj;
        }

        return $subcategories;
    }


    public function getAllSubCategoriesDisableByFilter($searchT)
{
    $conn = self::connect();

    // Prepare the SQL query with LIKE to filter results if a search term is provided
    $sql = "
    SELECT * 
    FROM tbsubcategoria AS s1
    WHERE s1.tbsubcategoriaestado = 0
      AND NOT EXISTS (
          SELECT 1
          FROM tbsubcategoria AS s2
          WHERE s2.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
            AND s2.tbsubcategoriaestado = 1
      )
      AND s1.tbsubcategoriaid = (
          SELECT MAX(s3.tbsubcategoriaid)
          FROM tbsubcategoria AS s3
          WHERE s3.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
            AND s3.tbsubcategoriaestado = 0
      )
      AND (
          s1.tbsubcategorianombre LIKE :search
          OR s1.tbsubcategoriadescripcion LIKE :search
      )
    ";

    $stmt = $conn->prepare($sql);

    // Bind the search term parameter
    $stmt->bindValue(':search', '%' . $searchT . '%');

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $subcategories = [];

    foreach ($result as $dates) {
        $subObj = new Subcategoria(
            $dates['tbsubcategoriaid'],
            $dates['tbcategoriaidentificador'],
            $dates['tbsubcategoriaidentificador'],
            $dates['tbsubcategorianombre'],
            $dates['tbsubcategoriadescripcion'],
            new DateTime($dates['tbsubcategoriafechacreacion']),
            new DateTime($dates['tbsubcategoriafechamodificacion']),
            $dates['tbsubcategoriaestado']
        );
        $subcategories[] = $subObj;
    }

    return $subcategories;
}



    public function getCategoryByIdentifier($identifier)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT tbcategoriaid, tbcategoriaidentificador, tbcategorianombre, tbcategoriadescripcion , tbcategoriafechacreacion, tbcategoriafechamodificacion,tbcategoriaestado FROM tbcategoria WHERE tbcategoriaidentificador = :identifier AND tbcategoriaestado != 0 ");

        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
        $stmt->execute();


        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $category = new Categoria(
                $result['tbcategoriaid'],
                $result['tbcategoriaidentificador'],
                $result['tbcategorianombre'],
                $result['tbcategoriadescripcion'],
                new DateTime($result['tbcategoriafechacreacion']),
                new DateTime($result['tbcategoriafechamodificacion']),
                $result['tbcategoriaestado']
            );
        } else {
            $category = null;
        }

        return $category;
    }


    public function deleteSubcategory($subCategory)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbsubcategoria SET tbsubcategoriaestado = :estado WHERE tbsubcategoriaidentificador = :identifier");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $estado = 0;
            // Coloco los parámetros
            $stmt->bindParam(':identifier', $subCategory, PDO::PARAM_STR);
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

    public function updateSubcategory(Subcategoria $subCat){
        
        $this->deleteSubcategory($subCat->getIdentifierSubCat());
        return $this->saveSubcategory($subCat);
    }
    
    private function getLastSubcategoryIdentifierByCategory($subCat)
{
    $conn = self::connect();
    try {
        $stmt = $conn->prepare("
            SELECT tbsubcategoriaid 
            FROM tbsubcategoria 
            WHERE tbsubcategoriaidentificador = :subCat
            ORDER BY tbsubcategoriaid DESC 
            LIMIT 1
        ");
        $stmt->bindParam(':subCat', $subCat, PDO::PARAM_STR);
        $stmt->execute();
        $lastIdentifier = $stmt->fetchColumn();
        
        return $lastIdentifier ?: false;
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Cierre de la conexión
        $conn = null;
    }
}


public function activateLastSubcategory($ident): bool
{
    $lastIdentifier = $this->getLastSubcategoryIdentifierByCategory($ident);
    
    if ($lastIdentifier) {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                UPDATE tbsubcategoria 
                SET tbsubcategoriaestado = 1 
                WHERE tbsubcategoriaid = :identifier
            ");
            $stmt->bindParam(':identifier', $lastIdentifier, PDO::PARAM_INT); // Usualmente IDs son enteros
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierre de la conexión
            $conn = null;
        }
        return $result;
    } else {
        return false;
    }
}


public function autocompleteSubcategories(string $searchTerm)
{
    $conn = self::connect();

    // Prepare the SQL query with UNION ALL to combine results from both enabled and disabled subcategories
    $stmt = $conn->prepare("
        (
            SELECT * 
            FROM tbsubcategoria AS s1
            WHERE s1.tbsubcategoriaestado = 0
              AND s1.tbsubcategoriaid = (
                  SELECT MAX(s3.tbsubcategoriaid)
                  FROM tbsubcategoria AS s3
                  WHERE s3.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
                    AND s3.tbsubcategoriaestado = 0
              )
              AND (s1.tbsubcategorianombre LIKE :search OR s1.tbsubcategoriadescripcion LIKE :search)
              AND NOT EXISTS (
                  SELECT 1 
                  FROM tbsubcategoria AS s2
                  WHERE s2.tbsubcategoriaidentificador = s1.tbsubcategoriaidentificador
                    AND s2.tbsubcategoriaestado = 1
              )
        )
        UNION ALL
        (
            SELECT * 
            FROM tbsubcategoria AS s1
            WHERE s1.tbsubcategoriaestado = 1
              AND (s1.tbsubcategorianombre LIKE :search OR s1.tbsubcategoriadescripcion LIKE :search)
        )
        ORDER BY tbsubcategorianombre ASC
        LIMIT 10
    ");

    // Assign the search term with wildcards for partial matching
    $likeSearchTerm = "%{$searchTerm}%";

    // Bind the search term parameter
    $stmt->bindParam(':search', $likeSearchTerm, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process results into Subcategoria objects
    $subcategories = [];
    foreach ($results as $row) {
        $subObj = new Subcategoria(
            $row['tbsubcategoriaid'],
            $row['tbcategoriaidentificador'],
            $row['tbsubcategoriaidentificador'],
            $row['tbsubcategorianombre'],
            $row['tbsubcategoriadescripcion'],
            new DateTime($row['tbsubcategoriafechacreacion']),
            new DateTime($row['tbsubcategoriafechamodificacion']),
            $row['tbsubcategoriaestado']
        );
        $subcategories[] = $subObj;
    }

    return $subcategories;
}


public function validateSubcategoryName(string $name, ?string $identifier): bool
{
    // La consulta SQL básica
    $sql = 'SELECT COUNT(*) FROM `tbsubcategoria` WHERE `tbsubcategorianombre` = :name';
    
    // Añadir la condición del identificador si se proporciona
    if (!empty($identifier)) {
        $sql .= ' AND `tbsubcategoriaidentificador` != :identifier';
    }
    
    // Obtener la conexión
    $conn = self::connect();
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Vincular el parámetro del nombre
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    
    // Vincular el parámetro del identificador si se proporciona
    if (!empty($identifier)) {
        $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
    }
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener el número de filas que coinciden con los criterios
    $count = $stmt->fetchColumn();
    
    // Si el conteo es mayor que 0, significa que el nombre ya existe
    return $count > 0;
}



public function obtenerNombres()
{

    $conn = self::connect();
    // Consulta para obtener todos las presentaciones
    $stmt = $conn->query("SELECT tbsubcategorianombre FROM tbsubcategoria");
    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}




}

