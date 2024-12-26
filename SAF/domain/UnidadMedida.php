<?php

/**
 * Description of UnidadMedida
 *
 * @author BrayRPGs
 */
class UnidadMedida {

    private $id;
    private $identifier;
    private $nameUnit;
    private $abbreviation;
    private $systemMeasurement;
    private $typeUnit;
    private $dateCreated;
    private $dateUpdated;
    private $state;

    public function __construct($id, $identifier, $nameUnit, $abbreviation, $systemMeasurement, $typeUnit, $dateCreated, $dateUpdated, $state) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->nameUnit = $nameUnit;
        $this->abbreviation = $abbreviation;
        $this->systemMeasurement = $systemMeasurement;
        $this->typeUnit = $typeUnit;
        $this->dateCreated = $dateCreated;
        $this->dateUpdated = $dateUpdated;
        $this->state = $state;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getNameUnit() {
        return $this->nameUnit;
    }

    public function getAbbreviation() {
        return $this->abbreviation;
    }

    public function getSystemMeasurement() {
        return $this->systemMeasurement;
    }

    public function getTypeUnit() {
        return $this->typeUnit;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDateUpdated() {
        return $this->dateUpdated;
    }

    public function getState() {
        return $this->state;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdentifier($identifier): void {
        $this->identifier = $identifier;
    }

    public function setNameUnit($nameUnit): void {
        $this->nameUnit = $nameUnit;
    }

    public function setAbbreviation($abbreviation): void {
        $this->abbreviation = $abbreviation;
    }

    public function setSystemMeasurement($systemMeasurement): void {
        $this->systemMeasurement = $systemMeasurement;
    }

    public function setTypeUnit($typeUnit): void {
        $this->typeUnit = $typeUnit;
    }

    public function setDateCreated($dateCreated): void {
        $this->dateCreated = $dateCreated;
    }

    public function setDateUpdated($dateUpdated): void {
        $this->dateUpdated = $dateUpdated;
    }

    public function setState($state): void {
        $this->state = $state;
    }

    public function __toString(): string {
        return "UnitMeasurement[id=" . $this->id
                . ", identifier=" . $this->identifier
                . ", nameUnit=" . $this->nameUnit
                . ", abbreviation=" . $this->abbreviation
                . ", systemMeasurement=" . $this->systemMeasurement
                . ", typeUnit=" . $this->typeUnit
                . ", dateCreated=" . $this->dateCreated
                . ", dateUpdated=" . $this->dateUpdated
                . ", state=" . $this->state
                . "]";
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'nameUnit' => $this->nameUnit,
            'abbreviation' => $this->abbreviation,
            'systemMeasurement' => $this->systemMeasurement,
            'typeUnit' => $this->typeUnit,
            'dateCreated' => $this->dateCreated ? $this->dateCreated->format('Y-m-d H:i:s') : null,
            'dateUpdated' => $this->dateUpdated ? $this->dateUpdated->format('Y-m-d H:i:s') : null,
            'state' => $this->state
        ];
    }
}