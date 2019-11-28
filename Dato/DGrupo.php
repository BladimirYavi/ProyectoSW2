<?php
require_once "Conexion.php";

class DGrupo {
    public $conexion;
    public $nombre;
    public $estado;
    public $idMateria;
    public $idDocente;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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

    public function getIdMateria()
    {
        return $this->idMateria;
    }

    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;
        return $this;
    }


    public function getIdDocente()
    {
        return $this->idDocente;
    }

    public function setIdDocente($idDocente)
    {
        $this->idDocente = $idDocente;
        return $this;
    }

    public function mostrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "SELECT g.*, m.nombre as materia, d.nombre as docente FROM grupo g, materia m, docente d WHERE g.estado = 1 and g.idMateria = m.id and g.idDocente = d.id"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO grupo(nombre, estado, idMateria, idDocente) VALUES(?, ?, ?, ?)"
        );
        if($stmt->execute([$this->nombre, $this->estado, $this->idMateria, $this->idDocente])){
            return 1;
        }else{
            return 0;
        }
    }

    public function editar($idGrupo){
        $sql =  "SELECT * FROM grupo WHERE estado = 1 and id = ?";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute([$idGrupo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function actualizar($idGrupo){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  grupo SET nombre = ?, idMateria = ?, idDocente = ? WHERE id = ?"
        );
        if($stmt->execute([$this->nombre, $this->idMateria, $this->idDocente, $idGrupo])){
            return 1;
        }else{
            return 0;
        }
    }

    public function borrar($idGrupo){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  grupo SET estado = ? WHERE id = ?"
        );

        if($stmt->execute([0, $idGrupo])){
            return 1;
        }else{
            return 0;
        }
    }


}

// $grupo = new DGrupo();
// $grupo->setNombre('SSdsfdsfS');
// $grupo->setEstado(1);
// $grupo->setIdMateria(1);
// $grupo->setIdDocente(1);
// echo $grupo->actualizar(5);