<?php


class Compra {

    private $id;
    private $identifier;
    private $idSupplier;
    private $totalBuy;
    private $buyState;
    private $notes;
    private $payMethod;
    private $buyDate;
    private $createdAt;
    private $modifiedAt;

    public function __construct($id, $identifier, $idSupplier, $totalBuy, $buyState, $notes, $payMethod, $buyDate, $createdAt, $modifiedAt) {

        $this->id = $id;
        $this->identifier = $identifier;
        $this->idSupplier = $idSupplier;
        $this->totalBuy = $totalBuy;
        $this->buyState = $buyState;
        $this->notes = $notes;
        $this->payMethod = $payMethod;
        $this->buyDate = $buyDate;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function setIdentifier($value) {
        $this->identifier = $value;
    }

    public function getIdSupplier() {
        return $this->idSupplier;
    }

    public function setIdSupplier($value) {
        $this->idSupplier = $value;
    }

    public function getTotalBuy() {
        return $this->totalBuy;
    }

    public function setTotalBuy($value) {
        $this->totalBuy = $value;
    }

    public function getBuyState() {
        return $this->buyState;
    }

    public function setBuyState($value) {
        $this->buyState = $value;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($value) {
        $this->notes = $value;
    }

    public function getPayMethod() {
        return $this->payMethod;
    }

    public function setPayMethod($value) {
        $this->payMethod = $value;
    }

    public function getBuyDate() {
        return $this->buyDate;
    }

    public function setBuyDate($value) {
        $this->buyDate = $value;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($value) {
        $this->createdAt = $value;
    }

    public function getModifiedAt() {
        return $this->modifiedAt;
    }

    public function setModifiedAt($value) {
        $this->modifiedAt = $value;
    }
}
