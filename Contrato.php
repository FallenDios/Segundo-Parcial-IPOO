<?php

class Contrato {
    // Atributos
    private $fechaInicio;
    private $fechaVencimiento;
    private $objPlan;
    private $estado;
    private $costo;
    private $seRenueva;
    private $objCliente;
    private $codigo; 

    // Constructor
    public function __construct($vFechaInicio, $vFechaVencimiento, $objPlan, $vEstado, $vCosto, $vSeRenueva, $objCliente, $codigo = null) {
        $this->fechaInicio = $vFechaInicio;
        $this->fechaVencimiento = $vFechaVencimiento;
        $this->objPlan = $objPlan;
        $this->estado = $vEstado;
        $this->costo = $vCosto;
        $this->seRenueva = $vSeRenueva;
        $this->objCliente = $objCliente;
        $this->codigo = $codigo ?? uniqid(); // asigna un código único si no se proporciona
    }

    // Getters y setters
    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function getObjPlan() {
        return $this->objPlan;
    }

    public function setObjPlan($objPlan) {
        $this->objPlan = $objPlan;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function getSeRenueva() {
        return $this->seRenueva;
    }

    public function setSeRenueva($seRenueva) {
        $this->seRenueva = $seRenueva;
    }

    public function getObjCliente() {
        return $this->objCliente;
    }

    public function setObjCliente($objCliente) {
        $this->objCliente = $objCliente;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    // Método que calcula la cantidad de días vencidos
    public function diasContratoVencido() {
        $fechaHoy = new DateTime();
        $fechaVencimiento = new DateTime($this->getFechaVencimiento());
        $diasVencidos = 0;

        if ($fechaHoy > $fechaVencimiento) {
            $diferencia = $fechaHoy->diff($fechaVencimiento);
            $diasVencidos = $diferencia->days;
        }

        return $diasVencidos;
    }

    // Método que actualiza el estado del contrato
    public function actualizarEstadoContrato() {
        $diasVencidos = $this->diasContratoVencido();

        if ($diasVencidos > 10) {
            $this->setEstado("suspendido");
        } elseif ($diasVencidos > 0) {
            $this->setEstado("moroso");
        } else {
            $this->setEstado("al día");
        }
    }

    // Método calcularImporte (para contratos en empresa)
    public function calcularImporte() {
        $importe = $this->getObjPlan()->getImporte();
        $canales = $this->getObjPlan()->getColeccionCanales();

        foreach ($canales as $objCanal) {
            $importe += $objCanal->getImporte();
        }

        return $importe;
    }

    // Método __toString
    public function __toString() {
        $cadena = "Contrato [" . $this->getCodigo() . "]\n";
        $cadena .= "Inicio: " . $this->getFechaInicio() . " | Vencimiento: " . $this->getFechaVencimiento() . "\n";
        $cadena .= "Estado: " . $this->getEstado() . " | Costo: $" . $this->getCosto() . "\n";
        $cadena .= "Cliente: " . $this->getObjCliente() . "\n";
        return $cadena;
    }
}
