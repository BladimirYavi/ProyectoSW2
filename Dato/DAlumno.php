<?php 
require_once "Conexion.php";

class DAlumno {
    public $conexion;
    public $ci;
    public $nombre;
    public $telefono;
    public $estado;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function getCi()
    {
        return $this->ci;
    }

    public function setCi($ci)
    {
        $this->ci = $ci;
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

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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

    public function getIdAlumno(){
        $sql = "SELECT id FROM alumno ORDER BY id DESC LIMIT 1";
		$stmt = $this->conexion->conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch()["id"];
    }

    public function mostrar(){
        $sql =  "SELECT * FROM alumno WHERE estado = 1 ORDER BY id ASC";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar(){
        $stmt = $this->conexion->conectar()->prepare(
            "INSERT INTO alumno(ci, nombre, telefono, estado) VALUES(?, ?, ?, ?)"
        );
        if($stmt->execute([$this->ci, $this->nombre, $this->telefono, $this->estado])){
            return 1;
        }else{
            return 0;
        }
    }

    public function editar($idAlumno){
        $sql =  "SELECT * FROM alumno WHERE estado = 1 and id = ?";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute([$idAlumno]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function actualizar($idAlumno){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  alumno SET ci = ?, nombre = ?, telefono = ? WHERE id = ?"
        );
        if($stmt->execute([$this->ci, $this->nombre, $this->telefono, $idAlumno])){
            return 1;
        }else{
            return 0;
        }
    }

    public function borrar($idAlumno){
        $stmt = $this->conexion->conectar()->prepare(
            "UPDATE  alumno SET estado = ? WHERE id = ?"
        );
        if($stmt->execute([0, $idAlumno])){
            return 1;
        }else{
            return 0;
        }
    }

}

// $alumno = new DAlumno();
// echo json_encode($alumno->mostrar());
// $alumno->setCi('12356');
// $alumno->setNombre(' tito lara');
// $alumno->setTelefono(78546566);
// $alumno->setEstado(1);
// echo $alumno->borrar(10);