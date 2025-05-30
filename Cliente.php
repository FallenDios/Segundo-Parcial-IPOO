<?php

class Cliente {
    // Atributos privados
    private $tipoDoc;
    private $nroDoc;
    private $nombre;
    private $apellido;

    // Constructor
    public function __construct($tipoDoc, $nroDoc, $nombre, $apellido) {
        $this->tipoDoc = $tipoDoc;
        $this->nroDoc = $nroDoc;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // Métodos de acceso
    public function getTipoDoc() {
        return $this->tipoDoc;
    }

    public function setTipoDoc($tipoDoc) {
        $this->tipoDoc = $tipoDoc;
    }

    public function getNroDoc() {
        return $this->nroDoc;
    }

    public function setNroDoc($nroDoc) {
        $this->nroDoc = $nroDoc;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // Método __toString
    public function __toString() {
        return "Cliente: " . $this->getNombre() . " " . $this->getApellido() .
               " - Documento: " . $this->getTipoDoc() . " " . $this->getNroDoc();
    }
}
