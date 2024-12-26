<?php

require_once "../data/UsuarioData.php";

/**
 * Description of UsuariosController
 *
 * @author brayan
 */
class ControladoraUsuarios {

    private usuarioData $con;

    public function __construct() {
        $this->con = new usuarioData();
    }

    function save(array $data): bool {
        return $this->con->save($data);
    }

    function getAll(): array {
        return $this->con->getAll();
    }

    function getAllRol(): array {
        return $this->con->getAllRol();
    }

    function verifyUser(string $user, string $pass): bool {
        return $this->con->verifyUser($user, $pass);
    }

    function delete($identificador): bool {
        return $this->con->delete($identificador);
    }

    function getRolByIdentifier(string $identificador): array {
        return $this->con->getRolByIdentifier($identificador);
    }

    function getUserByIdentifier(string $identificador): array {
        return $this->con->getUserByIdentifier($identificador);
    }

    function update(string $identificador, array $data): bool {
        $this->delete($identificador);
        $this->con = new UsuarioData();
        return $this->save($data);
    }

    function searchByNameUser(string $data): array {
        return $this->con->searchByNameUser($data);
    }

    function searchByEmail(string $data): array {
        return $this->con->searchByEmailUser($data);
    }

    function search($data): array {
        return $this->con->search($data);
    }
}
