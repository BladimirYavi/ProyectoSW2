<?php 
require_once "../Dato/DGrupo.php";

class NGrupo {
    public $DGrupo;

    public function __construct(){
        $this->DGrupo = new DGrupo();
    }

    public function mostrar(){
        return $this->DGrupo->mostrar();
    }

    public function registrar($nombre, $estado, $idMateria, $idDocente){
        $this->DGrupo->setNombre($nombre);
        $this->DGrupo->setEstado($estado);
        $this->DGrupo->setIdMateria($idMateria);
        $this->DGrupo->setIdDocente($idDocente);
        return $this->DGrupo->registrar();
    }

    public function editar($idGrupo){
        return $this->DGrupo->editar($idGrupo);
    }

    public function actualizar($nombre, $idMateria, $idDocente, $idGrupo){
        $this->DGrupo->setNombre($nombre);
        $this->DGrupo->setIdMateria($idMateria);
        $this->DGrupo->setIdDocente($idDocente);
        return $this->DGrupo->actualizar($idGrupo);
    }

    public function borrar($idGrupo){
        return $this->DGrupo->borrar($idGrupo);
    }

}

// $grupo = new NGrupo();
// echo json_encode($grupo->actualizar('grupo grupo',2,1,5));