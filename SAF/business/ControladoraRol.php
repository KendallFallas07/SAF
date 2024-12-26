<?php

require_once "../data/RolData.php";

/**
 * Description of RolController
 *
 * @author brayan
 */
class ControladoraRol {

    private RolData $data;

    public function __construct() {
        $this->data = new RolData();
    }

    public function save(array $data): bool {
        return $this->data->save($data);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function deleteByIdentyfier($identificador) {
        return $this->data->delete($identificador);
    }

    public function update(array $data): bool {
        $this->data->delete($data["tbrolidentificador"]);
        $this->data = new RolData();
        return $this->data->save($data);
    }

    public function search($data) {
        return $this->data->searchData($data);
    }

    public function getByIdentifier(string $identifier): array {
        return $this->data->getByIdentifier($identifier);
    }
    public function getByIdentifierFull(string $identifier): array {
        return $this->data->getByIdentifierFull($identifier);
    }
}
