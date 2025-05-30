<?php
class EmpresaCable
{
    // Atributos privados
    private $coleccionPlanes;
    private $coleccionCanales;
    private $coleccionClientes;
    private $coleccionContratos;

    // Constructor
    public function __construct($planes, $canales, $clientes, $contratos)
    {
        $this->coleccionPlanes = $planes;
        $this->coleccionCanales = $canales;
        $this->coleccionClientes = $clientes;
        $this->coleccionContratos = $contratos;
    }


      // Métodos de acceso 
    public function getColeccionPlanes() {
        return $this->coleccionPlanes;
    }

    public function setColeccionPlanes($planes) {
        $this->coleccionPlanes = $planes;
    }

    public function getColeccionCanales() {
        return $this->coleccionCanales;
    }

    public function setColeccionCanales($canales) {
        $this->coleccionCanales = $canales;
    }
    public function getColeccionClientes() {
        return $this->coleccionClientes;
    }

    public function setColeccionClientes($clientes) {
        $this->coleccionClientes = $clientes;
    }
    public function getColeccionContratos() {
        return $this->coleccionContratos;
    }

    public function setColeccionContratos($contratos) {
        $this->coleccionContratos = $contratos;
    }


    // Método para incorporar un nuevo plan si no está repetido
    public function incorporarPlan($objNuevoPlan) {
        $seAgrego = false;
        $planes = $this->getColeccionPlanes();
        $existe = false;

        foreach ($planes as $objPlan) {
            if ($objPlan->getColeccionCanales() == $objNuevoPlan->getColeccionCanales() &&
                $objPlan->getMG() == $objNuevoPlan->getMG()) {
                $existe = true;
            }
        }

        if (!$existe) {
            $planes[] = $objNuevoPlan;
            $this->setColeccionPlanes($planes);
            $seAgrego = true;
        }

        return $seAgrego;
    }



    //Metodo buscar contrato 
    public function buscarContrato($tipoDoc, $nroDoc) {
    $contratoEncontrado = null;
    $coleccionContratos = $this->getColeccionContratos();

    foreach ($coleccionContratos as $objContrato) {
        $objCliente = $objContrato->getObjCliente();

        if ($objCliente->getTipoDoc() == $tipoDoc && $objCliente->getNroDoc() == $nroDoc) {
            $contratoEncontrado = $objContrato;
        }
    }

    return $contratoEncontrado;
}

// Metodo incorporar contrato

public function incorporarContrato($objPlan, $objCliente, $fechaInicio, $fechaVencimiento, $esWeb) {
    $contratos = $this->getColeccionContratos();

    // Buscar contrato activo del cliente
    foreach ($contratos as $objContrato) {
        $cliente = $objContrato->getObjCliente();

        if ($cliente->getTipoDoc() == $objCliente->getTipoDoc() &&
            $cliente->getNroDoc() == $objCliente->getNroDoc() &&
            $objContrato->getEstado() != "finalizado") {
            $objContrato->setEstado("finalizado"); // Dar de baja
        }
    }

    // Crear el nuevo contrato
    if ($esWeb) {
        $nuevoContrato = new ContratoWeb($fechaInicio, $fechaVencimiento, $objPlan, "al día", 0, true, $objCliente);
    } else {
        $nuevoContrato = new Contrato($fechaInicio, $fechaVencimiento, $objPlan, "al día", 0, true, $objCliente);
    }

    // Agregarlo a la colección
    $contratos[] = $nuevoContrato;
    $this->setColeccionContratos($contratos);
}


// Método para retornar el promedio de importes de los contratos de un plan específico
public function retornarPromImporteContratos($codigoPlan) {
    $coleccionContratos = $this->getColeccionContratos();
    $sumaImportes = 0;
    $cantidad = 0;

    foreach ($coleccionContratos as $objContrato) {
        $objPlan = $objContrato->getObjPlan();

        if ($objPlan->getCodigo() == $codigoPlan) {
            $sumaImportes += $objContrato->getCosto();
            $cantidad++;
        }
    }

    $promedio = 0;
    if ($cantidad > 0) {
        $promedio = $sumaImportes / $cantidad;
    }

    return $promedio;
}

//metodo pagar contrato

public function pagarContrato($codigoContrato) {
    $importeFinal = 0;
    $coleccionContratos = $this->getColeccionContratos();

    foreach ($coleccionContratos as $objContrato) {
        if ($objContrato->getCodigo() == $codigoContrato) {
            $estado = $objContrato->getEstado();

            if ($estado == "finalizado") {
                $importeFinal = 0;
            } elseif ($estado == "al día") {
                $objContrato->setFechaVencimiento(date('Y-m-d', strtotime($objContrato->getFechaVencimiento(). ' +1 month')));
                $importeFinal = $objContrato->calcularImporte();
            } elseif ($estado == "moroso" || $estado == "suspendido") {
                $diasVencido = $objContrato->diasContratoVencido();
                $multa = $objContrato->calcularImporte() * 0.10 * $diasVencido;
                $importeFinal = $objContrato->calcularImporte() + $multa;

                if ($estado == "moroso") {
                    $objContrato->setEstado("al día");
                    $objContrato->setFechaVencimiento(date('Y-m-d', strtotime($objContrato->getFechaVencimiento(). ' +1 month')));
                }
            }
        }
    }

    return $importeFinal;
}


}

