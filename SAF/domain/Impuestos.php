<?php

class Impuestos {

    private $id;
    private $identifier;
    private $name;
    private $description;
    private $value;
    private $date;
    private $state;

    public function __construct($id, $identifier, $name, $description, $value, $date, $state) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->date = $date;
        $this->state = $state;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void {
        $this->identifier = $identifier;
    }

        public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getValue() {
        return $this->value;
    }

    public function getDate() {
        return $this->date;
    }

    public function getState() {
        return $this->state;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setValue($value): void {
        $this->value = $value;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function setState($state): void {
        $this->state = $state;
    }

    public function __toString(): string {
        return "Impuestos[id=" . $this->id
                . ", name=" . $this->name
                . ", description=" . $this->description
                . ", value=" . $this->value
                . ", date=" . $this->date
                . ", state=" . $this->state
                . "]";
    }
}
