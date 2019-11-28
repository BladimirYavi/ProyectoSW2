<?php
require_once "Conexion.php";

class DAsistencia {
    public $conexion;
    public $fecha;
    public $estado;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
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
    
    public function getIdAsistencia(){
        $sql = "SELECT id FROM asistencia ORDER BY id DESC LIMIT 1";
		$stmt = $this->conexion->conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch()["id"];
    }

    public function mostrar($idGrupo){
        $sql = "SELECT distinct a.id, a.fecha FROM asistencia a, detalleasistencia da WHERE a.estado=1 and a.id=da.idAsistencia and da.idGrupo = ? ORDER BY a.id DESC";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute([$idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO asistencia(fecha, estado) VALUES(?, ?)"
        );
        if($stmt->execute([$this->fecha, $this->estado])){
            return 1;
        }else{
            return 0;
        }
    }

    public function actualizar($idasistencia){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  asistencia SET fecha = ? WHERE id = ?"
        );
        if($stmt->execute([$this->fecha, $idasistencia])){
            return 1;
        }else{
            return 0;
        }
    }

    public function borrar($idasistencia){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  asistencia SET estado = ? WHERE id = ?"
        );
        if($stmt->execute([0, $idasistencia])){
            return 1;
        }else{
            return 0;
        }
    }


}

// $a = new DAsistencia();
// $a->setFecha('2019/05/05');
// $a->setEstado(1);
// echo json_encode($a->registrar());