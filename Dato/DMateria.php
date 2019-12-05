<?php
require_once "Conexion.php";

class DMateria {
    public $conexion;
    public $sigla;
    public $nombre;
    public $nivel;
    public $estado;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getSigla()
    {
        return $this->sigla;
    }

    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
        return $this;
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

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
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

    public function mostrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "SELECT * FROM materia WHERE estado = 1 ORDER BY id ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO materia(sigla, nombre, nivel, estado) VALUES(?, ?, ?, ?)"
        );
        if($stmt->execute([$this->sigla, $this->nombre, $this->nivel, $this->estado])){
            return 1;
        }else{
            return 0;
        }
    }

    public function editar($idMateria){
        $sql =  "SELECT * FROM materia WHERE estado = 1 and id = ?";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute([$idMateria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function actualizar($idMateria){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  materia SET sigla = ?,nombre = ?, nivel = ? WHERE id = ?"
        );
        if($stmt->execute([$this->sigla, $this->nombre, $this->nivel, $idMateria])){
            return 1;
        }else{
            return 0;
        }
    }

    public function borrar($idMateria){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  materia SET estado = ? WHERE id = ?"
        );
        if($stmt->execute([0, $idMateria])){
            return 1;
        }else{
            return 0;
        }
    }

}

// $materia = new DMateria();
// $materia->setSigla('INFO05');
// $materia->setNombre('ingles');
// $materia->setNivel(1);
// $materia->setEstado(1);
// echo json_encode($materia->registrar());