<?php

class ContratoWeb extends Contrato {



    // Atributo privado adicional de ContratoWeb

    private $porcentajeDescuento;



    // Constructor 

    public function __construct($vFechaInicio, $vFechaVencimiento, $objPlan, $vEstado, $vCosto, $vSeRenueva, $objCliente, $vPorcentajeDescuento = 10) {

        // constructor de la clase padre Contrato

        parent::__construct($vFechaInicio, $vFechaVencimiento, $objPlan, $vEstado, $vCosto, $vSeRenueva, $objCliente);

        

        // Iniciamos el  atributo propio

        $this->porcentajeDescuento = $vPorcentajeDescuento;

    }



   // Método de acceso get

    public function getPorcentajeDescuento() {

        return $this->porcentajeDescuento;

    }



    // Método de acceso set

    public function setPorcentajeDescuento($vPorcentajeDescuento) {

        $this->porcentajeDescuento = $vPorcentajeDescuento;

    }


    //  __toString

    public function __toString() {

        $cadena = parent::__toString();

        $cadena .= "\nPorcentaje de Descuento: " . $this->getPorcentajeDescuento() . "%";

        return $cadena;

    }



    

}