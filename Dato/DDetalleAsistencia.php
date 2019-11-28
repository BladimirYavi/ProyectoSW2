<?php
require_once "Conexion.php";

class DDetalleAsistencia {
    public $conexion;
    public $idAsistencia;
    public $idInscripcion;
    public $idGrupo;
    public $marcacion;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getIdAsistencia()
    {
        return $this->idAsistencia;
    }

    public function setIdAsistencia($idAsistencia)
    {
        $this->idAsistencia = $idAsistencia;
        return $this;
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

    public function getMarcacion()
    {
        return $this->marcacion;
    }

    public function setMarcacion($marcacion)
    {
        $this->marcacion = $marcacion;
        return $this;
    }

    public function mostrar(){
        $sql = "SELECT a.ci, a.nombre, di.idInscripcion,di.idGrupo, da.idAsistencia, da.marcacion  FROM alumno a, inscripcion i, detalleinscripcion di,detalleasistencia da WHERE a.estado=1 and a.id=i.idAlumno and i.id=di.idInscripcion and di.idInscripcion=da.idInscripcion and di.idGrupo=:idGrupo and da.idAsistencia=:idAsistencia";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(":idAsistencia",$this->idAsistencia,PDO::PARAM_STR);
        $stmt->bindParam(":idGrupo",$this->idGrupo,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO detalleasistencia(idAsistencia, idInscripcion, idGrupo, marcacion) VALUES(?, ?, ?, ?)"
        );
        if($stmt->execute([$this->idAsistencia, $this->idInscripcion, $this->idGrupo, $this->marcacion])){
            return 1;
        }else{
            return 0;
        }
    }

    public function actualizar(){
        $sql = "UPDATE detalleasistencia SET marcacion=? WHERE idAsistencia=? and idInscripcion=? and idGrupo=? ";
        $stmt = $this->conexion->conectar()->prepare($sql);
        if($stmt->execute([$this->marcacion, $this->idAsistencia, $this->idInscripcion, $this->idGrupo])){
          return 1;
        }else{
           return 0;
        }
    }


}