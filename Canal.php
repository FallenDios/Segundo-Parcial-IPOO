<?php

class Canal {
    // Atributos
    private $tipo;
    private $importe;
    private $esHD;

    // Constructor
    public function __construct($tipo, $importe, $esHD) {
        $this->tipo = $tipo;
        $this->importe = $importe;
        $this->esHD = $esHD;
    }

    // Métodos de acceso
    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function getEsHD() {
        return $this->esHD;
    }

    public function setEsHD($esHD) {
        $this->esHD = $esHD;
    }

    // Método __toString
    public function __toString() {
        $cadena = "Tipo: " . $this->getTipo();
        $cadena .= "\nImporte: $" . $this->getImporte();
        $cadena .= "\nHD: " . ($this->getEsHD() ? "Sí" : "No");
        return $cadena;
    }
}
