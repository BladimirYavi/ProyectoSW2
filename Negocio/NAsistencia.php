<?php 
require_once "../Dato/DAsistencia.php";
require_once "../Dato/DDetalleAsistencia.php";
require_once "../Dato/DDocente.php";

class NAsistencia {
    public $DAsistencia;
    public $DDetalleAsistencia;
    public $DDocente;

    public function __construct(){
        $this->DAsistencia = new DAsistencia();
        $this->DDetalleAsistencia = new DDetalleAsistencia();
        $this->DDocente = new DDocente();
    }

    public function mostrar($idGrupo){
        return $this->DAsistencia->mostrar($idGrupo);
    }

    public function registrar($fecha, $estado, $idGrupo){
        $this->DAsistencia->setFecha($fecha);
        $this->DAsistencia->setEstado($estado);
        $this->DAsistencia->registrar();
        $idAsistencia = $this->DAsistencia->getIdAsistencia();
        $alumnos = $this->DDocente->mostrarAlumnos($idGrupo);
        foreach ($alumnos as $key => $value) {
            $this->DDetalleAsistencia->setIdAsistencia($idAsistencia);
            $this->DDetalleAsistencia->setIdInscripcion($value["idinscripcion"]);
            $this->DDetalleAsistencia->setIdGrupo($idGrupo);
            $this->DDetalleAsistencia->setMarcacion(0);
            $this->DDetalleAsistencia->registrar();
        }

        return 1;
    }

    public function mostrarDetalle($idAsistencia, $idGrupo){
        $this->DDetalleAsistencia->setIdAsistencia($idAsistencia);
        $this->DDetalleAsistencia->setIdGrupo($idGrupo);
        return $this->DDetalleAsistencia->mostrar();
    }

    public function actualizarDetalle($marcacion, $idAsistencia, $idInscripcion, $idGrupo){
        $this->DDetalleAsistencia->setIdAsistencia($idAsistencia);
        $this->DDetalleAsistencia->setIdInscripcion($idInscripcion);
        $this->DDetalleAsistencia->setIdGrupo($idGrupo);
        $this->DDetalleAsistencia->setMarcacion($marcacion);
        return $this->DDetalleAsistencia->actualizar();
    }

    public function actualizarDetalleMultiple($alumnos){
        foreach ($alumnos as $key => $value) {
            $this->DDetalleAsistencia->setIdAsistencia($value["idAsistencia"]);
            $this->DDetalleAsistencia->setIdInscripcion($value["idInscripcion"]);
            $this->DDetalleAsistencia->setIdGrupo($value["idGrupo"]);
            $this->DDetalleAsistencia->setMarcacion($value["marcacion"]);
            $this->DDetalleAsistencia->actualizar();
        }
        return 1;
    }

    public function getIdAsistencia(){
        return $this->DAsistencia->getIdAsistencia();
    }

}

// $Asistencia = new NAsistencia();
// echo json_encode($Asistencia->registrar('2018-10-10',1,1));