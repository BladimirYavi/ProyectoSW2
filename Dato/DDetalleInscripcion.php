<?php
require_once "Conexion.php";

class DDetalleInscripcion {
    public $conexion;
    public $idInscripcion;
    public $idGrupo;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getIdInscripcion()
    {
        return $this->idInscripcion;
    }

    public function setIdInscripcion($idInscripcion)
    {
        $this->idInscripcion = $idInscripcion;
        return $this;
    }

    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    public function setIdGrupo($idGrupo)
    {
        $this->idGrupo = $idGrupo;
        return $this;
    }

    public function mostrar($idInscripcion){
        $stmt = $this->conexion->conectar()->prepare(
            "SELECT di.*, g.nombre as grupo, m.nombre as materia,m.sigla, m.nivel, d.nombre as docente from detalleinscripcion di, grupo g,materia m, docente d WHERE  di.idGrupo = g.id and g.idMateria = m.id and g.idDocente = d.id And di.idInscripcion = ? "
        );
        $stmt->execute([$idInscripcion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO detalleinscripcion(idInscripcion, IdGrupo) VALUES(?, ?)"
        );
        if($stmt->execute([$this->idInscripcion, $this->idGrupo])){
            return 1;
        }else{
            return 0;
        }
    }

}

// $i = new DDetalleInscripcion();
// echo json_encode($i->mostrar(1));
// $i->setIdInscripcion(9);
// $i->setIdGrupo(2);
// echo $i->registrar();