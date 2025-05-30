<?php

class ContratoWeb extends Contrato {

    // Atributo privado adicional
    private $porcentajeDescuento;

    // Constructor
    public function __construct($vFechaInicio, $vFechaVencimiento, $objPlan, $vEstado, $vCosto, $vSeRenueva, $objCliente, $vPorcentajeDescuento = 10) {
        parent::__construct($vFechaInicio, $vFechaVencimiento, $objPlan, $vEstado, $vCosto, $vSeRenueva, $objCliente);
        $this->porcentajeDescuento = $vPorcentajeDescuento;
    }

    // Métodos de acceso
    public function getPorcentajeDescuento() {
        return $this->porcentajeDescuento;
    }

    public function setPorcentajeDescuento($vPorcentajeDescuento) {
        $this->porcentajeDescuento = $vPorcentajeDescuento;
    }

    // Redefinición del método calcularImporte
    public function calcularImporte() {
        $importeBase = parent::calcularImporte();
        $importeFinal = $importeBase - ($importeBase * $this->getPorcentajeDescuento() / 100);
        return $importeFinal;
    }

    // Método __toString
    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "\nPorcentaje de Descuento: " . $this->getPorcentajeDescuento() . "%";
        return $cadena;
    }
}




    

}
