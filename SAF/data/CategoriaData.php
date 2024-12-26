<?php

require_once "Conexion.php";
require_once '../domain/Categoria.php';



class CategoriaData extends Conexion
{

    // Método para obtener todas las categorías
    public function getAllCategories()
    {
        $conn = self::connect();
        $stmt = $conn->query("SELECT * FROM tbcategoria WHERE tbcategoriaestado = 1");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];

        foreach ($result as $dates) {
            $category = new Categoria(
                $dates['tbcategoriaid'],
                $dates['tbcategoriaidentificador'],
                $dates['tbcategorianombre'],
                $dates['tbcategoriadescripcion'],
                new DateTime($dates['tbcategoriafechacreacion']),
                new DateTime($dates['tbcategoriafechamodificacion']),
                $dates['tbcategoriaestado']
            );
            $categories[] = $category;
        }

        return $categories;
    }

    /*
    
    "
        SELECT * 
        FROM tbcategoria AS c1
        WHERE c1.tbcategoriaestado = 0
          AND NOT EXISTS (
              SELECT 1
              FROM tbcategoria AS c2
              WHERE c2.tbcategoriaidentificador = c1.tbcategoriaidentificador
                AND c2.tbcategoriaestado = 1
          )
    "
    */

    public function getAllCategoriesDisable()
{
    $conn = self::connect();
    $stmt = $conn->query("
    SELECT * 
    FROM tbcategoria AS c1
    WHERE c1.tbcategoriaestado = 0
      AND NOT EXISTS (
          SELECT 1
          FROM tbcategoria AS c2
          WHERE c2.tbcategoriaidentificador = c1.tbcategoriaidentificador
            AND c2.tbcategoriaestado = 1
      )
      AND c1.tbcategoriaid = (
          SELECT MAX(c3.tbcategoriaid)
          FROM tbcategoria AS c3
          WHERE c3.tbcategoriaidentificador = c1.tbcategoriaidentificador
            AND c3.tbcategoriaestado = 0
      )
    ");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categories = [];

    foreach ($result as $dates) {
        $category = new Categoria(
            $dates['tbcategoriaid'],
            $dates['tbcategoriaidentificador'],
            $dates['tbcategorianombre'],
            $dates['tbcategoriadescripcion'],
            new DateTime($dates['tbcategoriafechacreacion']),
            new DateTime($dates['tbcategoriafechamodificacion']),
            $dates['tbcategoriaestado']
        );
        $categories[] = $category;
    }

    return $categories;
}


    public function getCategoriesByFilter($searchT)
    {
        $conn = self::connect();

        // Preparar la consulta SQL con LIKE para filtrar los resultados si se proporciona un término de búsqueda
        $sql = "SELECT * FROM tbcategoria WHERE tbcategoriaestado = 1 AND tbcategorianombre LIKE :search OR tbcategoriaestado = 1 AND tbcategoriadescripcion LIKE :search";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':search', '%' . $searchT . '%');

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];

        // Construir el array de categorías
        foreach ($result as $dates) {
            $category = new Categoria(
                $dates['tbcategoriaid'],
                $dates['tbcategoriaidentificador'],
                $dates['tbcategorianombre'],
                $dates['tbcategoriadescripcion'],
                new DateTime($dates['tbcategoriafechacreacion']),
                new DateTime($dates['tbcategoriafechamodificacion']),
                $dates['tbcategoriaestado']
            );
            $categories[] = $category;
        }

        return $categories;
    }


    public function saveCategory(Categoria $category): bool
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbcategoria`(`tbcategoriaid`, `tbcategoriaidentificador`, `tbcategorianombre`, `tbcategoriadescripcion`, `tbcategoriafechacreacion`, `tbcategoriafechamodificacion`, `tbcategoriaestado`) VALUES (:id, :identifier, :pName, :pDescription, :createdAt, :updatedAt, :pState);");

            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $category->getIdCat();
            $identifier = $category->getIdentifierCat();
            $pName = $category->getNameCategory();
            $pDescription = $category->getDescriptionCat();

            // Convierte DateTime a string
            $createdAt = $category->getCreatedAtCat()->format('Y-m-d H:i:s');
            $updatedAt = $category->getModifiedAtCat()->format('Y-m-d H:i:s');

            $pState = $category->getStatusCat();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function validateName(string $name, ?string $identifier): bool
{
    // La consulta SQL básica
    $sql = 'SELECT COUNT(*) FROM `tbcategoria` WHERE `tbcategorianombre` = :name';
    
    // Añadir la condición del identificador si se proporciona
    if (!empty($identifier)) {
        $sql .= ' AND `tbcategoriaidentificador` != :identifier';
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

    public function deleteCategory(Categoria $category)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbcategoria SET tbcategoriaestado = :estado WHERE tbcategoriaidentificador = :identifier");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $identifier = $category->getIdentifierCat();
            $estado = 0;
            // Coloco los parámetros
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
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


    /** 
     * @return int 
     */
    public function getNextIdCat(): int
    {
        $conn = self::connect();
        try {
            $stmt = $conn->query("SELECT tbcategoriaid FROM tbcategoria ORDER BY tbcategoriaid DESC LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $row ? $row['tbcategoriaid'] + 1 : 1;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $lastId = 0;
        } finally {
            $conn = null;
        }
        return $lastId;
    }



    public function getCategory(Categoria $category)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT tbcategoriaid, tbcategoriaidentificador, tbcategorianombre, tbcategoriadescripcion , tbcategoriafechacreacion, tbcategoriafechamodificacion,tbcategoriaestado FROM tbcategoria WHERE tbcategoriaidentificador = :identifier AND tbcategoriaestado != 0 ");
        $identifier = $category->getIdentifierCat();

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

    /*
   
       public function updateCategory(Categoria $category):bool
       {
           // Obtengo la conexión
           $conn = self::connect();
           try {
               // Preparo la sentencia
               $stmt = $conn->prepare("UPDATE tbcategoria SET tbcategorianombre = :cName, tbcategoriadescripcion = :cDesc, tbcategoriafechamodificacion = :updatedAt WHERE tbcategoriaidentificador = :identifier");
               // Asigno los valores a variables antes de pasarlas a bindParam
               $identifier = (string) $category->getIdentifierCat();
               $pName = (string) $category->getNameCategory();
               $pDesc = (string) $category->getDescriptionCat();
               $updatedAt = $category->getStrModifiedAtCat(); 
               // Coloco los parámetros
               $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
               $stmt->bindParam(':cName', $pName, PDO::PARAM_STR);
               $stmt->bindParam(':cDesc', $pDesc, PDO::PARAM_STR);
               $stmt->bindParam('updatedAt', $updatedAt, PDO::PARAM_STR);
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
   */

    public function getCategoryById($id)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM tbcategoria WHERE tbcategoriaid = :identifier");

        $stmt->bindParam(':identifier', $id, PDO::PARAM_STR);
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


    public function updateCategory(Categoria $category)
    {
        $this->deleteCategory($category);
        return $this->saveCategory($category);
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


    private function getLastIdentifierByCategory($categoryIdent)
    {
        $conn = self::connect();
        try {
            $stmt = $conn->prepare("
                SELECT tbcategoriaid 
                FROM tbcategoria 
                WHERE tbcategoriaidentificador = :categoryId
                ORDER BY tbcategoriaid  DESC 
                LIMIT 1
            ");
            $stmt->bindParam(':categoryId', $categoryIdent, PDO::PARAM_STR);
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
    
    public function activateLastCategory($categoryIdent):bool
    {
      
        $lastIdentifier = $this->getLastIdentifierByCategory($categoryIdent);
        
        if ($lastIdentifier) {
            $conn = self::connect();
            try {
         
                $stmt = $conn->prepare("
                    UPDATE tbcategoria 
                    SET tbcategoriaestado = 1 
                    WHERE tbcategoriaid = :identifier
                ");
                $stmt->bindParam(':identifier', $lastIdentifier, PDO::PARAM_STR);
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


    public function getAllCategoriesDisablefilt(?string $filterName)
{
    $conn = self::connect();

    // Construir la consulta base
    $query = "
    SELECT * 
    FROM tbcategoria AS c1
    WHERE c1.tbcategoriaestado = 0
      AND NOT EXISTS (
          SELECT 1
          FROM tbcategoria AS c2
          WHERE c2.tbcategoriaidentificador = c1.tbcategoriaidentificador
            AND c2.tbcategoriaestado = 1
      )
      AND c1.tbcategoriaid = (
          SELECT MAX(c3.tbcategoriaid)
          FROM tbcategoria AS c3
          WHERE c3.tbcategoriaidentificador = c1.tbcategoriaidentificador
            AND c3.tbcategoriaestado = 0
      )
    ";

    // Añadir filtro si es proporcionado
    if ($filterName !== null) {
        $query .= " AND c1.tbcategorianombre LIKE :filterName";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular el parámetro del filtro si es proporcionado
    if ($filterName !== null) {
        $filterNameParam = '%' . $filterName . '%';
        $stmt->bindParam(':filterName', $filterNameParam, PDO::PARAM_STR);
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear objetos de categoría
    $categories = [];
    foreach ($result as $dates) {
        $category = new Categoria(
            $dates['tbcategoriaid'],
            $dates['tbcategoriaidentificador'],
            $dates['tbcategorianombre'],
            $dates['tbcategoriadescripcion'],
            new DateTime($dates['tbcategoriafechacreacion']),
            new DateTime($dates['tbcategoriafechamodificacion']),
            $dates['tbcategoriaestado']
        );
        $categories[] = $category;
    }

    return $categories;
}

public function autocompleteCategories(string $searchTerm)
{
    $conn = self::connect();

    // Preparar la consulta SQL con UNION ALL para combinar resultados de categorías activas e inactivas
    $stmt = $conn->prepare("
        SELECT * FROM (
            (
                SELECT * 
                FROM tbcategoria AS c1
                WHERE c1.tbcategoriaestado = 0
                  AND c1.tbcategoriaid = (
                      SELECT MAX(c3.tbcategoriaid)
                      FROM tbcategoria AS c3
                      WHERE c3.tbcategoriaidentificador = c1.tbcategoriaidentificador
                        AND c3.tbcategoriaestado = 0
                  )
                  AND (c1.tbcategorianombre LIKE :search OR c1.tbcategoriadescripcion LIKE :search)
                  AND NOT EXISTS (
                      SELECT 1 
                      FROM tbcategoria AS c2
                      WHERE c2.tbcategoriaidentificador = c1.tbcategoriaidentificador
                        AND c2.tbcategoriaestado = 1
                  )
            )
            UNION ALL
            (
                SELECT * 
                FROM tbcategoria AS c1
                WHERE c1.tbcategoriaestado = 1
                  AND (c1.tbcategorianombre LIKE :search OR c1.tbcategoriadescripcion LIKE :search)
            )
        ) AS combined_results
        ORDER BY combined_results.tbcategorianombre ASC
        LIMIT 10
    ");

    // Asignar el término de búsqueda con comodines para coincidencias parciales
    $likeSearchTerm = "%{$searchTerm}%";

    // Vincular el parámetro del término de búsqueda
    $stmt->bindParam(':search', $likeSearchTerm, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Procesar resultados en objetos de categoría
    $categories = [];
    foreach ($results as $row) {
        $category = new Categoria(
            $row['tbcategoriaid'],
            $row['tbcategoriaidentificador'],
            $row['tbcategorianombre'],
            $row['tbcategoriadescripcion'],
            new DateTime($row['tbcategoriafechacreacion']),
            new DateTime($row['tbcategoriafechamodificacion']),
            $row['tbcategoriaestado']
        );
        $categories[] = $category;
    }

    return $categories;
}

public function obtenerNombres()
{

    $conn = self::connect();
    // Consulta para obtener todos las presentaciones
    $stmt = $conn->query("SELECT tbcategorianombre FROM tbcategoria");
    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
    
}

