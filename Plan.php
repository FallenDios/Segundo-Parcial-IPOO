<?php

class Plan {
    // Atributos
    private $codigo;
    private $coleccionCanales; // arreglo de objetos Canal
    private $importe;
    private $mg; // megas de datos

    // Constructor
    public function __construct($codigo, $canales, $importe, $mg = 100) {
        $this->codigo = $codigo;
        $this->coleccionCanales = $canales;
        $this->importe = $importe;
        $this->mg = $mg;
    }

    // Métodos de acceso
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getColeccionCanales() {
        return $this->coleccionCanales;
    }

    public function setColeccionCanales($canales) {
        $this->coleccionCanales = $canales;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function getMG() {
        return $this->mg;
    }

    public function setMG($mg) {
        $this->mg = $mg;
    }

    // Método __toString
    public function __toString() {
        $cadena = "Código de Plan: " . $this->getCodigo();
        $cadena .= "\nImporte Base: $" . $this->getImporte();
        $cadena .= "\nMG Incluidos: " . $this->getMG() . " MB";
        $cadena .= "\nCanales:\n";

        foreach ($this->getColeccionCanales() as $objCanal) {
            $cadena .= $objCanal . "\n";
        }

        return $cadena;
    }
}
