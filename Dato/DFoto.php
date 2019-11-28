<?php 
require_once "Conexion.php";

class DFoto {
    public $conexion;
    public $foto;
    public $estado;
    public $idAlumno;

    
    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    public function getIdAlumno()
    {
        return $this->idAlumno;
    }

    public function setIdAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;
        return $this;
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO foto(foto, estado, idAlumno) VALUES(?, ?, ?)"
        );
        if($stmt->execute([$this->foto, $this->estado, $this->idAlumno])){
            return 1;
        }else{
            return 0;
        }
    }


}