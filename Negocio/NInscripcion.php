<?php 
require_once "../Dato/DInscripcion.php";
require_once "../Dato/DDetalleInscripcion.php";

class NInscripcion {
    public $DInscripcion;
    public $DDetalleInscripcion;

    public function __construct(){
        $this->DInscripcion = new DInscripcion();
        $this->DDetalleInscripcion = new DDetalleInscripcion();
    }

    public function mostrar(){
        return $this->DInscripcion->mostrar();
    }

    public function registrar($fecha, $cantidad, $estado, $idAlumno, $grupos){
        $this->DInscripcion->setFecha($fecha);
        $this->DInscripcion->setCantidad($cantidad);
        $this->DInscripcion->setEstado($estado);
        $this->DInscripcion->setIdAlumno($idAlumno);
        $this->DInscripcion->registrar();
        $idInscripcion = $this->DInscripcion->getIdInscripcion();
        foreach ($grupos as $key => $value) {
            $this->registrarDetalle($idInscripcion, $value['id']);
        }
        return 1;
    }

    public function registrarDetalle($idInscripcion, $idGrupo){
        $this->DDetalleInscripcion->setIdInscripcion($idInscripcion);
        $this->DDetalleInscripcion->setIdGrupo($idGrupo);
        $this->DDetalleInscripcion->registrar();
    }

    public function actualizar($fecha, $cantidad, $idAlumno, $idInscripcion){
        $this->DInscripcion->setFecha($fecha);
        $this->DInscripcion->setCantidad($cantidad);
        $this->DInscripcion->setIdAlumno($idAlumno);
        return $this->DInscripcion->actualizar($idInscripcion);
    }

    public function borrar($idInscripcion){
        return $this->DInscripcion->borrar($idInscripcion);
    }

    public function mostrarDetalle($idInscripcion){
        return $this->DDetalleInscripcion->mostrar($idInscripcion);
    }

}

// $Inscripcion = new NInscripcion();
// echo json_encode($Inscripcion->registrar('2018-05-05',10,1,1,[1,2,3,4,5]));