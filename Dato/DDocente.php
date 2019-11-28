<?php
require_once "Conexion.php";

class DDocente {
   public $conexion;
   public $nombre;
   public $telefono;
   public $email;
   public $password;
   public $estado;
   
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

   public function getTelefono()
   {
       return $this->telefono;
   }

   public function setTelefono($telefono)
   {
       $this->telefono = $telefono;
       return $this;
   }

   public function getEmail()
   {
       return $this->email;
   }

   public function setEmail($email)
   {
       $this->email = $email;
       return $this;
   }

   public function getPassword()
   {
       return $this->password;
   }

   public function setPassword($password)
   {
       $this->password = $password;
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
         "SELECT * FROM docente WHERE estado =1"
      );
		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_ASSOC);
   }

   public function registrar(){
      $stmt = $this->conexion->conectar()->prepare(
         "INSERT INTO docente(nombre, telefono, email, password, estado) VALUES(:nombre, :telefono, :email, :password, :estado)"
      );
      $stmt -> bindParam(":nombre",$this->nombre,PDO::PARAM_STR);
      $stmt -> bindParam(":telefono",$this->telefono,PDO::PARAM_STR);
      $stmt -> bindParam(":email",$this->email,PDO::PARAM_STR);
      $stmt -> bindParam(":password",$this->password,PDO::PARAM_STR);
      $stmt -> bindParam(":estado",$this->estado,PDO::PARAM_STR);

      if($stmt->execute()){
         return 1;
      }else{
         return 0;
      }
   }

   public function editar($idDocente){
      $sql =  "SELECT * FROM docente WHERE estado = 1 and id = ?";
      $stmt = $this->conexion->conectar()->prepare($sql);
      $stmt->execute([$idDocente]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
   
   public function actualizar($idDocente){
      $stmt = $this->conexion->conectar()->prepare(
         "UPDATE docente SET nombre = ?, telefono = ?, email= ?, password = ? WHERE id = ?"
      );
      if($stmt->execute([$this->nombre, $this->telefono, $this->email, $this->password, $idDocente])){
         return 1;
      }else{
         return 0;
      }
   }

   public function borrar($idDocente){
      $stmt = $this->conexion->conectar()->prepare(
         "UPDATE docente SET estado= ? WHERE id = ?"
      );
      if($stmt->execute([0, $idDocente])){
         return 1;
      }else{
         return 0;
      }
   }

   public function login(){
      $stmt = $this->conexion->conectar()->prepare(
         "SELECT * FROM docente WHERE estado=1 and email = :email"
      );
      $stmt->bindParam(":email",$this->email,PDO::PARAM_STR);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      if($stmt!=null){
         if(crypt($this->password,  $resultado["password"]) == $resultado["password"]){
            return  ['mensaje'=>"Se logeo correctamente",'data'=>  $resultado];
         }else{
            return ['mensaje'=>"Contraseña incorrecta"];
         }
      }else{
         return ['mensaje'=>"No existe usuario"];
      }
   }

   public function mostrarAlumnos($idGrupo){
      $stmt = $this->conexion->conectar()->prepare(
         "SELECT a.ci, a.nombre, di.idInscripcion,di.idGrupo  FROM alumno a, inscripcion i, detalleinscripcion di WHERE a.estado=1 and a.id=i.idAlumno and i.id=di.idInscripcion and di.idGrupo=:idGrupo"
      );
      $stmt->bindParam(":idGrupo",$idGrupo,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   
   public function mostrarGrupos($idDocente){
      $stmt = $this->conexion->conectar()->prepare(
         "SELECT g.*, m.nombre as materia FROM grupo g,materia m WHERE g.estado=1 and g.idMateria=m.id  and g.idDocente=:idDocente"
      );
      $stmt->bindParam(":idDocente",$idDocente,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

}

// $docente = new DDocente();
// echo json_encode($docente->mostrarAlumnos(1));
// $docente->setNombre('mataias mauel flores');
// $docente->setTelefono('12356');
// $docente->setEmail('matu@gmail.com');
// $docente->setPassword('123');
// $docente->setEstado(1);
// echo json_encode($docente->registrar());