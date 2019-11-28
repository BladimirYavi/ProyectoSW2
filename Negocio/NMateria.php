<?php 
require_once "../Dato/DMateria.php";

class NMateria {
    public $DMateria;

    public function __construct(){
        $this->DMateria = new DMateria();
    }

    public function mostrar(){
        return $this->DMateria->mostrar();
    }

    public function registrar($sigla, $nombre, $nivel, $estado){
        $this->DMateria->setSigla($sigla);
        $this->DMateria->setNombre($nombre);
        $this->DMateria->setNivel($nivel);
        $this->DMateria->setEstado($estado);
        return $this->DMateria->registrar();
    }

    public function editar($idMateria){
        return $this->DMateria->editar($idMateria);
    }

    public function actualizar($sigla, $nombre, $nivel, $idMateria){
        $this->DMateria->setSigla($sigla);
        $this->DMateria->setNombre($nombre);
        $this->DMateria->setNivel($nivel);
        return $this->DMateria->actualizar($idMateria);
    }

    public function borrar($idMateria){
        return $this->DMateria->borrar($idMateria);
    }

}

// $materia = new NMateria();
// echo json_encode($materia->borrar(6));