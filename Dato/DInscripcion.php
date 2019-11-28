<?php 
require_once "Conexion.php";

class DInscripcion {
    public $conexion;
    public $fecha;
    public $cantidad;
    public $estado;
    public $idAlumno;

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

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
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

    public function getIdInscripcion(){
        $sql = "SELECT id FROM inscripcion ORDER BY id DESC LIMIT 1";
		$stmt = $this->conexion->conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch()["id"];
    }

    public function mostrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "SELECT i.*, a.nombre as alumno from inscripcion i, alumno a WHERE i.estado = 1 and i.idAlumno = a.id"
        );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO inscripcion(fecha, cantidad, estado, idAlumno) VALUES(?, ?, ?, ?)"
        );
        if($stmt->execute([$this->fecha, $this->cantidad, $this->estado, $this->idAlumno])){
            return 1;
        }else{
            return 0;
        }
    }

    public function actualizar($idInscripcion){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  inscripcion SET fecha = ?, idAlumno = ? WHERE id = ?"
        );
        if($stmt->execute([$this->fecha, $this->idAlumno, $idInscripcion])){
            return 1;
        }else{
            return 0;
        }
    }

    public function borrar($idinscripcion){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  inscripcion SET estado = ? WHERE id = ?"
        );
        if($stmt->execute([0, $idinscripcion])){
            return 1;
        }else{
            return 0;
        }
    }


}

// $i = new DInscripcion();
// $i->setFecha('2019-01-01');
// $i->setCantidad(2);
// $i->setEstado(1);
// $i->setIdAlumno(1);
// $i->registrar();
// echo json_encode($i->getIdInscripcion());