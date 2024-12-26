
<?php

include_once "../domain/UnidadMedida.php";

include_once "../data/UnidadMedidaData.php";

/**
 * Description of ControladoraUnidadMedida
 *
 * @author BrayRPGs
 */
class ControladoraUnidadMedida {

    private $conn;

    public function __construct() {
        $this->conn = new UnidadMedidaData();
    }

    public function saveData(UnidadMedida $data, bool $validate): bool {
        if ($validate) {
            $response = $this->conn->validateName($data->getNameUnit());
            if ($response >= 1) {
                return false;
            } else {
                return $this->conn->saveData($data);
            }
        } else {
            return $this->conn->saveData($data);
        }
    }

    public function updateData(UnidadMedida $data, bool $validate): bool {
        $this->conn->delete($data);
        $this->conn = new UnidadMedidaData();
        return $this->saveData($data, $validate);
    }

    public function getAllData(): array {
        return $this->conn->getAll();
    }

    public function deleteData(UnidadMedida $data): bool {
        return $this->conn->delete($data);
    }

    public function searchData(string $data): array {
        return $this->conn->searchData($data);
    }

    public function findByidentifier($identifier) {
        return $this->conn->findByidentifier($identifier);
    }

    public function findByid($id) {
        return $this->conn->findByid($id);
    }

    public function getAllUnitTypes(): array {
        return $this->conn->getAllUnitTypes();
    }

    public function getUnitTypeByIdentifier(string $identifier): array {
        return $this->conn->getUnitTypeByIdentifier($identifier);
    }

    public function getByIdentifier(string $identifier): array {
        return $this->conn->getByIdentifier($identifier);
    }
}
