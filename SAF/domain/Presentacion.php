
<?php

/*
 * Brayan Rosales Perez
 * modificado 6-08-2024
 */

class Presentacion {

    private $id;
    private $identifier;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;
    private $status;

    public function __construct($id, $identifier, $name, $description, $createdAt, $updatedAt, $status) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->status = $status;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getName() {
        return $this->name;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function __toString(): string {
        return "Presentacion[id=" . $this->id
                . ", identifier=" . $this->identifier
                . ", name=" . $this->name
                . ", description=" . $this->description
                . ", createdAt=" . $this->createdAt
                . ", updatedAt=" . $this->updatedAt
                . ", status=" . $this->status
                . "]";
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'name' => $this->name,
            'description' => $this->description,
            'createdAt' => $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null,
            'updatedAt' => $this->updatedAt ? $this->updatedAt->format('Y-m-d H:i:s') : null,
            'status' => $this->status
        ];
    }
}
